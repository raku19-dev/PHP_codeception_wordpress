<?php

class Cest
{
    private $username = 'user_wordpress';
    private $password = 'user_wordpress';

    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function enterPageContent(AcceptanceTester $I, LogIn $login)
    {
        $login->signInSuccessfully($this->username,$this->password);
        $pages_input = $this->loadPagesFromSpreadsheet();
        $rows = count($pages_input);
        for ($row = 0; $row < $rows; $row++)
        {
            $title=$pages_input[$row][0];
            $text =$pages_input[$row][1];
            Page::addNewPage($I);
            Page::enterTitleAndText($I,$title,$text);
            Page::findAndOpenPageByTitle($I,$title);
            Page::assertTitleAndTextOfPage($I,$title,$text);
            Dashboard::openDashboard($I);
        }
    }

    public function enterPostContent(AcceptanceTester $I,LogIn $logIn)
    {
        $logIn->signInSuccessfully($this->username,$this->password);
        $post_input = $this->loadPostsFromSpreadSheet();
        $rows = count($post_input);
        for ($row = 0; $row < $rows; $row++)
        {
            $title=$post_input[$row][0];
            $text =$post_input[$row][1];
            Post::addNewPost($I);
            Post::enterTitleAndText($I,$title,$text);
            Post::findAndOpenPostByTitle($I,$title);
            Post::assertTitleAndTextOfPage($I,$title,$text);
        }
    }

    public function _failed(\AcceptanceTester $I)
    {
        // will be executed on test failure
    }

    public function _passed(\AcceptanceTester $I)
    {
        // will be executed when test is successful
    }

    public function loadPagesFromSpreadsheet()
    {
        $filename = 'PagesTestInput.csv';

        if (($h = fopen("{$filename}", "r")) !== FALSE)
        {
            while (($data = fgetcsv($h, 1000, ",")) !== FALSE)
            {
                $pages_input[] = $data;
            }
            fclose($h);
        }

        return $pages_input;
    }

    public function loadPostsFromSpreadSheet()
    {
        $filename = 'PostsTestInput.csv';

        if (($h = fopen("{$filename}", "r")) !== FALSE)
        {
            while (($data = fgetcsv($h, 1000, ",")) !== FALSE)
            {
                $posts_input[] = $data;
            }
            fclose($h);
        }

        return $posts_input;
    }
}
