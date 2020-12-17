<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use frontend\models\NewsSearch;

/**
 * Signup form
 */
class SearchForm extends Model {

    public $keyword;

    public function attributeLabels()
    {
        return [
            'keyword' => Yii::t('flash', 'Keyword'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            ['keyword', 'trim'],
            ['keyword', 'required'],
            ['keyword', 'string', 'min' => 3],
        ];
    }

    public function search() {
        if ($this->validate()) {
            $model = new NewsSearch();
            return $model->fulltextSearch($this->keyword);
        }
    }
//    public function searchAdvanced() {
//        if ($this->validate()) {
//            $model = new NewsSearch();
//            return $model->advancedSearch($this->keyword);
//        }
//    }

}
