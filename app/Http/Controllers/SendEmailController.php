<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
use Mail;
 
use App\Mail\DemoMail;

class SendEmailController extends Controller
{
    public function index()
    {
 
    //   Mail::to('aliman.edx@gmail.com')->send(new DemoMail());
 
      if (Mail::to('aliman.edx@gmail.com')->send(new DemoMail())) {
        return 'Great! Successfully send in your mail';
      }else{
           return 'Sorry! Please try again latter';
         }
    } 
}
