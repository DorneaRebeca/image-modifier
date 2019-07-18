<?php



    const width = 0;
    const height = 1;

    function canExecuteFormat($payload)
    {
        if( !isset($payload[formatCommand]) )
            return false;
        return true;
    }

    function castFormat($formatValue)
    {
        $formatParts = explode(':', $formatValue);
        $widthVal = (float)$formatParts[width];
        $heightVal = (float)$formatParts[height];

        return [$widthVal, $heightVal];
    }



function executeFormat($payload) {

    if(!canExecuteFormat($payload))
        return $payload;

    [$formatValueW, $formatValueH] = castFormat($payload[formatCommand]);

    $newWidth = 0;
    $newHeight = 0;

    //comanda --width --height --format
    if( isset($payload[widthCommand]) && isset($payload[ heightCommand ])){
         $newWidth = (float)$payload[widthCommand];
        $newHeight = ($newWidth * $formatValueH)/$formatValueW;
        print "in --w  --h --f".PHP_EOL.$newHeight.' '.$newWidth.PHP_EOL;


    }

    //comanda --width --format
    if( isset($payload[widthCommand]) && !isset($payload[ heightCommand ])) {
        $newWidth = (float)$payload[widthCommand];
        $newHeight = ($newWidth * $formatValueH)/$formatValueW;
        print "in --w --f".PHP_EOL.$newHeight.' '.$newWidth.PHP_EOL;


    }

    //comanda --height --format
    if( !isset($payload[widthCommand]) && isset($payload[ heightCommand ])) {
        $newHeight = (float)$payload[heightCommand];
        $newWidth = ($newHeight * $formatValueW) / $formatValueH;
        print "in --h --f".PHP_EOL.$newHeight.' '.$newWidth.PHP_EOL;
    }

    //comanda  --format
    if( !isset($payload[widthCommand]) && !isset($payload[ heightCommand ])) {
        $newWidth = (float)($payload[imageKey]->getImageWidth());
        $newHeight = ($newWidth * $formatValueH)/$formatValueW;
        print "in --f".PHP_EOL.$newHeight.' '.$newWidth.PHP_EOL;

    }

    $payload[imageKey]->scaleImage($newWidth, $newHeight);

    return $payload;
}