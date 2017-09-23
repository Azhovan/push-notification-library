<?php

namespace PushNotification\Message;

interface GoogleMessage
{
    /**
     * generate message notification block for fcm
     * @return mixed
     */
    public function notification();
}