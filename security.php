<?php
/**
 * Makes a random key with the specified length.
 *
 * @param int $length
 * @return string
 */
function makeKey($length)
{
    $seed = "0123456789abcdefghijklmnopqrstuvwxyz";
    $len = strlen($seed);
    $key = "";

    for ($i=0; $i<$length; $i++) {
        $key .= $seed[ rand(0, $len-1) ];
    }

    return $key;

}
?>