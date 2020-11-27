<?php
namespace frontend\tests\unit;

use Codeception\Test\Unit;
use Yii;
use frontend\tests\fixtures\UserFixture;
use frontend\tests\fixtures\PostFixture;
use frontend\models\User;

class PostTest extends Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    public function _fixtures()
    {
        return [
            'users' => UserFixture::class,
            'posts' => PostFixture::class,
        ];
    }

    public function _before()
    {
        Yii::$app->setComponents([
            'redis' => [
                'class' => 'yii\redis\Connection',
                'hostname' => 'localhost',
                'port' => 6379,
                'database' => 1,
            ],
        ]);
    }

    public function testGetUser()
    {
        $post = $this->tester->grabFixture('posts', 'post1');

        expect($post->getUser()->all())->equals(User::find()->select('*')
            ->where(['id' => 1])->all());
    }

    public function testLike()
    {
        $user1 = $this->tester->grabFixture('users', 'user1');
        $post1 = $this->tester->grabFixture('posts', 'post1');

        $post1->like($user1);

        $this->tester->seeRedisKeyContains('post:1:likes', 1);
        $this->tester->seeRedisKeyContains('user:1:likes', 1);

        $this->tester->sendCommandToRedis('del', 'post:1:likes');
        $this->tester->sendCommandToRedis('del', 'user:1:likes');
    }
    public function testUnlike()
    {
        $user1 = $this->tester->grabFixture('users', 'user1');
        $post1 = $this->tester->grabFixture('posts', 'post1');

        $post1->like($user1);

        $this->tester->seeRedisKeyContains('post:1:likes', 1);
        $this->tester->seeRedisKeyContains('user:1:likes', 1);

        $post1->unLike($user1);

        $this->tester->dontSeeInRedis('post:1:likes');
        $this->tester->dontSeeInRedis('user:1:likes');
    }


    public function testCountLikes()
    {
        $user1 = $this->tester->grabFixture('users', 'user1');
        $post1 = $this->tester->grabFixture('posts', 'post1');

        $post1->like($user1);

        $this->tester->seeRedisKeyContains('post:1:likes', 1);
        $this->tester->seeRedisKeyContains('user:1:likes', 1);

        expect($post1->countLikes())->equals(1);

        $this->tester->sendCommandToRedis('del', 'post:1:likes');
        $this->tester->sendCommandToRedis('del', 'user:1:likes');
    }

    public function testIsLikedBy()
    {
        $user1 = $this->tester->grabFixture('users', 'user1');
        $post3 = $this->tester->grabFixture('posts', 'post3');

        $post3->like($user1);

        $this->tester->seeRedisKeyContains('user:1:likes', 3);
        $this->tester->seeRedisKeyContains('post:3:likes', 1);

        expect($post3->isLikedBy($user1))->equals(true);

        $this->tester->sendCommandToRedis('del', 'user:1:likes');
        $this->tester->sendCommandToRedis('del', 'post:3:likes');
    }

    public function testIsReported()
    {
//        $user1 = $this->tester->grabFixture('users', 'user1');
//        $post3 = $this->tester->grabFixture('posts', 'post3');
//
//        $post3->isReported($user1);
//
//        $this->tester->seeRedisKeyContains('user:1:likes', 3);
//        $this->tester->seeRedisKeyContains('post:3:likes', 1);
//
//        expect($post3->isReported($user1))->equals(true);
//
//        $this->tester->sendCommandToRedis('del', 'user:1:likes');
//        $this->tester->sendCommandToRedis('del', 'post:3:likes');
    }
}