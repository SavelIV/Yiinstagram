<?php

namespace frontend\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $birthdate
 * @property int $rating
 */
class Author extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{author}}';
    }
    
   
    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required'],
            [['first_name', 'last_name'], 'string', 'max' => 25],
            [['birthdate'], 'date', 'format' =>'php:Y-m-d'],
            [['rating'], 'integer'],
        ];
    }
    public function beforeValidate()
    {
        $this->first_name = strip_tags($this->first_name);
        $this->last_name = strip_tags($this->last_name);
        return parent::beforeValidate();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'birthdate' => 'Birthdate',
            'rating' => 'Rating',
        ];
    }
}
