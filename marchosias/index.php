<?php

include __DIR__ . '/vendor/autoload.php';
include __DIR__. '/commands/command.php';

use Discord\CommandClient\Command;
use Discord\Discord;
use Discord\Parts\Embed\Author;
use Discord\Parts\Embed\Embed;

use function React\Promise\Stream\first;

$path = __DIR__. '/json/config.json';
$data = json_decode(file_get_contents($path));
$token = $data->token;
$prefix = $data->prefix;


$discord = new Discord([
'token' =>$token
]);


$discord->on('ready', function ($discord) {
    echo "marchosias is ready to serve", PHP_EOL;


    // Listen for messages.
    $discord->on('message', function ($message, $discord) {
        if ($message->author->bot) {
            return;
        }
        global $prefix;

        //if the message starts with: ]
        if (str_starts_with($message->content, $prefix )) {
            //remove the ']' and make the message content into a array
            $msgArr = explode(' ', ltrim($message->content, $prefix));

            $guild = $message->channel->guild;
            $user =  $message->mentions->toArray();
            $author = $message->author;
            $channel = $message->channel;

            print_r($author);
            switch ($msgArr[0]) {
                //avatar command
                case 'av':
                    av($message, $discord, $msgArr);
                    break;
                //chance command
                case 'chance':
                    chanceCommand($message, $discord, $msgArr);
                    break;
                /// TODO FIX HELP FUNCTION SO IT SENDS EMBED TO DM
                case 'help':
                    help($message, $discord, $msgArr);
                    break;
                //if no command is mentioned
                default:
                    return;
            }


        }
    });
});

$discord->run();
