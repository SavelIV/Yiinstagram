<?php


namespace console\models;

use Yii;
use yii\db\ActiveRecord;

/**
 *
 * @author Igor
 */
class Subscriber extends ActiveRecord {
    
    /**
     * Return all subscribers
     * @return array
     */
    
    public static function getList()
    {
      $sql = 'SELECT * FROM subscriber';
      return Yii::$app->db->createCommand($sql)->queryAll();
      
    }
            
}
