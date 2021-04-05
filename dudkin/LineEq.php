<?php

namespace dudkin;

Class LineEq {
	protected $x;
	
	public function solveLineEq ($a,$b) {
		if ($a == 0){
		  throw new DudkinException('No roots');
		}
		MyLog::log('This is line equation');
		return $this->x= array(-$b / $a);
	}
}
?>