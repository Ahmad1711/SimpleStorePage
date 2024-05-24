<?php

namespace App\Http\Controllers;

use App\Interfaces\SMSInterface;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    public $sms;

    public function __construct(SMSInterface $sms){
        $this->sms=$sms;
    }

    public function send(){

        return $this->sms->send();
    }

}
