<?php

require_once("./EquilibriumIndex.php");

class EquilibriumIndex extends PHPUnit_Framework_TestCase
{
	public function testCase()
	{
		$arr = array(-7, 1, 5, 2, -4, 3, 0);
		$this->assertEquals(array(3,6), getEquilibriums($arr));
	}
}
