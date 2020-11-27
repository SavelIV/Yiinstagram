<?php
namespace frontend\tests\unit;

use Yii;
use frontend\tests\fixtures\UserFixture;
use frontend\tests\fixtures\PostFixture;
use Codeception\Test\Unit;
use frontend\models\User;

class UserTest extends Unit
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

    public function testGetNicknameWhenNicknameEmpty()
    {
        $user = $this->tester->grabFixture('users', 'user1');
        expect($user->getNickname())->equals('1');
    }

    public function testGetNicknameWhenNicknameNotEmpty()
    {
        $user = $this->tester->grabFixture('users', 'user2');
        expect($user->getNickname())->equals('Adele-McDele');
    }

    public function testGetPostCount()
    {
        $user = $this->tester->grabFixture('users', 'user1');
        expect($user->getPostCount())->equals(2);
    }

    public function testFollowUser()
    {
        $user1 = $this->tester->grabFixture('users', 'user1');
        $user3 = $this->tester->grabFixture('users', 'user3');

        $user3->followUser($user1);

        $this->tester->seeRedisKeyContains('user:1:followers', 5);
        $this->tester->seeRedisKeyContains('user:5:subscriptions', 1);

        $this->tester->sendCommandToRedis('del', 'user:1:followers');
        $this->tester->sendCommandToRedis('del', 'user:5:subscriptions');
    }

    public function testUnfollowUser()
    {
        $user1 = $this->tester->grabFixture('users', 'user1');
        $user2 = $this->tester->grabFixture('users', 'user2');

        $user2->followUser($user1);

        $this->tester->seeRedisKeyContains('user:1:followers', 4);
        $this->tester->seeRedisKeyContains('user:4:subscriptions', 1);

        $user2->unfollowUser($user1);

        $this->tester->dontSeeInRedis('user:1:followers');
        $this->tester->dontSeeInRedis('user:4:subscriptions');
    }

    public function testCountFollowers()
    {
        $user1 = $this->tester->grabFixture('users', 'user1');
        $user3 = $this->tester->grabFixture('users', 'user3');

        $user3->followUser($user1);

        $this->tester->seeRedisKeyContains('user:1:followers', 5);
        $this->tester->seeRedisKeyContains('user:5:subscriptions', 1);

        expect($user1->countFollowers())->equals(1);

        $this->tester->sendCommandToRedis('del', 'user:1:followers');
        $this->tester->sendCommandToRedis('del', 'user:5:subscriptions');
    }

    public function testCountSubscriptions()
    {
        $user1 = $this->tester->grabFixture('users', 'user1');
        $user3 = $this->tester->grabFixture('users', 'user3');

        $user3->followUser($user1);

        $this->tester->seeRedisKeyContains('user:1:followers', 5);
        $this->tester->seeRedisKeyContains('user:5:subscriptions', 1);

        expect($user3->countSubscriptions())->equals(1);

        $this->tester->sendCommandToRedis('del', 'user:1:followers');
        $this->tester->sendCommandToRedis('del', 'user:5:subscriptions');
    }

    public function testIsFollowUser()
    {
        $user1 = $this->tester->grabFixture('users', 'user1');
        $user2 = $this->tester->grabFixture('users', 'user2');

        $user2->followUser($user1);

        $this->tester->seeRedisKeyContains('user:1:followers', 4);
        $this->tester->seeRedisKeyContains('user:4:subscriptions', 1);

        expect($user2->isfollowUser($user1['id']))->equals(true);

        $this->tester->sendCommandToRedis('del', 'user:1:followers');
        $this->tester->sendCommandToRedis('del', 'user:4:subscriptions');
    }

 public function testIsLikedPost()
    {
        $user1 = $this->tester->grabFixture('users', 'user1');
        $post3 = $this->tester->grabFixture('posts', 'post3');

        $post3->like($user1);

        $this->tester->seeRedisKeyContains('user:1:likes', 3);
        $this->tester->seeRedisKeyContains('post:3:likes', 1);

        expect($user1->isLikedPost($post3['id']))->equals(true);

        $this->tester->sendCommandToRedis('del', 'user:1:likes');
        $this->tester->sendCommandToRedis('del', 'post:3:likes');
    }

 public function testGetMutualSubscriptionsTo()
    {
        $user1 = $this->tester->grabFixture('users', 'user1');
        $user2 = $this->tester->grabFixture('users', 'user2');
        $user3 = $this->tester->grabFixture('users', 'user3');

        $user2->followUser($user1);
        $user3->followUser($user1);
        $user3->followUser($user2);

        $this->tester->seeRedisKeyContains('user:1:followers', 4);
        $this->tester->seeRedisKeyContains('user:4:subscriptions', 1);
        $this->tester->seeRedisKeyContains('user:1:followers', 5);
        $this->tester->seeRedisKeyContains('user:5:subscriptions', 1);
        $this->tester->seeRedisKeyContains('user:4:followers', 5);
        $this->tester->seeRedisKeyContains('user:5:subscriptions', 4);

        expect($user3->getMutualSubscriptionsTo($user1))
            ->equals(User::find()->select('id, username, nickname, about')
                ->where(['id' => 4])->asArray()->all());

        $this->tester->sendCommandToRedis('del', 'user:1:followers');
        $this->tester->sendCommandToRedis('del', 'user:4:subscriptions');
        $this->tester->sendCommandToRedis('del', 'user:4:followers');
        $this->tester->sendCommandToRedis('del', 'user:5:subscriptions');
    }
}