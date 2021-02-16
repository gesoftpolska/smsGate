<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 13.02.2020
 * Time: 21:54
 */

namespace App\smsGate\Interfaces;


interface FrontendRepositoryInterface
{

    function get_sms_list($status_id);

    function get_today_sms_list();

    function get_last_30_days_sms_list();

    function create_mass_sms($array_sms_list);

    function create_mass_sms_one_content($numbers, $content);


}