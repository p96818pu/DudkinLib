<?php

namespace dudkin;

use core\EquationInterface;

class SquareEq extends LineEq implements EquationInterface {
    protected function dis($a, $b, $c) {
        return $dis = $b * $b - 4 * $a * $c;
    }

    public function solve($a, $b, $c):array {
        if ($a == 0) {
            return parent::solveLineEq($b, $c);
        }
        $dis = $this->dis($a, $b, $c);
        if ($dis > 0) {
            MyLog::log('This is square Equation');
            $squareDis = sqrt($dis);
            return $this->x = array((-$b + $squareDis) / (2 * $a), (-$b - $squareDis) / (2 * $a));
        }elseif ($dis == 0) {
            return $this->x = array(-$b / (2 * $a));
        }
        throw new DudkinException('No roots');
    }
}