<?php
require_once("./EquilibriumIndex.php");
class EquilibriumIndex extends PHPUnit_Framework_TestCase
{
	public function testCase()
	{
		// Should be 3
		$arr = [1,1,1,1,2,2];
		$this->assertEquals(3, getEquilibriums($arr));
		// Should be 3
		$arr = [1.0,1,1,1,2,2];
		$this->assertEquals(3, getEquilibriums($arr));
		// Should be -1 because no index 
		$arr = [1,1,1,1,1,2,2];
		$this->assertEquals(-1, getEquilibriums($arr));
	}
}
