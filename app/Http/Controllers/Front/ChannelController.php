<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function index () {
      return view('front.channels');
    }
    
    //Test Purposes
    public function channel () {
      return view('front.channel-page');
    }
}