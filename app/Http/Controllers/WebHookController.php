<?php
// Untested as no live domain to try with

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MailgunWebhook;
use App\Models\Message;

class WebHookController extends Controller
{
    //We don't care which webhook triggers, as it contains the event we want?
    public function mailgunHandler(Request $request)
    {
        try {
            $this->handleWebhook($request->all());
            return response('Success', 200);
        }
        catch (Exception $e) {
            return response($e->getMessage(), 406);
        }
    }

    public function handleWebhook (array $response)
    {
        if($this->validateSignature($response['signature']))
        {
            //Get the relevent message
            $message_id = $response['event-data']['message']['headers']['message-id'];
            $message_status = $response['event-data']['event'];
            $theMessage = Message::where([
                ['mailgun_id', '=', $message_id],
            ]);
            if($theMessage)
            {
                //update the status
                $theMessage->mailgun_status = $message_status;
                $theMessage->save();
            }
        }
    }

    public function validateSignature (array $signature)
    {
        //extract parts
        if($signature['signature'] == hash_hmac('sha256', $signature['timestamp'] . $signature['token'], env(MAILGUN_WEBHOOK)))
        {
            return true;
        }
        return false;
    }
}
