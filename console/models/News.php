<?php

namespace console\models;

use Yii;
/**
 * @author Igor
 */
class News 
{   
    const STATUS_NOT_SENT = 1;
    const STATUS_SENT = 2;
    const STATUS_NOT_CHECKED = 3;

    /**
     * Return all news which weren't send
     * @param integer $maxNews
     * @return array
     */
    public static function getList($maxNews)
    {
        $sql = 'SELECT * FROM news WHERE status = '. self::STATUS_NOT_SENT .' LIMIT ' .$maxNews;
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        return self::prepareList($result);
    }

    /**
     * Prepare news item content
     * @param array $result
     * @return array
     */
    public static function prepareList($result)
    {
        if (!empty($result) && is_array($result)) {
            foreach ($result as &$item) {
                $item['content'] = Yii::$app->stringHelper->getShort($item['content']);
            }
            return $result;
        }
    }
}