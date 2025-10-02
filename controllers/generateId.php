<?php
function generateID($prefix)
{
    $rand = mt_rand(100000, 999999);
    return $prefix . $rand;
}
