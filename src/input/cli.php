<?php

    const command = 0;
    const value = 1;


/**
 *  Creates the array containing the input information structured in an array argument => value
 *  @author Dornea Rebeca  <rebeca.dornea@evozon.com>
 * @param $argv
 * @return array containing all the information given in input
 */
function createArrayFromInput($argv)
    {
        $payload = [];
        if(array_search(HELP_COMMAND, $argv))
        {
            $payload[HELP_COMMAND] = HELP_COMMAND;
            return $payload;
        }

        for ($i = 1; $i < sizeof($argv); $i++){
            $inputParted = explode('=', $argv[$i]);

            if(sizeof($inputParted)>1)
                $payload[$inputParted[command] ] = $inputParted[value];
            else
                $payload[$inputParted[command] ] = ' ';

        }
        return $payload;
    }

