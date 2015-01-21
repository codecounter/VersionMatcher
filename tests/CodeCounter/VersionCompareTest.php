<?php

namespace CodeCounter;

/**
 * Test php internal function `version_compare`, which `VersionCompare` based on
 */
class VersionCompareTest extends \PHPUnit_Framework_TestCase {

    public function testAll () {
        // 2.0 > 1.0
        $this->assertEquals(version_compare('2.0', '1.0'), 1);

        // 2.0 > 1.0.0
        $this->assertEquals(version_compare('2.0', '1.0.0'), 1);

        // 1.10.0 > 1.2.0
        $this->assertEquals(version_compare('1.10.0', '1.2.0'), 1);

        // 1.0 = 1.0
        $this->assertEquals(version_compare('1.0', '1.0'), 0);

        // 1.0 < 1.0.0
        $this->assertEquals(version_compare('1.0', '1.0.0'), -1);

        // '' < 1.0.0
        $this->assertEquals(version_compare('', '1.0.0'), -1);
    }
    
}

?>