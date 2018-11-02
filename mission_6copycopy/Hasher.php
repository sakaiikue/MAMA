<?php
/**
 *
 * @copyright  (c) 2011-2017, Cartalyst LLC
 * @link       http://cartalyst.com
 */

/**
 * The salt length.
 *
 * @var int
 */
$saltLength = 22;

/**
 * Create a random string for a salt.
 *
 * @return string
 */
function createSalt()
{
    $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ./';
    $max = strlen($pool) - 1;
    $salt = '';
    for ($i = 0; $i < $saltLength; ++$i) {
        $salt .= $pool[mt_rand(0, $max)];
    }
    return $salt;
}

/**
 * Compares two strings $a and $b in length-constant time.
 *
 * @param  string  $a
 * @param  string  $b
 * @return boolean
 */
function slowEquals($a, $b)
{
    $diff = strlen($a) ^ strlen($b);
    for ($i = 0; $i < strlen($a) && $i < strlen($b); $i++) {
        $diff |= ord($a[$i]) ^ ord($b[$i]);
    }
    return $diff === 0;
}

/**
 * Hash the given value.
 *
 * @param  string  $value
 * @return string
 * @throws \RuntimeException
 */
function password_hash($value)
{
    $salt = createSalt();
    return $salt.hash('sha256', $salt.$value);
}

/**
 * Checks the string against the hashed value.
 *
 * @param  string  $value
 * @param  string  $hashedValue
 * @return bool
 */
function password_verify($value, $hashedValue)
{
    $salt = substr($hashedValue, 0, $$saltLength);
    return slowEquals($salt.hash('sha256', $salt.$value), $hashedValue);
}