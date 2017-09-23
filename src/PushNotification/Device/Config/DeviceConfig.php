<?php

namespace  PushNotification\Device\Config;

Interface DeviceConfig
{
    /** string android device class name  */
    const ANDROID ='\PushNotification\Device\Strategy\Android';

    /** string  ios device class name  */
    const IOS= '\PushNotification\Device\Strategy\AppleIOS';


    const DEVICE_NAMESPACE = '\PushNotification\Device\Strategy\\';



}