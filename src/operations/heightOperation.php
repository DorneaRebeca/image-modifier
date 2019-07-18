<?php


    function canExecuteHeight($payload)
    {
        if(!isset($payload[HEIGHT_COMMAND]))
            return false;
        if( isset($payload[FORMAT_COMMAND]) )
            return false;
        return true;
    }

/**
 *
 *  Executes image resizing given a fixed width keeping the original aspect ratio
 * @param $payload
 * @return array with initial info with the modified image
 *  @author Dornea Rebeca  <rebeca.dornea@evozon.com>
 */
    function executeHeight($payload) {

        if(!canExecuteHeight($payload))
            return $payload;
        $heightValue = (float)$payload[HEIGHT_COMMAND];

        $payload[IMAGE_KEY]->scaleImage( 0, $heightValue );

        return $payload;
    }
