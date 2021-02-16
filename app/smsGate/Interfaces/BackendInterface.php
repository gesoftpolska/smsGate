<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 13.02.2020
 * Time: 18:46
 */

namespace App\smsGate\Interfaces;


interface BackendInterface
{

    function create_sms($phone, $content, $from = null);

    function check_is_exist_sms($phone, $content);

    function getCreatedSmsList($api_token);

    function updateStatus($phone, $content, $status_id);

    function isTokenExist($api_token);

}