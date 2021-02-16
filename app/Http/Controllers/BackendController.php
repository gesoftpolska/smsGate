<?php

namespace App\Http\Controllers;

use App\smsGate\Gateways\BackendGateway;
use App\smsGate\Interfaces\BackendInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class BackendController extends Controller
{
    private $bg, $br;

    public function __construct(BackendInterface $backendI, BackendGateway $backendGateway)
    {
        $this->bg = $backendGateway;
        $this->br = $backendI;
    }

    public function createSMS(Request $request)
    {
        $key = $request->input('key');
        $phone = $request->input('phone');
        $text = $request->input('text');
        $from = $request->input('from');

        $this->bg->create_sms($phone, $text, $from);

        return redirect('');
    }

    public function createSMS_api(Request $request)
    {
        $api_token = $request->input('api_token');
        $phone = $request->input('phone');
        $text = $request->input('text');
        $from = $request->input('from');
        if ($phone == null || $text == null || $api_token == null) {
            return 'invalid_data';
        } else {
            if ($this->br->isTokenExist($api_token)) {
                return $this->bg->create_sms($phone, $text, $from);
            } else {
                return 'invalid_token';
            }


        }


    }

    public function updateSmsStatus(Request $request)
    {
        $api_token = $request->input('api_token');
        $phone = $request->input('phone');
        $text = $request->input('text');
        $status_id = $request->input('status_id');

        if ($api_token == null || $phone == null || $text == null || $status_id == null) {
            return 'invalid_data';
        } else {
            if ($this->br->isTokenExist($api_token)) {
                return $this->br->updateStatus($phone, $text, $status_id);
            } else {
                return 'invalid_token';
            }
        }


    }

    public function getListOfSmsToSend(Request $request)
    {
        $api_token = $request->input('api_token');
        if ($api_token == null) {
            return 'invalid_token';
        } else {
            $result = $this->br->getCreatedSmsList($api_token);
            return $result;
        }


    }


}
