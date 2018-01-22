<?php

class LoginFormCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('site/login');
    }

    public function openLoginPage(\FunctionalTester $I)
    {
        $I->see('Login', 'h1');

    }

    // demonstrates `amLoggedInAs` method

    /**
     * @param FunctionalTester $I
     *
     * @throws \_generated\ModuleException
     */
    public function internalLoginById(\FunctionalTester $I)
    {
        //$I->amLoggedInAs(1);
        //$I->amOnPage('/');
        //$I->see('Logout (admin)');
    }

    // demonstrates `amLoggedInAs` method

    /**
     * @param FunctionalTester $I
     *
     * @throws \_generated\ModuleException
     */
    public function internalLoginByInstance(\FunctionalTester $I)
    {
        //$I->amLoggedInAs(\app\models\User::findByEmail('yegor.veselov@gmail.com'));
        //$I->amOnPage('/');
        //$I->see('Logout (admin)');
    }

    /**
     * @param FunctionalTester $I
     */
    public function loginWithEmptyCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', []);
        $I->expectTo('see validations errors');
        $I->see('Email cannot be blank.');
        $I->see('Password cannot be blank.');
    }

    /**
     * @param FunctionalTester $I
     */
    public function loginWithWrongCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', [
            'LoginForm[email]' => 'admin',
            'LoginForm[password]' => 'wrong',
        ]);
        $I->expectTo('see validations errors');
        $I->see('Incorrect email or password.');
    }

    /**
     * @param FunctionalTester $I
     */
    /*public function loginSuccessfully(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', [
            'LoginForm[email]' => 'admin',
            'LoginForm[password]' => 'admin',
        ]);
        $I->see('Logout (admin)');
        $I->dontSeeElement('form#login-form');              
    }*/
}