<?php

namespace CodeCounter;

use PHPUnit\Framework\TestCase;

class VersionMatcherTest extends TestCase {

    public function testSimple () {

        // 2.0 > 1.0
        $this->assertTrue(\CodeCounter\VersionMatcher::test('2.0 > 1.0'));

        // 1.1.0 < 1.2.0
        $this->assertTrue(\CodeCounter\VersionMatcher::test('1.1.0 < 1.2.0'));

        // 1.10.0 > 1.2.0
        $this->assertTrue(\CodeCounter\VersionMatcher::test('1.10.0 > 1.2.0'));

    }
//
//    public function testParam () {
//        // 2.0 > 1.0
//        $this->assertTrue(
//            \CodeCounter\VersionMatcher::test('ver > 1.0', array('ver' => '2.0'))
//        );
//
//        // 1.1.0 >= 1.1.0
//        $this->assertTrue(
//            \CodeCounter\VersionMatcher::test('ver >=1.0.0', array('ver' => '1.1.0'))
//        );
//    }
//
//    public function testLogic () {
//        // 1.0 < 1.5.0 < 2.0
//        $this->assertTrue(
//            \CodeCounter\VersionMatcher::test('ver > 1.0 && ver < 2.0', array('ver' => '1.5.0'))
//        );
//
//        // 1.0 < 1.5.0 < 2.0
//        $this->assertFalse(
//            \CodeCounter\VersionMatcher::test('ver < 1.0 || ver > 2.0', array('ver' => '1.5.0'))
//        );
//    }
//
//    public function testDefault () {
//        // 1.5.0 > 1.0.0
//        $this->assertTrue(
//            \CodeCounter\VersionMatcher::test('>1.0.0', array('ver' => '1.5.0'), array('defaultField' => 'ver'))
//        );
//
//        // 1.1.0 > 1.1.0
//        $this->assertTrue(
//            \CodeCounter\VersionMatcher::test('1.1.0', array('ver' => '1.1.0'), array('defaultField' => 'ver'))
//        );
//    }
}

?>