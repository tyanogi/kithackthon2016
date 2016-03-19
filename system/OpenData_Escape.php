<?php

require_once('./require.php');

$inst = new DB_Placeinfo();
$base_url = 'https://infra-api.city.kanazawa.ishikawa.jp';

for ($id = 1537; $id <= 2825; $id++) {
   $curl = curl_init();
   curl_setopt($curl, CURLOPT_URL, $base_url.'/v1/facilities/'.$id.'.json');
   curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
   curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 証明書の検証を行わない
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // curl_execの結果を文字列で返す
   $response = curl_exec($curl);
   $result = json_decode($response, true);
   
   curl_close($curl);
   
   $array = $result['facility'];
   //print_r($array);
   //echo "</br>"."</br>";
   $inst->addPlaceinfo($array['address'], $array['coordinates']['latitude'], $array['coordinates']['longitude'], $array['name'], $array['summary'], $array['zipcode'], 1);

}

