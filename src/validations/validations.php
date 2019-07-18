<?php


    function validateMandatoryArguments($payload) : array
    {
        if(!array_key_exists(inputKey, $payload))
            return ["input key doesn't exist" => "Fatal error : the input file argument doesn't exist or was typed incorrectly. Please retry :)"];

        if(!array_key_exists(outputKey, $payload))
            return ["output key doesn't exist" => "Fatal error : the output file argument doesn't exist or was typed incorrectly. Please retry :)"];

    }

    function validatePaths($payload) : array
    {
        if(! file_exists($payload[inputKey]))
            return ["file cannot be accessed" => "Fatal error : the path introduced for the input image cannot be accessed. Please write the correct path  :)"];

        if(! file_exists($payload[outputKey]))
            return ["file cannot be accessed" => "Fatal error : the path introduced for the output image cannot be accessed. Please write the correct path  :)"];

        if( array_key_exists(watermarkCommand, $payload) && !file_exists($payload[watermarkCommand]))
            return ["file cannot be accessed" => "Fatal error : the path introduced for the watermark image cannot be accessed. Please write the correct path  :)"];
    }

    function validateFloats($payload) : array
    {
        //regex pentru validare de numere
    }

    function validate($payload)
    {


    }