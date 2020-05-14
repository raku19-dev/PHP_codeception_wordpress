<?php



class Dashboard
{
    protected $tester;
    protected $url;

    public function __construct(AcceptanceTester $I)
    {
        $this->tester = $I;
        $this->url='/wp-admin.php';
    }

    public function openDashboard(AcceptanceTester $I)
    {
        $I->amOnPage('/wp-admin/');
    }
}