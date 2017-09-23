<?php

namespace PushNotification\Message\Config;


trait Provider
{

    /**
     * @return string
     */
    public static function google()
    {
        return 'google';
    }

    /**
     * @return string
     */
    public static function apple()
    {
        return 'apple';
    }


}