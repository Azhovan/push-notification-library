

# Push Notification Library for php
 
Standalone PHP library for easy devices message notifications push.  
<i class="icon-flag"></i> 
**Feel free to contribute!**



Installation
-------------

    composer require push-notification/push-notification-php-library


This repository uses PSR-0 autoload. After installation with composer please adjust you autoloading config if needed or include vendor/autoload.php in your index.php. 

 **Requirements:**

> - PHP 5.6+
> - PHP Curl and OpenSSL modules

  > **available supports:**
 > 
> - APNS (Apple)
> - GCM (Android) and FCM (Android)

### Setting
you need to set settings of your provider (Apn, Fcm) at  **src/PushNotification/Settings.php**
```php
/** string the path to you apn certification file  */
    const APNS_CERTIFICATION_FILE_PATH = __DIR__ . '';

    /** string apn endpoint url */
    const APNS_URL = 'ssl://gateway.push.apple.com:2195';

    /** string fcm api key */
    const FCM_API_ACCESS_KEY = '';

    /** string fcm endpoint url */
    const FCM_URL = 'https://fcm.googleapis.com/fcm/send';

    /** string google content type */
    const GOOGLE_CONTENT_TYPE = 'application/json';

    const Socket_Time_To_Live = 60;
```


### How to use : 
```php
include_once "vendor/autoload.php";

use PushNotification\Service\PushService;

$data = array(
    'device' => array(
        'name' => '', // Android or AppleIOS
        'token' => '', // device token | user token , if you want to send to apple device you have to fill this 
        'id' => 'unique id here'

    'message' => array(
        'action' => 'test',
        'title' => 'this is test title',
        'targets' => array(''), // if you want to use Fcm you can inclue array of targets 
        'body' => 'this is body',
        'type' => '', // AndroidMessages or IOSMessages
        'data' => array('type' => 'testType'))
);

$response  = PushService::getInstance()->send($data);

```

### Android :
```php
include_once "vendor/autoload.php";

use PushNotification\Service\PushService;

$data = array(
    'device' => array(
        'name' => 'Android',  
        'token' => '', 
        'id' => 'some id here '),

    'message' => array(
        'action' => 'test',
        'title' => 'this is test title',
        'targets' => array('token1', 'token2', 'token3'),
        'body' => 'this is body',
        'type' => 'AndroidMessages',  
        'data' => array('type' => 'testType'))
);
$response  = PushService::getInstance()->send($data);
print_r($response);

```


### IOS :
```php
include_once "vendor/autoload.php";

use PushNotification\Service\PushService;

$data = array(
    'device' => array(
        'name' => 'AppleIOS',
        'token' => 'token',
        'id' => 'BECDSx'),

    'message' => array(
        'action' => 'test',
        'title' => 'this is test title',
        'targets' => array(),
        'body' => 'this is body',
        'type' => 'IOSMessages', 
        'data' => array('type' => 'testType'))
);
$response  = PushService::getInstance()->send($data);
print_r($response);

```
