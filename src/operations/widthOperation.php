<?php



    function canExecuteWidth($payload)
    {
        if(!isset($payload[widthCommand]))
            return false;
        if( isset($payload[formatCommand]) )
            return false;
        return true;
    }


    function executeWidth($payload) {

        if(!canExecuteWidth($payload))
            return $payload;
        $widthValue = (float)$payload[widthCommand];

        $payload[imageKey]->scaleImage( $widthValue, 0 );

        return $payload;
    }







