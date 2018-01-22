<?php

namespace tests\models;

use app\models\Product;
use app\models\User;

class UserTest extends \Codeception\Test\Unit
{

    public function testFindUserById()
    {
        //expect_that($user = User::findIdentity(100));
        //expect($user->username)->equals('admin');
        //$user = new User();

        expect_not(User::findIdentity(999));
    }

    public function testFindUserByAccessToken()
    {
        //expect_that($user = User::findIdentityByAccessToken('100-token'));
        //expect($user->username)->equals('admin');

        //expect_not(User::findIdentityByAccessToken('non-existing'));
    }

    /**
     * @depends testFindUserByUsername
     */
    public function testValidateUser($user)
    {
        $user = User::findByEmail('');
        expect_that($user->validateAuthKey('test100key'));
        expect_not($user->validateAuthKey('test102key'));

        $user = new User();
        $user->phone = '+375445591455';
        $user->validate();

        var_dump($user->errors);
        die;
        expect_that($user->validatePassword('admin'));
        expect_not($user->validatePassword('123456'));        
    }

}
