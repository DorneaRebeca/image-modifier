<?php


/**
 * Casts error specific array to a string to be displayed
 * @author Dornea Rebeca  <rebeca.dornea@evozon.com>
 * @param $errorInfo
 */
    function handleError($errorInfo)
    {
        $errorText = '';
        foreach ($errorInfo as $error)
        {
            $currentKey = key ($error);
            $errorText .= $currentKey.':'.PHP_EOL.'     '.$error[$currentKey].PHP_EOL;
        }

        showError($errorText);

    }