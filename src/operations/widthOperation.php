<?php



    function canExecuteWidth($payload)
    {
        if(!isset($payload[WIDTH_COMMAND]))
            return false;
        if( isset($payload[FORMAT_COMMAND]) )
            return false;
        return true;
    }

/**
 * Executes image resizing given a fixed width keeping the original aspect ratio
 * @param $payload
 * @return array with initial info with the modified image
 *  @author Dornea Rebeca  <rebeca.dornea@evozon.com>
 */
    function executeWidth($payload) {

        if(!canExecuteWidth($payload))
            return $payload;
        $widthValue = (float)$payload[WIDTH_COMMAND];

        $payload[IMAGE_KEY]->scaleImage( $widthValue, 0 );

        return $payload;
    }







