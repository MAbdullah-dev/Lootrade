<?php
namespace App\Constants;

class SocialProviders
{
    const GOOGLE = 'google';
    const TWITTER = 'twitter';
    const DISCORD = 'discord';
    const KICK = 'kick';
    const TWITCH = 'twitch';

    public static function all()
    {
        return [
            self::GOOGLE,
            self::TWITTER,
            self::DISCORD,
            self::KICK,
            self::TWITCH,
        ];
    }
}