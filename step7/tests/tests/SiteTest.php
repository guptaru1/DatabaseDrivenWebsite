<?php


class SiteTest extends \PHPUnit\Framework\TestCase
{

    public function test_localize() {
        $site = new Felis\Site();
        $localize = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize($site);
        }
        $this->assertEquals('test_', $site->getTablePrefix());

        $site->setEmail('guptaru1@msu.edu');
        $site->setRoot('guptaru1');

        $this->assertEquals('guptaru1', $site->getRoot());
        $this->assertEquals('guptaru1@msu.edu', $site->getEmail());
    }

}