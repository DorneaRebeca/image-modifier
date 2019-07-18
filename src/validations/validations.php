<?php

const extensionPattern = '/\w+\.[jpeg|jpg|png]+$/';
const imageNamePattern = '/^(\w+[0-9]*)\.[jpg|jpeg|png]+/';
const integerPattern = '/^[0-9]+$/';
const formatPattern = '/^[0-9]+:[0-9]+/';


/**
 * @param $payload
 * @return array array containing error type and the output for it
 *  @author Dornea Rebeca  <rebeca.dornea@evozon.com>
 */
function validateMandatoryArguments($payload) : array
    {
        $errorList = [];
        if(!array_key_exists(INPUT_KEY, $payload))
            $errorList[] = ["input key doesn't exist" => "Fatal error : the input file argument doesn't exist or was typed incorrectly. Please retry :)"];

        if(!array_key_exists(OUTPUT_KEY, $payload))
            $errorList[] = ["output key doesn't exist" => "Fatal error : the output file argument doesn't exist or was typed incorrectly. Please retry :)"];

        return $errorList;
    }

/**
 * Verifies if the paths given in the command line are accessible or if they exist
 * @param $payload
 * @return array containing errors found by incorrect paths
 *  @author Dornea Rebeca  <rebeca.dornea@evozon.com>
 */
function validatePaths($payload) : array
    {
        $errorList = [];
        if(isset($payload[INPUT_KEY]) && !preg_match( imageNamePattern, $payload[INPUT_KEY]) && !file_exists($payload[INPUT_KEY]))
            $errorList[] = ["file cannot be accessed" => "Fatal error : the path introduced for the input image cannot be accessed. Please write the correct path  :)"];

        if(isset($payload[INPUT_KEY]) && preg_match(imageNamePattern, $payload[INPUT_KEY]) &&  !file_exists(DEFAULT_PATH.$payload[INPUT_KEY]))
            $errorList[] = ["file cannot be accessed" => "Fatal error : the  image doesn't exist in the predefined path. Please write the correct path  :)"];

        if( isset($payload[OUTPUT_KEY]) && !preg_match(imageNamePattern, $payload[OUTPUT_KEY]))
        {
            /**
             * Extracts the path for output without the name for the image that will be saved in the end.
             */
            $outputPath = substr($payload[OUTPUT_KEY], 0, strrpos($payload[OUTPUT_KEY],'/'));

            if( !file_exists($outputPath))
                $errorList[] = ["file cannot be accessed" => "Fatal error : the path introduced for the output image cannot be accessed. Please write the correct path  :)"];
    }

        if( array_key_exists(WATERMARK, $payload) && !file_exists($payload[WATERMARK]))
            $errorList[] = ["file cannot be accessed" => "Fatal error : the path introduced for the watermark image cannot be accessed. Please write the correct path  :)"];
        return $errorList;
    }

/**
 * Verifies if all dimensions are given in command line in pixel format
 * @param $payload
 * @return array containing errors found by incorrect number formats
 *  @author Dornea Rebeca  <rebeca.dornea@evozon.com>
 */
function validatePixels($payload) : array
    {
        $errorList = [] ;
        if(isset($payload[WIDTH_COMMAND]))
        {
            if(!preg_match(integerPattern, $payload[WIDTH_COMMAND]))
                $errorList[] = ["not a number" => "Fatal error : the width you introduced must be an integer :)"];
        }

        if(isset($payload[HEIGHT_COMMAND]))
        {
            if(!preg_match(integerPattern, $payload[HEIGHT_COMMAND]))
                $errorList[] = ["not a number" => "Fatal error : the height you introduced must be an integer :)"];
        }

        if( isset($payload[FORMAT_COMMAND]))
        {
            if(!preg_match(formatPattern, $payload[FORMAT_COMMAND]))
                $errorList[] = ["incorrect format" => "Fatal error : the format argument you introduced is not correct. Check --help argument for more information :)"];
        }
        return $errorList;
    }

/**
 * Creates a list of errors containing extensions not supported by app
 * @param $payload
 * @return array containing errors found by unsupported extensions
 *  @author Dornea Rebeca  <rebeca.dornea@evozon.com>
 */
function validateExtension($payload) : array
    {
        $errorList = [] ;
        if(array_key_exists(INPUT_KEY, $payload) && !preg_match(extensionPattern, $payload[INPUT_KEY]))
            $errorList[] = ["incorrect extension" => "Fatal error : the extension you introduced for the input file is not supported by this application :)"];

        if(array_key_exists(OUTPUT_KEY, $payload) && !preg_match(extensionPattern, $payload[OUTPUT_KEY]))
            $errorList[] = ["incorrect extension" => "Fatal error : the extension you introduced for the output file is not supported by this application :)"];

        if(array_key_exists(WATERMARK, $payload) && !preg_match(extensionPattern, $payload[WATERMARK]))
            $errorList[] = ["incorrect extension" => "Fatal error : the extension you introduced for the watermark is not supported by this application :)"];

        return $errorList;

    }


/**
 * Verifies if the arguments given in the command line are correct or not
 * @param $payload
 * @return array containing errors found by incorrect command names
 *  @author Dornea Rebeca  <rebeca.dornea@evozon.com>
 */
function validateCommands($payload) : array
    {
        $correctCommands = [INPUT_KEY, OUTPUT_KEY, WIDTH_COMMAND, HEIGHT_COMMAND, HELP_COMMAND, FORMAT_COMMAND, WATERMARK];
        $errorList = [] ;
        do{
            print key($payload).PHP_EOL;
            if(!in_array(key($payload), $correctCommands))
            {
                $errorList[] = ["incorrect command" => "Fatal error : the argument you introduced not correct :)"];
            }
        }while ( next($payload) );

        return $errorList;

    }


/**
 * Creates an array of all errors found and redirect it to the error handler
 * If no error is found it will return the information received
 * @param $payload
 * @return mixed
 *  @author Dornea Rebeca  <rebeca.dornea@evozon.com>
 */
function validate($payload)
    {
        $errorList = validateMandatoryArguments($payload);

        $errorList = array_merge($errorList, validateCommands($payload));
        $errorList = array_merge($errorList, validatePaths($payload));
        $errorList = array_merge($errorList, validateExtension($payload));
        $errorList = array_merge($errorList, validatePixels($payload));

        if(!empty($errorList))
            handleError($errorList);

        return $payload;
    }