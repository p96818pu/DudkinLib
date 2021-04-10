<?php

use dudkin\DudkinException;
use dudkin\LineEq;
use PHPUnit\Framework\TestCase;

class LineEqTest extends TestCase {

    /**
     * @dataProvider providerSolveLineEq
     */
    public function testSolveLineEq($a, $b, $result) {
        $line = new LineEq();
        $this->assertEquals($result, $line->solveLineEq($a, $b));
    }

    public function providerSolveLineEq() {
        return array(
            array(6, 42, [-7]),
            array(5, 15, [-3])
        );
    }

    /**
     * @dataProvider providerDudkinException
     */
    public function testDudkinException($a, $b, $result) {
        $line = new LineEq();
        $this->expectException(DudkinException::class);
        $this->expectExceptionMessage('No roots');
        $this->assertEquals($result, $line->solveLineEq($a, $b));
    }

    public function providerDudkinException() {
        return array(
            array(0, 25, array(0)),
            array(0, 50, array(0))
        );
    }
}