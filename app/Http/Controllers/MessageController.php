<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use App\Mail\SendMail;
use Mailgun\Mailgun;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        if($request->validate([
            'to' => 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'
        ]))
        {
            $createNew = new Message;
            $createNew->user_id = Auth::id();
            $createNew->to = $request->to;
            $createNew->subject = $request->subject;
            $createNew->message = $request->message;
            $createNew->save();
    
            $result = $this->send($createNew);
    
            if($result)
            {
                // Update it
                $id = $result['id'];
                $status = $result['message'];
            }
            else
            {
                $id = null;
                $status = 'Error sending';
            }
            $createNew->mailgun_id = $id;
            $createNew->mailgun_status = $status;
            $createNew->save();
        }
        else
        {
            $status = 'invalid email address';
        }

        return redirect('create-email')->with('status', $status);
    }

    public function send($message) {
        $mgClient = Mailgun::create(env('MAILGUN_SECRET'));
        $domain = env('MAILGUN_DOMAIN');
        try
        {
            $result = $mgClient->messages()->send($domain, array(
                'from'	=> env('MAIL_FROM_NAME') . ' <' . env('MAIL_FROM_ADDRESS') . '>',
                'to'	=> $message->to,
                'subject' => $message->subject,
                'text'	=> $message->message
            ));
            $id = $result->getId();
            $message = $result->getMessage();
        }
        catch (exception $e)
        {
            $id = null;
            $message = $e->getMessage();
        }
        return ['id' => $id, 'message' => $message];
    }

}
