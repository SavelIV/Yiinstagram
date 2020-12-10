<?php

namespace frontend\modules\post\controllers;

use frontend\controllers\behaviors\AccessBehavior;
use frontend\models\CommentForm;
use frontend\models\User;
use frontend\models\Post;
use frontend\models\Comment;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use frontend\modules\post\models\forms\PostForm;

/**
 * Default controller for the `post` module
 */
class DefaultController extends Controller
{
    public function behaviors()
    {
        return [

            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'deleteComment' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessBehavior::class,
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Renders the create view for the module
     * @return string
     */
    public function actionCreate()
    {
        $model = new PostForm(Yii::$app->user->identity);

        if ($model->load(Yii::$app->request->post())) {

            $model->picture = UploadedFile::getInstance($model, 'picture');

            /* @var $user User */
            $user = Yii::$app->user->identity;

            if ($model->save()) {

                Yii::$app->session->setFlash('success', 'Post created!');
                return $this->redirect(['/user/profile/view', 'nickname' => $user->getNickname()]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Renders the post view for the module
     * @return string
     */
    public function actionView($id)
    {
        /* @var $currentUser User */
        $currentUser = Yii::$app->user->identity;
        $model = new CommentForm($currentUser);
        $post = $this->findPost($id);
        $comments = $post->getCommentsList();

        if ($model->load(Yii::$app->request->post()) && $model->save($id)) {
            $post->addComment($currentUser);
            Yii::$app->session->setFlash('added', 'Comment has been added!');
            return $this->redirect(['/post/default/view', 'id' => $id]);
        }

        return $this->render('view', [
            'post' => $this->findPost($id),
            'currentUser' => $currentUser,
            'model' => $model,
            'comments' => $comments,
        ]);
    }

    /**
     * Deletes an existing Comment and connected attributes from redis.
     * @param integer $commentId
     * @return mixed
     */
    public function actionDeleteComment($commentId)
    {
        $comment = $this->findComment($commentId);
        $post = $comment->getPost();

        /* @var $currentUser User */
        $currentUser = Yii::$app->user->identity;

        if ($comment->delete()) {
            $post->deleteComment($currentUser);
            Yii::$app->session->setFlash('deleted', 'Comment has been deleted!');
        } else {
            Yii::$app->session->setFlash('error', 'Something went wrong...');
        }
        return $this->redirect(['/post/default/view', 'id' => $post->id]);
    }

    public function actionLike()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $id = Yii::$app->request->post('id');
        $post = $this->findPost($id);

        /* @var $currentUser User */
        $currentUser = Yii::$app->user->identity;

        $post->like($currentUser);

        return [
            'success' => true,
            'likesCount' => $post->countLikes(),
        ];
    }

    public function actionUnlike()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $id = Yii::$app->request->post('id');
        $post = $this->findPost($id);

        /* @var $currentUser User */
        $currentUser = Yii::$app->user->identity;

        $post->unLike($currentUser);

        return [
            'success' => true,
            'likesCount' => $post->countLikes(),
        ];
    }

    public function actionComplain()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $id = Yii::$app->request->post('id');

        /* @var $currentUser User */
        $currentUser = Yii::$app->user->identity;
        $post = $this->findPost($id);

        if ($post->complain($currentUser)) {
            return [
                'success' => true,
                'text' =>  Yii::t('home', 'Post has been reported!'),
            ];
        }
        return [
            'success' => false,
            'text' => Yii::t('home', 'Error'),
        ];
    }

    public function actionUncomplain()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $id = Yii::$app->request->post('id');

        /* @var $currentUser User */
        $currentUser = Yii::$app->user->identity;
        $post = $this->findPost($id);

        if ($post->unComplain($currentUser)) {
            return [
                'success' => true,
                'text' => Yii::t('home', 'Undone!'),
            ];
        }
        return [
            'success' => false,
            'text' => Yii::t('home', 'Error'),
        ];
    }

    /**
     * Finds the Post based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post
     * @throws NotFoundHttpException
     */
    private function findPost($id)
    {
        if (($post = Post::findOne($id)) !== null) {
            return $post;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Finds the Comment based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comment
     * @throws NotFoundHttpException
     */
    private function findComment($id)
    {
        if (($comment = Comment::findOne($id)) !== null) {
            return $comment;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
