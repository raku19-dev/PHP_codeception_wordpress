<?php

use Codeception\Util\Locator;

class Post
{
    public function addNewPost(AcceptanceTester $I)
    {
        $I->click('Posts');
        $I->amOnPage('/wp-admin/edit.php');
        $I->seeInTitle("Posts ‹ Introduction to WordPress — WordPress");
        $I->click('Add New');
        $I->amOnPage('/wp-admin/post-new.php');
        $I->seeInTitle("Add a New Post ‹ Introduction to WordPress — WordPress");
    }

    public function enterTitleAndText(AcceptanceTester $I,$title,$text)
    {
        $I->amOnPage("/wp-admin/post-new.php");
        $I->fillField(Locator::find('input',['id'=>'title']),$title);
        $I->fillField(Locator::find('textarea',['id'=>'content']),$text);
        $I->click('Publish');
        $I->click('Update');
    }


    public function findAndOpenPostByTitle(AcceptanceTester $I,$title)
    {
        $preview = "“{$title}” (Edit)";
        $I->click('All Posts');
        $I->amOnPage('/wp-admin/edit.php');
        $I->seeInTitle("Posts ‹ Introduction to WordPress — WordPress");
        $I->click(Locator::find('a',['aria-label'=>$preview]));
    }

    public function assertTitleAndTextOfPage(AcceptanceTester $I,$title,$text)
    {
        $I->see($title);
        $I->see($text);
    }
}