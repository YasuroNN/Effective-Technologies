<?php

function eratosthenes($input) {
	$max = intval(sqrt($input));
	$sieve = array_fill(0, $input, true);
	$sieve[0]=false;
	for ($i = 2; $i <= $max; $i++) {
		if ($sieve[$i - 1]) {
			for ($j = $i**2; $j <= $input; $j += $i)
				$sieve[$j - 1] = false;
		}
	}
	
	$result = array();
	foreach ($sieve as $i => $prime) 
		if ($prime) $result[] = $i + 1;
	
	return $result;
}

echo (array_sum(eratosthenes(2000000)));

?>