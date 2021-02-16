<?php



$url = "http://wow.ovh/apka2";





function urlExists($url = NULL)
{
    $cURLConnection = curl_init();

    curl_setopt($cURLConnection, CURLOPT_URL, $url);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

    $phoneList = curl_exec($cURLConnection);
    curl_close($cURLConnection);



// $apiResponse - available data from the API request

echo  $phoneList;

}

urlExists($url);


?>