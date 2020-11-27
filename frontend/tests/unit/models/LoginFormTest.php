<?php namespace frontend\tests\unit\models;

use frontend\tests\fixtures\UserFixture;
use frontend\modules\user\models\LoginForm;


class LoginFormTest extends \Codeception\Test\Unit
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

    public function testEmailRequired()
    {
        $model = new LoginForm([
            'email' => '',
            'password' => 'some_password',
        ]);

        $model->login();

        expect($model->getFirstError('email'))
            ->equals('Email cannot be blank.');
    }

    public function testPasswordRequired()
    {
        $model = new LoginForm([
            'email' => 'some_email@example.com',
            'password' => '',
        ]);

        $model->login();

        expect($model->getFirstError('password'))
            ->equals('Password cannot be blank.');
    }

    public function testValidatePassword()
    {
        $model = new LoginForm([
            'email' => 'aliya43@yahoo.com',
            'password' => 'wrong', //incorrect
        ]);

        $model->login();

        expect($model->getFirstError('password'))
            ->equals('Incorrect email or password.');
    }


}