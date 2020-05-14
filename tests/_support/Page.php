<?php

use Codeception\Util\Locator;
use PHPUnit\Framework\Assert;

class Page
{
    public function addNewPage(AcceptanceTester $I)
    {
        $I->click('Pages');
        $I->amOnPage('/wp-admin/edit.php?post_type=page');
        $I->seeInTitle("Pages ‹ Introduction to WordPress — WordPress");
        $I->click('Add New');
        $I->amOnPage('/wp-admin/post-new.php?post_type=page');
        $I->seeInTitle("Add New Page ‹ Introduction to WordPress — WordPress");
    }

    public function enterTitleAndText(AcceptanceTester $I,$title,$text)
    {
        $I->amOnPage("/wp-admin/post-new.php?post_type=page");
        $I->fillField(Locator::find('input',['id'=>'title']),$title);
        $I->fillField(Locator::find('textarea',['id'=>'content']),$text);
        $I->click('Publish');
    }

    public function findAndOpenPageByTitle(AcceptanceTester $I,$title)
    {
        $preview = "Preview “{$title}”";
        $I->click('All Pages');
        $I->amOnPage('/wp-admin/edit.php?post_type=page&ids=100');
        $I->seeInTitle("Pages ‹ Introduction to WordPress — WordPress");
        $I->click(Locator::find('a',['aria-label'=>$preview]));
    }

    public function assertTitleAndTextOfPage(AcceptanceTester $I,$title,$text)
    {
        $I->see($title);
        $I->see($text);
        //$I->seeInTitle({$title}' - Introduction to WordPress)');

        //Assert::assertEquals($title,$actual_title);
        //Assert::assertEquals($text,$actual_text);
    }
}