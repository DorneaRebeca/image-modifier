<?php


    function canExecuteHeight($payload)
    {
        if(!isset($payload[heightCommand]))
            return false;
        if( isset($payload[formatCommand]) )
            return false;
        return true;
    }


    function executeHeight($payload) {

        if(!canExecuteHeight($payload))
            return $payload;
        $heightValue = (float)$payload[heightCommand];

        $payload[imageKey]->scaleImage( 0, $heightValue );

        return $payload;
    }
