<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property int $post_id
 * @property int $user_id
 * @property string|null $text
 * @property int $created_at
 */
class Comment extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'user_id' => 'User ID',
            'text' => 'Text',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Get author of the comment
     * @return array|ActiveRecord
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id'])->one();
    }

    /**
     * Get post of this comment
     * @return array|ActiveRecord
     */
    public function getPost()
    {
        return $this->hasOne(Post::class, ['id' => 'post_id'])->one();
    }


}
