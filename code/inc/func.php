<?php

function ParseCode ($code)
{
    $code = preg_replace_callback_array(
        ['/<code>(.*?)\<\/code>/s' => function (&$matches) {return "<code>".htmlspecialchars($matches[1])."</code>";}],
        $code
    );    
    $code_array = explode ("\n", $code);
    foreach ($code_array as &$line) {
        if (preg_match('/^##/',$line)) {
            $line = str_replace(array("\n", "\r"), '', $line);
            $line = "<strong>".$line."</strong>".PHP_EOL;
        }
        if (preg_match('/^# /',$line)) {
            $line = str_replace(array("\n", "\r"), '', $line);
            $line = '<i>'.$line.'</i>'.PHP_EOL;
        }
        /*
        if (strpos($line,'//')) {
            $line = str_replace(array("\n", "\r"), '', $line);
            $line = str_replace('//', '<i>//', $line).'</i>'.PHP_EOL;
        }
        */
        if (preg_match('/^\/\/ /',$line)) {
            $line = str_replace(array("\n", "\r"), '', $line);
            $line = '<i>'.$line.'</i>'.PHP_EOL;
        }
    }
    $code = implode ("", $code_array);
    return $code;
}

?>
