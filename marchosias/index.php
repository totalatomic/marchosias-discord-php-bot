<?php

include __DIR__ . '/vendor/autoload.php';
include __DIR__. '/commands/command.php';

use Discord\Discord;
use Discord\Parts\Embed\Author;
use Discord\Parts\Embed\Embed;

use function React\Promise\Stream\first;

$discord = new Discord([
    'token' =>//your token here,
]);


$discord->on('ready', function ($discord) {
    echo "marchosias is ready to serve", PHP_EOL;

    // Listen for messages.
    $discord->on('message', function ($message, $discord) {
        if ($message->author->bot) {
            return;
        }
        $prefix = ']';
        //if the message starts with: ]
        if (str_starts_with($message->content, $prefix )) {
            //remove the ']' and make the message content into a array
            $msgArr = explode(' ', ltrim($message->content, $prefix));

            $guild = $message->channel->guild;
            $user =  $message->mentions->toArray();
            $author = $message->author;
            $channel = $message->channel;

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
                //case 'info':
                    //help($message, $discord, $msgArr);
                    //break;
                //if no command is mentioned
                default:
                    return;
            }


        }
    });
});

$discord->run();
