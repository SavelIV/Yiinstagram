<?php

namespace frontend\models;

use Yii;
use GuzzleHttp\Client;
use frontend\models\News;


/**
 * Parser class
 */
class Parser
{
    const URL = 'https://www.rbc.ru';


    /**
     * @return int parsed news count
     */
    public static function parseList()
    {
        $client = new Client();
        $res = $client->request('GET', self::URL);
        $body = $res->getBody();
        $document = \phpQuery::newDocumentHTML($body);

        $list = $document->find(".js-news-feed-list");

        $pq = pq($list);
        $pq->find('.js-news-feed-banner')->remove();

        $tags = $pq->find('.news-feed__item');

        $links = self::getLinks($tags);

        return self::getNews($links);
    }

    /**
     * @param object $tags
     * @return array
     */
    public static function getLinks($tags)
    {
        foreach ($tags as $key => $el) {
            $el = pq($el);
            $links[$key] = $el->attr("href");
        }
        return $links;
    }

    /**
     * @return int parsed news count
     */
    public static function getNews($links)
    {
        $client = new Client();
        $count = 0;

        foreach ($links as $key => $link) {

            $res = $client->request('GET', $link);
            $body = $res->getBody();
            $document = \phpQuery::newDocumentHTML($body);

            $page = $document->find(".article__content");

            $pq = pq($page);
            $pq->find('.article__inline-item__title')->remove();

            $title = $pq->find('h1.article__header__title-in')->text();
            $content = preg_replace('/\s+/', ' ', $pq->find('p')->text());
            $picture = $pq->find('img')->attr('src');

            if ($title && $title != "") {
                Yii::$app->db->createCommand()->upsert('news', [
                    'title' => $title,
                    'picture' => $picture,
                    'content' => $content,
                    'url' => $link
                ], [
                        'picture' => $picture,
                        'content' => $content,
                    ]
                )->execute();
                $count++;
            }
        }
        return $count;
    }

    /**
     * @param integer $max
     * @return array
     */
    public static function getNewsList($max)
    {
        $max = intval($max);

        $result =  News::find()->orderBy('id DESC')->limit($max)->all();

        if (!empty($result) && is_array($result)) {
            foreach ($result as &$item) {
                $item['content'] = Yii::$app->stringHelper->getShort($item['content']);
            }
        }
        return $result;
    }

    /**
     *
     * @param integer $id
     * @return \frontend\models\News
     */
    public static function getNewsItemById($id)
    {
        $id = intval($id);

        return News::findOne($id);
    }
}