<?php



    const width = 0;
    const height = 1;

    function canExecuteFormat($payload)
    {
        if( !isset($payload[FORMAT_COMMAND]) )
            return false;
        return true;
    }

/**
 * @param $formatValue as given in input
 * @return array
 *  @author Dornea Rebeca  <rebeca.dornea@evozon.com>
 */
    function castFormat($formatValue)
    {
        $formatParts = explode(':', $formatValue);
        $widthVal = (float)$formatParts[width];
        $heightVal = (float)$formatParts[height];

        return [$widthVal, $heightVal];
    }


/**
 * Will resize the image given the current format.
 * It takes into considerations all forms the command can take
 * @param $payload
 * @return array with initial info with the modified image
 *  @author Dornea Rebeca  <rebeca.dornea@evozon.com>
 */
function executeFormat($payload) : array
{

    if(!canExecuteFormat($payload))
        return $payload;

    [$formatValueW, $formatValueH] = castFormat($payload[FORMAT_COMMAND]);

    $newWidth = 0;
    $newHeight = 0;

    //command: --width --height --format
    if( isset($payload[WIDTH_COMMAND]) && isset($payload[ HEIGHT_COMMAND ])){
         $newWidth = (float)$payload[WIDTH_COMMAND];
        $newHeight = ($newWidth * $formatValueH)/$formatValueW;


    }

    //command: --width --format
    if( isset($payload[WIDTH_COMMAND]) && !isset($payload[ HEIGHT_COMMAND ])) {
        $newWidth = (float)$payload[WIDTH_COMMAND];
        $newHeight = ($newWidth * $formatValueH)/$formatValueW;


    }

    //command: --height --format
    if( !isset($payload[WIDTH_COMMAND]) && isset($payload[ HEIGHT_COMMAND ])) {
        $newHeight = (float)$payload[HEIGHT_COMMAND];
        $newWidth = ($newHeight * $formatValueW) / $formatValueH;
    }

    //command:  --format
    if( !isset($payload[WIDTH_COMMAND]) && !isset($payload[ HEIGHT_COMMAND ])) {
        $newWidth = (float)($payload[IMAGE_KEY]->getImageWidth());
        $newHeight = ($newWidth * $formatValueH)/$formatValueW;

    }

    $payload[IMAGE_KEY]->scaleImage($newWidth, $newHeight);

    return $payload;
}