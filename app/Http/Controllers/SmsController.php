<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Pnlinh\LaravelInfobipSms\Infobip;

define('BRAND_NAME', 'Task Assigner');
class SmsController extends Controller
{
public function send(Request $request)

{$basic  = new \Vonage\Client\Credentials\Basic("791fbf42", "c9KL9zvpHIy2jIO8");
    $client = new \Vonage\Client($basic);
    $response = $client->sms()->send(
        new \Vonage\SMS\Message\SMS("201112661530", BRAND_NAME, 'Hello from Task Assigner Web application')
    );

    $message = $response->current();

    if ($message->getStatus() == 0) {
        echo "The message was sent successfully\n";
    } else {
        echo "The message failed with status: " . $message->getStatus() . "\n";
    }

}
}

