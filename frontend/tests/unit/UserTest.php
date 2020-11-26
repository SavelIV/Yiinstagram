<?php
namespace frontend\tests;

use yii\test\ActiveFixture;
use Yii;
use frontend\tests\fixtures\UserFixture;
use Codeception\Test\Unit;

class UserTest extends Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    public function _fixtures()
    {
        return ['users' => UserFixture::class];
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
}