<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Employee extends ActiveRecord {

    const SCENARIO_EMPLOYEE_REGISTER = 'employee_register';
    const SCENARIO_EMPLOYEE_UPDATE = 'employee_update';
    
    public function scenarios()
    {
        return[
            self::SCENARIO_EMPLOYEE_REGISTER => ['first_name', 'last_name', 'middle_name', 'email', 'birth_date', 'hiring_date', 'city', 'position', 'id_code'],
            self::SCENARIO_EMPLOYEE_UPDATE => ['first_name', 'last_name', 'middle_name'],
        ];

    }
    /*
     * Validation rules
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email', 'birth_date'], 'required'],
            [['first_name'], 'string', 'min' =>2],
            [['last_name'], 'string', 'min' =>3],
            [['email'], 'email'],
            [['middle_name'], 'required', 'on' => self::SCENARIO_EMPLOYEE_UPDATE],
            
            [['birth_date', 'hiring_date'], 'date', 'format' => 'php:Y-m-d'],
            [['city'], 'integer'],
            [['position'], 'string'],
            [['id_code'], 'string', 'length' => 10],
            [['hiring_date', 'position', 'id_code'], 'required', 'on' => self::SCENARIO_EMPLOYEE_REGISTER],
        ];
    }

    public static function getCitiesList()
    {
        $sql = 'SELECT * FROM city';
        $result =  Yii::$app->db->createCommand($sql)->queryAll();
        return ArrayHelper::map($result, 'id', 'name');
        
    }

}
