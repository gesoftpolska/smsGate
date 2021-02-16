<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 13.02.2020
 * Time: 18:47
 */

namespace App\smsGate\Repositories;


use Amp\Loop;
use Amp\Socket\Socket;
use App\smsGate\Interfaces\BackendInterface;
use App\Sms;
use App\User;
use Illuminate\Support\Facades\Redis;
use WebSocket;
use PHPUnit\Util\Json;


class BackendRepository implements BackendInterface
{


    function create_sms($phone, $content, $from = null)
    {
        $sms = new Sms();
        $sms->phone = $phone;
        $sms->text = $content;
        $sms->from = $from;
        $sms->status_id = 1;
        $sms->save();
        $this->sendViaSocketsms($sms);

    }


    function check_is_exist_sms($phone, $content)
    {
        $date = new \DateTime();
        $date->modify('-3 hours');
        $formatted_date = $date->format('Y-m-d H:i:s');

        if ($phone !== null && $content !== null) {
            $count = Sms::where('phone', $phone)
                ->where('text', 'like', $content)
                ->where('created_at', '>', $formatted_date)
                ->get()
                ->count();
            if ($count > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }


    }

    function getCreatedSmsList($api_token)
    {

        if ($this->isTokenExist($api_token)) {
            return Sms::with('status')->where('status_id', 1)->get()->toJson();
        } else {
            return "invalid_token";
        }

    }

    function updateStatus($phone, $content, $status_id)
    {
        $sms = Sms::where('phone', 'like', $phone)
            ->where('text', 'like', $content)
            ->get()->last();

        if ($sms != null) {
            $sms->status_id = $status_id;
            $result = $sms->save();
            $this->updateStatusForViewRealTime($sms);
            if ($result) {

                return "true";
            }
        } else {
            return 'not_exist';
        }


    }

    function isTokenExist($api_token)
    {

        $user_count = User::where('api_token', $api_token)->count();
        if ($user_count > 0) {
            return true;
        } else {
            return false;
        }
    }

    function sendViaSocketsms(Sms $sms)
    {
        $data_teraz = date("Y-m-d H:s");
        $tresc = json_encode(array("id" => $sms->id, "from" => $sms->from, "to" => $sms->phone, "zadanie" => "nowy_rekord", 'created_at' => $data_teraz,
            'updated_at' => $data_teraz,
            'text' => $sms->text,
            'status' => 'created'
        ));

        Redis::publish('message', $tresc);
    }

    function updateStatusForViewRealTime(Sms $sms)
    {
        $nazwa_statusu = "";
        switch ($sms->status_id) {

            case 1:
                $nazwa_statusu = "created";
                break;
            case 2:
                $nazwa_statusu = "send";
                break;
            case 3:
                $nazwa_statusu = "delivered";
                break;
            default :

                break;

        }
        $data_teraz = date("Y-m-d H:s");
        $tresc = json_encode(array("id" => $sms->id, "from" => $sms->from, "to" => $sms->phone, "zadanie" => "nowy_status", 'created_at' => $data_teraz,
            'updated_at' => $data_teraz,
            'text' => $sms->text,
            'status' => $nazwa_statusu
        ));



        Redis::publish('message', $tresc);
    }


}