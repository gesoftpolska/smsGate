<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 13.02.2020
 * Time: 19:45
 */

namespace App\smsGate\Gateways;


use App\smsGate\Interfaces\BackendInterface;
use Psy\Util\Json;

class BackendGateway
{

    private $backend;

    public function __construct(BackendInterface $backend)
    {
        $this->backend = $backend;
    }

    public function create_sms($phone, $content, $from = null)
    {


        $stripped = str_replace(' ', '', $phone);
        $phones_array = explode(",", $stripped);
        $exist = true;
        define('API_ACCESS_KEY', 'AAAAV8Kijto:APA91bHD_Mq1w1a8kc7TeERuC2NtuY2ZySdNE9Xp4B_MW6-r-cbBkuVWdegcO5k0IwbdaEQLMUZtVhJu1cs-JiJ66N5xHanTYaMinlAoGTlOmJdx2tQNj0935npCPTXuDDewBoeDcsPK');
        $registrationIds = array("dTNRGSWKYqw:APA91bFYCV2fZEjNu6dx_DH9IHr7PQSzfcvWQXycDFQ-m36VjaBCDjZSv2aSV1wNz3qJGryc63GNETGvnQqW5KkwI4r-9wexvyBNEZkT1LdASpVIq_KYE03F4_NMuaz2PDzkqfOrX9pJ");


        foreach ($phones_array as $phone) {
            $exist = $this->backend->check_is_exist_sms($phone, $content);

            if (!$exist) {

                $this->backend->create_sms($phone, $content, $from);



            }

        }

        $msg = array
        (
            'message' => "get_sms",
            'title' => "get_sms",
            'subtitle' => "get_sms",
            'tickerText' => "get_sms",
            'vibrate' => 1,
            'sound' => 1,
            'largeIcon' => 'large_icon',
            'smallIcon' => 'small_icon'
        );
        $fields = array
        (
            'registration_ids' => $registrationIds,
//        'notification'          => $msg,
            'data' => $msg
        );

        $headers = array
        (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);



        if (!$exist) {
            return "true";
        } else {
            return "false";
        }


    }


}