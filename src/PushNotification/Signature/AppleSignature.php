<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 9/11/17
 * Time: 3:50 PM
 */

namespace PushNotification\Signature;

use Foundation\Exceptions\InvalidArgumentException;
use PushNotification\Exceptions\PushException;
use PushNotification\Exceptions\StreamSocketClientException;

class AppleSignature extends SignatureAbstract
{

    /** @var  boolean whether socket connection exist or not */
    private static  $isConnected = false;

    /** @var resource stream socket */
    private $socket = null;
    /** @var  string */
    private $passPhrase;

    public function __construct()
    {
        $this->setCertification()
            ->setEndPoint()
            ->setPassPhrase()
            ->openSocket();
    }

    /**
     * @return SignatureAbstract
     */
    public function setCertification()
    {
        $this->certification = config('pushNotification.ApnsCert');
        return $this;
    }

    /**
     * @return resource
     */
    public function getSocket()
    {
        return $this->socket;
    }

    /**
     * @return string
     */
    public function getPassPhrase()
    {
        return $this->passPhrase;
    }

    /**
     * @return SignatureAbstract
     */
    public function setEndPoint()
    {
        $this->endPoint = config('pushNotification.ApnUrl');
        return $this;
    }

    /**
     * Apn does not need header
     * @return SignatureAbstract
     */
    public function setHeader()
    {
        return $this;
    }

    /**
     * Apn does not need header
     * @return SignatureAbstract
     */
    public function setContentType()
    {
        return $this;
    }

    /**
     * Destructor
     * @return void
     */
    public function __destruct()
    {
        $this->close();
    }

    /**
     * Close Connection
     * @return SignatureAbstract
     */
    public function close()
    {
        if (self::$isConnected && is_resource($this->socket)) {
            fclose($this->socket);
        }
        self::$isConnected = false;

        return $this;
    }

    /**
     * @return AppleSignature
     */
    private function setPassPhrase()
    {
        //$this->passPhrase = config('pushNotification.passPhrase');;
        return $this;
    }

    /**
     * open socket to Apn server
     * @return $this
     */
    private function openSocket()
    {

        // if socket is open, return it
        if (self::$isConnected) {
            return $this;
        }

        if (!is_string($this->getCertification()) || !file_exists($this->getCertification())) {
            throw new InvalidArgumentException('Certificate must be a valid path to a APNS certificate');
        }

        $sslOptions = array(
            'local_cert' => $this->getCertification(),
        );

        // this option should be changed in the future
        /*if ($this->getPassPhrase() !== null) {
            if (!is_scalar($this->getPassPhrase())) {
                throw new Exception\InvalidArgumentException('SSL passphrase must be a scalar');
            }
            $sslOptions['passphrase'] = $passPhrase;
        }*/

        $this->connect($sslOptions);

        self::$isConnected = true;

        return $this;
    }

    /**
     * make socket connection to endpoint
     * @param array $ssl
     * @return $this
     */
    private function connect(array $ssl)
    {
        // set errors
        set_error_handler(function ($errNo, $errStr, $errFile, $errLine) {
            throw new StreamSocketClientException($errStr, $errNo, 1, $errFile, $errLine);
        });

        try {
            $this->socket = stream_socket_client(
                $this->getEndPoint(),
                $errNo,
                $errStr,
                $this->getSocketTimeOut(),
                STREAM_CLIENT_CONNECT,
                stream_context_create(
                    array(
                        'ssl' => $ssl,
                    )
                )
            );
        } catch (StreamSocketClientException $e) {
            throw new PushException(sprintf(
                'Unable to connect: %s: %d (%s)',
                $this->getEndPoint(),
                $e->getCode(),
                $e->getMessage()
            ));
        }

        restore_error_handler();

        if (!$this->socket) {
            throw new PushException(sprintf(
                'Unable to connect: %s: %d (%s)',
                $this->getEndPoint(),
                $errNo,
                $errStr
            ));
        }
        stream_set_blocking($this->socket, 0);
        stream_set_write_buffer($this->socket, 0);

        return $this;
    }

    /**
     * @return mixed
     */
    private function getSocketTimeOut()
    {
        return config('pushNotification.Socket_Time_To_Live');
    }
}