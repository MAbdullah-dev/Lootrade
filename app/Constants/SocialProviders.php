<?php
namespace App\Constants;

class SocialProviders
{
    const GOOGLE = 'google';
    const TWITTER = 'twitter';
    const DISCORD = 'discord';

    public static function all()
    {
        return [
            self::GOOGLE,
            self::TWITTER,
            self::DISCORD,
        ];
    }
}