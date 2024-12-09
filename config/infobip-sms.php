<?php

/**
 * This is config for Infobip SMS.
 *
 * @see https://dev.infobip.com/send-sms/single-sms-message
 */
return [
   'api_key' => env('INFOBIP_API_KEY'),
    'sender' => env('INFOBIP_SENDER'),
];
