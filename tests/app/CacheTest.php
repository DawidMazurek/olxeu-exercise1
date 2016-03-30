<?php


namespace naspersclassifieds\olxeu\app;


class CacheTest extends \PHPUnit_Framework_TestCase
{
    public function testDurability_twoInstancesCreated_objectShoudBeAvailable()
    {
        $key = 'test';
        $value = 1234;

        $sutA = new Cache();
        $sutA->set($key, $value);
        unset($sutA);

        $sutB = new Cache();
        $result = $sutB->get($key);

        $this->assertEquals($result, $result);
    }
}