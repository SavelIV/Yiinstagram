<?php

namespace frontend\widgets\postsList;

use Yii;
use yii\base\Widget;
use yii\data\ActiveDataProvider;

/**
 * Post feed widget
 */
class PostsList extends Widget
{

    public function run()
    {

        $currentUser = Yii::$app->user->identity;
        $feedItems = $currentUser->getPostsFeed();


        $dataProvider = new ActiveDataProvider([
            'query' => $feedItems,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'currentUser' => $currentUser
        ]);
    }
}
