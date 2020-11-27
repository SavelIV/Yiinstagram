<?php

namespace frontend\tests\functional;
use frontend\tests\FunctionalTester;

class ContactCest
{
    public function checkContact(FunctionalTester $I)
    {
        $I->amOnRoute('site/contact');
        $I->see('Contact page', 'h1');
    }
}
