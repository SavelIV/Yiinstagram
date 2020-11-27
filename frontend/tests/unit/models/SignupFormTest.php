<?php
namespace frontend\tests\unit\models;

use frontend\tests\fixtures\UserFixture;
use frontend\modules\user\models\SignupForm;

class SignupFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::class,
            ]
        ]);
    }

    public function testTrimUsername()
    {
        $model = new SignupForm([
            'username' => ' some_username ',
            'email' => 'some_email@example.com',
            'password' => '12345',
        ]);

        $model->signup();

        expect($model->username)->equals('some_username');
    }

    public function testUsernameRequired()
    {
        $model = new SignupForm([
            'username' => '',
            'email' => 'some_email@example.com',
            'password' => 'some_password',
        ]);

        $model->signup();

        expect($model->getFirstError('username'))
            ->equals('Username cannot be blank.');
    }

    public function testUsernameTooShort()
    {
        $model = new SignupForm([
            'username' => 's',
            'email' => 'some_email@example.com',
            'password' => 'some_password',
        ]);

        $model->signup();

        expect($model->getFirstError('username'))
            ->equals('Username should contain at least 2 characters.');
    }

    public function testUsernameTooLong()
    {
        $model = new SignupForm([
            'username' => 'sssss sssss sssss sssss sssss sssss s',
            'email' => 'some_email@example.com',
            'password' => 'some_password',
        ]);

        $model->signup();

        expect($model->getFirstError('username'))
            ->equals('Username should contain at most 30 characters.');
    }


    public function testTrimEmail()
    {
        $model = new SignupForm([
            'username' => 'some_username',
            'email' => ' some_email@example.com ',
            'password' => '12345',
        ]);

        $model->signup();

        expect($model->email)->equals('some_email@example.com');
    }

    public function testEmailRequired()
    {
        $model = new SignupForm([
            'username' => 'some_username',
            'email' => '',
            'password' => 'some_password',
        ]);

        $model->signup();

        expect($model->getFirstError('email'))
            ->equals('Email cannot be blank.');
    }


    public function testEmailUnique()
    {
        $model = new SignupForm([
            'username' => 'some_username',
            'email' => 'aliya43@yahoo.com',
            'password' => 'some_password',
        ]);

        $model->signup();

        expect($model->getFirstError('email'))
            ->equals('This email address has already been taken.');
    }

    public function testPasswordRequired()
    {
        $model = new SignupForm([
            'username' => 'some_username',
            'email' => 'some_email@example.com',
            'password' => '',
        ]);

        $model->signup();

        expect($model->getFirstError('password'))
            ->equals('Password cannot be blank.');
    }

    public function testPasswordTooShort()
    {
        $model = new SignupForm([
            'username' => 'some_username',
            'email' => 'some_email@example.com',
            'password' => 'pass.',
        ]);

        $model->signup();

        expect($model->getFirstError('password'))
            ->equals('Password should contain at least 6 characters.');
    }


}