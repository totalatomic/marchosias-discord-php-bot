<?php

use Discord\Discord;
use Discord\Parts\Embed\Author;
use Discord\Parts\Embed\Embed;

function av(object $message, object $discord, array $args)
{
    //get the guild
    $guild = $message->channel->guild;
    //get the array of mentioned users
    $user =  $message->mentions->toArray();
    //get the user who called the command
    $author = $message->author;
    //get the channel where the command was called
    $channel = $message->channel;

    $embed = new Embed($discord);

    if ($user) {
        foreach ($user as $u) {
            $embed->setTitle("$u->username's avatar");
            $embed->setImage($u->avatar);
        };
        $embed->setDescription(join(" ", $args));
        return $channel->sendEmbed($embed);
    } else {
        $embed->setImage($author->avatar);
        $embed->setTitle("$author->username's profile picture");
        $embed->setDescription(join(" ", $args));

        return $channel->sendEmbed($embed);
    }
    echo "it works lmao", PHP_EOL;
}

function chanceCommand(object $message, object $discord, array $args)
{
    //get the guild
    $guild = $message->channel->guild;
    //get the array of mentioned users
    $user =  $message->mentions->toArray();
    //get the user who called the command
    $author = $message->author;
    //get the channel where the command was called
    $channel = $message->channel;

    //make the embed
    $chancembed = new Embed($discord);
    $rand = random_int(0, 100);

    $chancembed->setTitle("chance: " . join(" ", $args) . '?');
    $chancembed->setDescription('i give it a ' .  $rand . ' % chance');

    return $channel->sendEmbed($chancembed);
}

function help(object $message, object $discord, array $args){
    //get the guild
    $guild = $message->channel->guild;
    //get the array of mentioned users
    $user =  $message->mentions->toArray();
    //get the user who called the command
    $author = $message->author;
    //get the channel where the command was called
    $channel = $message->channel;

    $helpembed = new Embed($discord);
    

    //once the dm's with info have been send:
    $message->reply('i have send you a dm with the information');
}
