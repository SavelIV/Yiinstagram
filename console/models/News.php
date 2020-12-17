<?php

namespace console\models;

use Yii;
use yii\helpers\Console;

/**
 * @author Igor
 */
class News 
{   
    const STATUS_NOT_SENT = 0;
    const STATUS_SENT = 1;

    /**
     * Return all news which weren't send
     * @param integer $maxNews
     * @return array
     */
    public static function getList($maxNews)
    {
        $sql = 'SELECT * FROM news WHERE status = '. self::STATUS_NOT_SENT . ' ORDER BY id desc LIMIT ' .$maxNews;
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        return self::prepareList($result);
    }

    /**
     * Prepare news item content
     * @param array $result
     * @return mixed
     */
    public static function prepareList($result)
    {
        if (!empty($result) && is_array($result)) {
            foreach ($result as &$item) {
                $item['content'] = Yii::$app->stringHelper->getShort($item['content']);
            }
            return $result;
        }
        return 0;
    }

    /**
     * Change status of news item to STATUS_SENT
     * @param array $newsList
     * @return int
     */
    public static function changeStatus($newsList)
    {
        $statuses = 0;
        foreach ($newsList as $item)
        {
            $sql = 'UPDATE news SET status = '. self::STATUS_SENT . ' WHERE id = ' . $item['id'];

            Yii::$app->db->createCommand($sql)->execute();
            $statuses++;
        }
        return $statuses;
    }
}