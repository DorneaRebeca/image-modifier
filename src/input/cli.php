<?php



    const pattern = '/--(?<key>[a-z | -]+)=(?<value>[a-z|0-9|\/|\.|:]+)/';
    const command = 0;
    const value = 1;
    const helpCommand = '--help';





    function createArray($argv)
    {
        $payload = [];
        //$makeArray =
        if(array_search(helpCommand, $argv))
        {
            return helpCommand;
        }

        for ($i = 1; $i < sizeof($argv); $i++){

            /*preg_replace_callback(pattern, function ($match) use (&$payload)
            {
                print $match[1].' '.$match[2].PHP_EOL;

                $payload[ $match[1] ] = $match[2];
            },
                $argv[$i]);
            */

            $inputParted = explode('=', $argv[$i]);
            $transformedCommand = str_replace('--', '',$inputParted[command]);
            $payload[ $transformedCommand ] = $inputParted[value];

        }

        return $payload;
    }

