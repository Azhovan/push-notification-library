<?php

namespace PushNotification\Service;

use Guzzle\Http\Client;
use PushNotification\Device\DeviceFactory;
use PushNotification\Device\DeviceInterface;
use PushNotification\Message\BasicMessageInterface;
use PushNotification\Message\MessageFactory;
use PushNotification\Exceptions\PushException;


class PushService
{
    /** @var null class instance */
    private static $instance = null;

    /** @var Client */
    private $httpClient;

    /**
     * PushService constructor.
     */
    private function __construct()
    {
        $this->httpClient = new Client();
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new PushService;
        }

        return self::$instance;
    }

    public function send($data)
    {
        try {
            $this->_send($data);
        } catch (PushException $exception) {
            return $exception->getMessage();
        }

    }

    /**
     *  array('device' => array(
     * 'name' => 'Android',
     * 'token' => 'dUlI1BG-8EQ:APA91bGldZx2BPPdrLU92fQi79LSQuJgvFRWFP447Ly_0xClyndmyBwsGNrepX7cr4K5lRUP9CSPOqc-y-VIrPpq7ccX7EjEfSyBI-zcZLWjKGg_Vw5Ajpjs4nN-REJ2uGMJJ3fklKce',
     * 'id' => 'BECDS'),
     *
     * 'message' => array(
     * 'action'=> 'test',
     * 'title' => 'this is test title',
     * 'targets' => array('123'),
     * 'body' => 'this is body' ,
     * 'type'=>'AndroidMessages OR IOSMessages',
     * 'data' => array('type' => 'testType')))
     * @param $data
     */
    private function _send($data)
    {
        if (empty($data) || null == $data) {
            throw new PushException('data is not valid');
        }

        $device = DeviceFactory::getInstance()->setParam($data['device'])->create();
        $message = MessageFactory::getInstance()->setParam($data['message'])->create();
        $provider = $message->getProvider();
        $this->$provider($message, $device);

        // do some log and response here
    }

    /**
     * send message to google device
     * @param $message BasicMessageInterface
     * @param $device DeviceInterface
     * @return array|\Guzzle\Http\Message\Response|null
     */
    private function google($message, $device)
    {
        $request = $this->getClient()->post(
            $device->getSignature()->getEndPoint(),
            null,
            json_encode($message->make(null)),
            array('debug' => true)
        );

        $request->setHeader('Authorization', $device->getSignature()->getCertification());
        $request->setHeader('Content-Type', $device->getSignature()->getContentType());
        return $response = $this->getClient()->send($request);
    }

    /**
     * @return Client
     */
    private function getClient()
    {
        return $this->httpClient;
    }

    /**
     * send message to apple device
     * @param $message
     * @param $device
     * @return bool|string
     */
    private function apple($message, $device)
    {
        // ios need these information in message payload !
        $message->setId($device->getId());
        $message->setToken($device->getToken());

        $socket = $device->getSignature()->getSocket();
        $response = @fwrite($socket, $message->make());

        if ($response === false) {
            throw new PushException('Server is unavailable; please retry later');
        }

        $data = false;
        $read = array($socket);
        $null = null;

        if (0 < @stream_select($read, $null, $null, 1, 0)) {
            $data = @fread($socket, 6);
        }

        return $data;

    }


}