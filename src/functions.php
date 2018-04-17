<?php

namespace recyger\encry\int;

const ACSII_URL = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789-.';

function randomate(string $dictionary): string
{
    $array = str_split($dictionary);
    shuffle($array);

    return implode('', $array);
}
