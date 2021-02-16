<?php

namespace App\Http\Controllers;

use Amp\Http\Message;
use App\Events\SendMessage;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Event;

use Illuminate\Support\Facades\Redis;
use WebSocket;
use App\Sms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Predis;


class FrontendController extends Controller
{

    public function get_root_page(Request $request)
    {
        $query = $request->input('query');
        if ($query == null) {
            $sms = Sms::with('status')->orderBy('id', 'DESC')->paginate(60);
        } else {
            $sms = Sms::with('status')->where('text', 'like', '%' . $query . '%')
                ->orwhere('phone', 'like', '%' . $query . '%')
                ->orwhere('from', 'like', '%' . $query . '%')
                ->orderBy('id', 'DESC')->paginate(60);
        }

        return view('root_page')->with('sms', $sms);
    }

    public function get_view_send_one_sms()
    {
        return view('create_one_sms');
    }

    public function get_api_page()
    {
        return view('get_api_page')->with('user', Auth::user());
    }

    public function get_test()
    {


        $content = "mama obiecala";
        return view('layouts.test')->with("content", $content);
    }




}
