<?php


namespace frontend\models;

use console\models\Subscriber;
use yii\base\Model;
use Yii;

/**
 *
 * @author Igor
 */
class Subscribe extends Model
{
   public $email;

    public function attributeLabels()
    {
        return [
            'email' => Yii::t('contact', 'Email'),
        ];
    }
   
   public function rules()
   {
       return [
           ['email','required'],
           ['email','email'],
           ['email', 'unique', 'targetClass' => Subscriber::class, 'message' => Yii::t('flash', 'This email address has already been taken.')],
           
       ];
    }
    
    public function save()
    {
     $sql = "INSERT INTO subscriber (id,email) VALUES (null,'{$this->email}')";
     return Yii::$app->db->createCommand($sql)->execute();
    }
}
