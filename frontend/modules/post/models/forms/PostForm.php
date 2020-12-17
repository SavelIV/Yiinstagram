<?php

namespace frontend\modules\post\models\forms;

use Yii;
use yii\base\Model;
use frontend\models\Post;
use frontend\models\User;
use Intervention\Image\ImageManager;
use frontend\models\events\PostCreatedEvent;

class PostForm extends Model
{

    const MAX_DESCRIPTION_LENGTH = 1000;
    const EVENT_POST_CREATED = 'post_created';

    public $picture;
    public $description;

    private $user;


    public function attributeLabels()
    {
        return [
            'picture' => Yii::t('create', 'Picture'),
            'description' => Yii::t('create', 'Description'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['picture'], 'file',
                'skipOnEmpty' => false,
                'extensions' => ['jpg', 'png'],
                'checkExtensionByMimeType' => true,
                'maxSize' => $this->getMaxFileSize()],
            [['description'], 'string', 'max' => self::MAX_DESCRIPTION_LENGTH],
        ];
    }

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->on(self::EVENT_AFTER_VALIDATE, [$this, 'resizePicture']);
        $this->on(self::EVENT_POST_CREATED, [Yii::$app->feedService, 'addToFeeds']);
    }

    /**
     * Resize image if needed
     */
    public function resizePicture()
    {
        if ($this->picture->error) {
            return;
        }

        $width = Yii::$app->params['postPicture']['maxWidth'];
        $height = Yii::$app->params['postPicture']['maxHeight'];

        $manager = new ImageManager(array('driver' => 'imagick'));

        $image = $manager->make($this->picture->tempName);

        $image->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $image->insert((Yii::getAlias('@site/wmark.png')),'bottom-right');
        $image->save($this->picture->tempName  . '.' . $file->extension);

    }

    /**
     * @return boolean
     */
    public function save()
    {
        if ($this->validate()) {
            $post = new Post();
            $post->description = $this->description;
            $post->created_at = time();
            $post->filename = Yii::$app->storage->saveUploadedFile($this->picture);
            $post->user_id = $this->user->getId();
            if ($post->save(false)) {
                $event = new PostCreatedEvent();
                $event->user = $this->user;
                $event->post = $post;
                $this->trigger(self::EVENT_POST_CREATED, $event);
                return true;
            }
        }
        return false;
    }

    /**
     * Maximum size of the uploaded file
     * @return integer
     */
    private function getMaxFileSize()
    {
        return Yii::$app->params['maxFileSize'];
    }

}

