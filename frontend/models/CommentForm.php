<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use frontend\models\Post;
use frontend\models\User;
use frontend\models\Comment;

/**
 * ContactForm is the model behind the contact form.
 */
class CommentForm extends Model
{
    const MAX_COMMENT_LENGTH = 1000;

    public $text;
    public $verifyCode;

    private $user;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'required'],
            [['text'], 'string', 'min' => 3, 'max' => self::MAX_COMMENT_LENGTH],
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'text' => Yii::t('comment', 'Comment'),
            'verifyCode' => Yii::t('comment','Verification Code'),
        ];
    }

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param int $postId
     * @return boolean
     */
    public function save($postId)
    {
        if ($this->validate()) {
            $comment = new Comment();
            $comment->post_id = $postId;
            $comment->user_id = $this->user->getId();
            $comment->text = $this->text;
            $comment->created_at = time();
            $comment->save();
            return true;
        }
        return false;
    }

}
