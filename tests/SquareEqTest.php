<?php

use dudkin\DudkinException;
use dudkin\SquareEq;
use PHPUnit\Framework\TestCase;

class SquareEqTest extends TestCase {

    /**
     * @dataProvider providerSolve
     */
    public function testSolve($a, $b, $c, $result) {
        $square = new SquareEq();
        $this->assertEquals($result, $square->solve($a, $b, $c));
    }

    public function providerSolve() {
        return array(
            array(0, 3, 9, array(-3)),
            array(1, 2, 1, array(-1)),
            array(10, 25, 10, array(-0.5, -2))
        );
    }

    /**
     * @dataProvider providerDudkinException
     */
    public function testDudkinException($a, $b, $c, $result) {
        $square = new SquareEq();
        $this->expectException(DudkinException::class);
        $this->expectExceptionMessage('No roots');
        $this->assertEquals($result, $square->solve($a, $b, $c));
    }

    public function providerDudkinException() {
        return array(
            array(8, 4, 2, array(-48)),
            array(5, 2, 1, array(-16))
        );
    }
}