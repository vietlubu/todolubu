<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class SampleTest extends TestCase
{
    /**
     * Test get sum
     *
     * @return void
     */
    public function testGetSum() {
        $want = 6;
        $got = 3 + 3;

        $this->assertEquals($want, $got);
    }
}