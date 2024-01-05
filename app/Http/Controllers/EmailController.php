<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Message;
use Symfony\Component\Mime\Part\TextPart;
use Symfony\Component\Mime\Part\HtmlPart;

use App\Mail\TextEmail;

class EmailController extends Controller
{
    public function sendMail($content, $subject, $recipient, $name='', $images='')
    {
        try {
            $FromName = env('APP_NAME');
            $recipients = explode(',', $recipient);
            foreach ($recipients as $recipient) {
                $mailSent = Mail::send([], [], function ($message) use ($recipient, $subject, $content) {
                    $message->to($recipient)->subject($subject);
                    $message->html($content);
                });
                //print_r($mailSent);
            }

            if ($mailSent) {
                return 1;
            } else {
                return 0;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function testEmail()
    {
        
        $recipient = 'umesh.codeinit@gmail.com';
        $subject = 'Test Email 1';
        $content = '<html><body>';
                $content .= '<b style="color:#3A38C2;">A plan buy by a user & deposit details are below</b><br>';
                $content .= '<br><b>Username : </b>Umesh USD';
                $content .= '<br><b>Amount : </b>32 USD';
                $content .= '<br><b>UTR No. : </b>asdfasfdas';
                $content .= '<br><b>Ref. No. : </b>asdasdasd';
                $content .= '<br><b>Payment Through : </b>Credit Card';
                $content .= '</body></html>';
        
        $recipients = explode(',', $recipient);
        foreach ($recipients as $recipient) {
            $mailSent = Mail::send([], [], function ($message) use ($recipient, $subject, $content) {
                $message->to($recipient)->subject($subject);
                $message->html($content);
                //$message->from('no-reply@ongc.com', 'Your Name');
                //$message->setBody($content, 'text/html');
            });
        }
       // print_r($mailSent);
        if ($mailSent) {
            return 1;
        } else {
            return 0;
        }
    }
    
}