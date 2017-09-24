<?php

namespace PushNotification\Signature;

use PushNotification\Settings;

class GoogleSignature extends SignatureAbstract
{

    public function __construct()
    {
        $this->setCertification()
            ->setEndPoint()
            ->setHeader()
            ->setContentType();
    }

    /**
     * @return SignatureAbstract
     */
    public function setCertification()
    {
        $this->certification = 'key='. Settings::FCM_API_ACCESS_KEY;
        return $this;
    }

    /**
     * @return SignatureAbstract
     */
    public function setEndPoint()
    {
        $this->endPoint = Settings::FCM_URL;
        return $this;
    }

    /**
     * @return SignatureAbstract
     */
    public function setHeader()
    {
        $this->header = array(
            'Authorization' => 'key=' . $this->getCertification(),
            'Content-Type' => $this->getContentType()
        );
        return $this;
    }

    /**
     * @param string $contentType
     * @return $this
     */
    public function setContentType()
    {
        $this->contentType = Settings::GOOGLE_CONTENT_TYPE;
        return $this;
    }
}