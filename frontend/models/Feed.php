<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "feed".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $author_id
 * @property string|null $author_name
 * @property int|null $author_nickname
 * @property string|null $author_picture
 * @property int|null $post_id
 * @property string $post_filename
 * @property string|null $post_description
 * @property int $post_created_at
 */
class Feed extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feed';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'author_id', 'author_nickname', 'post_id', 'post_created_at'], 'integer'],
            [['post_filename', 'post_created_at'], 'required'],
            [['post_description'], 'string'],
            [['author_name', 'author_picture', 'post_filename'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'author_id' => 'Author ID',
            'author_name' => 'Author Name',
            'author_nickname' => 'Author Nickname',
            'author_picture' => 'Author Picture',
            'post_id' => 'Post ID',
            'post_filename' => 'Post Filename',
            'post_description' => 'Post Description',
            'post_created_at' => 'Post Created At',
        ];
    }

    /**
     * @return mixed
     */
    public function countLikes()
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        return $redis->scard("post:{$this->post_id}:likes");
    }

    /**
     * @param \frontend\models\User $user
     */
    public function isReported(User $user)
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        return $redis->sismember("post:{$this->post_id}:complaints", $user->getId());
    }
}
