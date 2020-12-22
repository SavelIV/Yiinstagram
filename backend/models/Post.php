<?php

namespace backend\models;

use frontend\models\Feed;
use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property int $user_id
 * @property string $filename
 * @property string|null $description
 * @property int $created_at
 * @property int|null $complaints
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'filename' => 'Filename',
            'description' => 'Description',
            'created_at' => 'Created At',
            'complaints' => 'Complaints',
        ];
    }

    public static function findComplaints()
    {
        return Post::find()->where('complaints > 0')->orderBy('complaints DESC');
    }

    public function getImage()
    {
        return Yii::$app->storage->getFile($this->filename);
    }

    public function deleteImage()
    {
        return Yii::$app->storage->deleteFile($this->filename);
    }

    /**
     * Approve post (delete complaints) if it looks good
     * @return boolean
     */
    public function approve()
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        $key = "post:{$this->id}:complaints";
        $redis->del($key);

        $this->complaints = 0;
        return $this->save(false, ['complaints']);
    }

     /**
     * Delete all connected attributes from redis and newsfeed and post image from disc
     * @return boolean
     */
    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        $redis->del("post:{$this->id}:complaints");
        $redis->del("post:{$this->id}:comments");

        $this->deleteUsersLikesFromRedis();
        $this->deleteImage();

        $models = Feed::find()->where(['post_id' => $this->id])->all();
        foreach ($models as $model) {
            $model->delete();
        }
        return true;
    }

    public function deleteUsersLikesFromRedis()
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;

        $keysLikes = "post:{$this->id}:likes";
        if ($idsUsers = $redis->smembers($keysLikes)) {
            foreach ($idsUsers as $idsUser) {
                $redis->srem("user:{$idsUser}:likes", $this->id);
            }
            $redis->del($keysLikes);
        }
        return true;
    }

}
