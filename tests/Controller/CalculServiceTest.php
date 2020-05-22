<?php

namespace App\Tests\Util;

use App\Services\CalculService;
use PHPUnit\Framework\TestCase;

class CalculServiceTest extends TestCase
{
    public function testAdd()
    {
        $calculator = new CalculService();
        $result = $calculator->additionner(30, 12);
        $this->assertEquals(42, $result);
    }
}

?>
