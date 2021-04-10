<?php

/*
 * Convert date to BR format
 * @return string
 */
function convertDate($data): string
{
    $d = explode('-', $data);
    return $d[2]."/".$d[1]."/".$d[0];
}