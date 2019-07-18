<?php


    function handleError($errorInfo)
    {
        $errorText= 'Error type : '.$errorInfo[0].PHP_EOL;
        $errorText .= $errorInfo[1].PHP_EOL;

        showError($errorText);

    }