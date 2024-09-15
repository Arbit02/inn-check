<?php
function GetContent($inn)
{
    $url = 'https://statusnpd.nalog.ru/api/v1/tracker/taxpayer_status';
    $data = array(
        'inn' => $inn,
        'requestDate' => date('Y-m-d')
    );
    $data_json = json_encode($data);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_json)
    ));

    $response = curl_exec($ch);
    curl_close($ch);
    $responseData = json_decode($response, true);

    if ($responseData['status']) {
        return 1;
    } else {
        return 0;
    }
}
