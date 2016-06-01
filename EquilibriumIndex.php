<?php

/**
 * Efficient unction to find equalibrium value in array of floats
 * or integers. 
 *
 * Program runs in O(n*log(n)). Function first itterates over an
 * array and gathers all necessary information the first time around
 * which immidiately sets the time complexity to linear O(n).
 * Information gathered is the sum of all numbers at each index 
 * as well as the total size of index. 
 * This does not use typical PHP functions such as count() or 
 * size of, nor does it use a (for i = 0;... ) for loop for the
 * sake of effieciency.
 * Once sums are found, the total of all numbers (largest sum) is
 * found and devided by two. This number is searched for in the
 * original array as it indicates the lower bound to that index
 * is the half-way sum of the total array.
 * This function takes advantage of the fact the the array of 
 * summed numbers is already sorted, taking away the need for
 * creating a b-tree and just using binary-search
 *
 * @category 	[Doesn't apply] 
 * @package  	[Doesn't apply]
 * @author	Alexander Kleinhans
 * @copyright 	[Doesn't apply]	
 * @licence	MIT
 * @version	0.1
 * @link	[Doesn't apply]
 * @see		All comments
 * @since	0.1
 */


# Put a valid docblock here!
function getEquilibriums($arr) {
	/*	
	 * There's no avoiding having to go over every
	 * number at least once if we need the sum, so
	 * let's efficiently find the sum at each index
	 * by itterating over the array once.
	*/
	$sums = array();
	/*
	 * We also need to use floats in-case the end result
	 * is a decimal and we have floats and ints mixed.
	*/
	$total = 0.0;
	/*
	 * We will need to use count to index the last element
	 * of the sums array. Although we could index it in php
	 * by using the function $sums[sizeof($sums)], this
	 * would likely still require itterating over the array
	 * again to find sizeof(sums).
	 * It's probably better to just do two operations although
	 * this detail could be performance tested.
	*/
	$count = 0;
	/*
	 * Foreach is better than (for int i = 0; etc..) because
	 * we would have to find the index at O(n) each time we
	 * indexed i, so it would immidiatly run O(n^2). Foreach
	 * allows us to itterate through it once at O(n). Even 
	 * though in reality, (for int i = 0; etc..) is O((n^2)/2),
	 * it's still essentially O(n^2).
	*/
	foreach ($arr as $value) {
		/*
		 * Exception handling is optional, depending
		 * on useage and how critical the function is.
		*/

		// if (!is_int($value) || !is_float($value)) {
		// 	throw new Exception("NAN value passed to getEqualibrium");
		// }

		/*
		 * Once again, incrementing count for efficiency.
		*/
		$count++;
		/*
		 * Since we are using floats, we need to type cast
		 * the value in-case it's an int.
		*/
		$total += (float)$value;
		array_push($sums, $total);
	}
	/*
	 * Once we have a total sum at each, we must find the total
	 * sum, devide it by two, and see if there is an partial 
	 * sum that is that number.
	 * i.e. if we had array [1,1,1,1,2,2], 
	 * 	[0:3] = 4	(1+1+1+1)
	 * 	[3:end] = 4	(2+2)
	 * 	total = 8
	 * 	therefore, since 8/2 = 4:
	 * 		index = 3
	 * If, however, the array was [1,1,1,1,1,2,2] (5 1s), there
	 * would be no equalibrium.
	*/

	$half_total = $total/2;  // We already know total is a float.
	
	/*
	 * Searching for the number in an unsorted list such
	 * as using (in_array) will result in a O(n) search time.
	 * If this was C, C++, Java or Go, I might implement
	 * a b-tree to sort the array as I built it, then index
	 * it at O(log(n)). If building the tree is necessary, it would
	 * result in O(log(n)*log(n)) (because of index time for adding
	 * the elements) which is still fine because it's basically
	 * the same as O(log(n)).
	
	/*
	 * Luckely, the array is already sorted and we can just
	 * use binary search without a b-tree to find the value
	 * at O(log(n)) time complexity.
	*/
	
	/*
	 * I shamelessly ripped a binary search function above.
	 * I did not write it, but I did test it.
	*/

	$result = binarySearch($half_total, $sums, 0, $count - 1);
	/*
	 * $count just came in handy a second time.
	*/
	return $result;
}

/*
 * Shamelessly pulled from:
 * http: *www.stoimen.com/blog/2011/12/26/computer-algorithms-binary-search/
 */
function binarySearch($index, $arr, $left, $right) 
{
	if ($left > $right) {
		return -1;
	}
	$mid = ($left + $right) >> 1;
 
	if ($arr[$mid] == $index) {
		return $mid;
	} elseif ($arr[$mid] > $index) {
		return binarySearch($index, $arr, $left, $mid-1);
	} elseif ($arr[$mid] < $index) {
		return binarySearch($index, $arr, $mid+1, $right);
	}
}
