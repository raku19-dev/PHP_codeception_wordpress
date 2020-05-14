<?php

use Codeception\Step\Argument\PasswordArgument;

class LogIn
{
    protected $tester;
    protected $url;

    public function __construct(AcceptanceTester $I)
    {
        $this->tester = $I;
        $this->url='/wp-login.php';
    }

    public function signInSuccessfully($username,$password)
    {
        $I = $this->tester;

        $I->amOnPage($this->url);
        $I->seeInTitle("Log In ‹ Introduction to WordPress — WordPress");
        $I->see('Introduction to WordPress');
        $I->fillField('Username or Email Address',$username);
        $I->fillField('Password',new PasswordArgument($password));
        $I->click('Log In');
        $I->seeInTitle("Dashboard ‹ Introduction to WordPress — WordPress");
    }
}