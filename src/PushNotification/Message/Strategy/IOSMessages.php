<?php


namespace PushNotification\Message\Strategy;

use PushNotification\Message\AppleMessage;
use PushNotification\Message\BasicMessageInterface;
use PushNotification\Message\Config\Provider;

/**
 * Class IOSMessages
 * @package PushNotification\Message\Strategy
 */
class IOSMessages implements BasicMessageInterface, AppleMessage
{

    use Provider;

    /** string , send badge as default 1 */
    const DEFAULT_BADGE = 1;

    /** string default sound at push  */
    const DEFAULT_SOUND = 'bingbong.aiff';

    /** @var  string */
    private $title;

    /** @var  string */
    private $body;

    /** @var */
    private $data;

    /** @var  string related action like : events, coins,... */
    private $action;

    /** @var  string */
    private $provider;

    /** @var  array of users which targeted */
    private $targets;

    /** @var */
    private $id;

    /** @var  string */
    private $token;

    /** @var */
    private $expire = 100;

    public function __construct()
    {
        $this->setProvider(Provider::apple());
    }

    /**
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param string $provider
     * @return IOSMessages
     */
    public function setProvider(string $provider)
    {
        $this->provider = $provider;
        return $this;
    }

    /**
     * @param mixed $targets
     * @return IOSMessages
     */
    public function setTargets($targets)
    {
        $this->targets = $targets;
        return $this;
    }

    /**
     * @param string $action
     * @return IOSMessages
     */
    public function setAction(string $action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @param mixed $data
     * @return IOSMessages
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param string $title
     * @return IOSMessages
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $body
     * @return IOSMessages
     */
    public function setBody(string $body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * create full message
     * @param string $provider
     * @return mixed
     */
    public function make($provider = null)
    {
        $message = array(
            'aps' => $this->aps(),
            'data' => $this->data(),
        );

        $payload = json_encode($message, JSON_UNESCAPED_UNICODE);
        $length = strlen($payload);

        return pack('CNNnH*', 1, $this->id, $this->expire, 32, $this->token)
            . pack('n', $length)
            . $payload;
    }

    /**
     * generate aps message block for apns
     * @return mixed
     */
    public function aps()
    {
        return array(
            'alert' => array(
                'title' => $this->title,
                'body' => $this->body
            ),
            'content-available' => 1,
            'badge' => $this->getBadge(),
            'sound' => $this->getSound()
        );

    }

    /**
     * @return int
     */
    private function getBadge()
    {
        return self::DEFAULT_BADGE;
    }

    private function getSound()
    {
        return self::DEFAULT_SOUND;
    }

    /**
     * create message
     * @return mixed
     */
    public function data()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function targets()
    {
        return $this->targets;
    }

    /**
     * set the unique id for message
     * @param $id
     * @return mixed
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * set the token for message
     * @param $token
     * @return mixed
     */
    public function setToken($token)
    {
        $this->token = $token;
    }
}