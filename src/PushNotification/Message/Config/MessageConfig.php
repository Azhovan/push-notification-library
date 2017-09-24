<?php

namespace PushNotification\Message;


interface MessageConfig
{
    /** @var string */
    const RECEIVER = 'to';

    /** @var string */
    const NOTIFICATION = 'notification';

    /** @var string */
    const BODY = 'body';

    /** @var string */
    const TITLE = 'title';

    /** @var string */
    const ICON = 'icon';

    /** @var string */
    const TYPE = 'type';

    /** @var string */
    const IMAGE = 'imageUrl';

    const DESCRIPTION = 'description';

    const PUSHID= 'pushId';

    const MESSAGE_NAMESPACE = 'PushNotification\Message\Strategy\\';

}