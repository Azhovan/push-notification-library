<?php

namespace PushNotification;

interface Settings
{
    /** string the path to you apn certification file  */
    const APNS_CERTIFICATION_FILE_PATH = __DIR__ . '/../../pushcert.pem';

    /** string apn endpoint url */
    const APNS_URL = 'ssl://gateway.push.apple.com:2195';

    /** string fcm api key */
    const FCM_API_ACCESS_KEY = 'AIzaSyCvYak-qzV4aeOZmHuHmIGmyojOmpjJJd8';

    /** string fcm endpoint url */
    const FCM_URL = 'https://fcm.googleapis.com/fcm/send';

    /** string google content type */
    const GOOGLE_CONTENT_TYPE = 'application/json';

    const Socket_Time_To_Live = 60;

}