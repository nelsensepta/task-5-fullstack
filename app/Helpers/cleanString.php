<?php
// namespace App\Helpers;

function cleanString($stringValue, $mode = 'html')
{
    switch ($mode) {
        case 'html':
            return htmlspecialchars($stringValue, ENT_QUOTES, 'UTF-8');
            break;
        case 'valid_name':
            $string = preg_replace('/[^a-zA-Z0-9 \-_ ]/', ' ', $stringValue); //filter karakter unik dan replace dengan kosong ('')
            $trim = trim($string); // hilangkan spasi berlebihan dengan fungsi trim
            return strtolower(str_replace(" ", "-", $trim)); // hilangkan spasi, kemudian ganti spasi dengan tanda strip (-)
            break;
    }
}