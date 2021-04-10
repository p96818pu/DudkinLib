<?php

use PHPUnit\Framework\TestCase;
use Bezrukov\MyLog;

class MyLogTest extends TestCase
{

     public function testLog(){
        $this->expectOutputString("equation!");
         MyLog::log("equation!");
        MyLog::write();
     }
     public function testInstance() {
        $this->assertInstanceOf(MyLog::class, MyLog::Instance());
    }
}
