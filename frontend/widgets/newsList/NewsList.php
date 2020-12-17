<?php

namespace frontend\widgets\newsList;

use frontend\models\News;
use Yii;
use yii\base\Widget;
use frontend\models\Test;
use yii\data\ActiveDataProvider;

/**
 *
 * @author Igor
 * @param int $showLimit
 */
class NewsList extends Widget
{

    public $size = 300; //picture size

    public function run()
    {

        if ($this->size) {
            $size = $this->size;
        }

        $list = News::find()->orderBy('id DESC');


        $dataProvider = new ActiveDataProvider([
            'query' => $list,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'size' => $size,
        ]);
    }
}
