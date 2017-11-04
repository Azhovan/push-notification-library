<?php

namespace PushNotification\Signature;

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
        $this->certification = 'key='. getenv('FCM_API_ACCESS_KEY');
        return $this;
    }

    /**
     * @return SignatureAbstract
     */
    public function setEndPoint()
    {
        $this->endPoint = getenv('FCM_URL');
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
     * @return $this
     * @internal param string $contentType
     */
    public function setContentType()
    {
        $this->contentType = getenv('GOOGLE_CONTENT_TYPE');
        return $this;
    }
}