<?php

  // файл с функциями для интеграции Clientbase и сервиса СМС-рассылок IQ SMS (https://iqsms.ru/api/api_rest-php/)
require_once "common.php"; 

    // отправка СМС с текстом $text на телефон $phone от имени отправителя $sender
function IQSMS_SendSMS($phone, $text, $sender) {
  $phone = SetNumber($phone);
  $text = form_input($text);
  if (!$sender) $sender = IQSMS_DEFAULT_NAME;
  if (!$phone || !$text) return 'no input data';
  $phone = rawurlencode($phone);
  $text = rawurlencode($text);
  $sender = rawurlencode($sender);
  $url = IQSMS_URL.'send?phone='.$phone.'&text='.$text.'&sender='.$sender.'&login='.IQSMS_API_LOGIN.'&password='.IQSMS_API_PASSWORD;
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $tmp = curl_exec($curl);    
  curl_close($curl);
  return $tmp;
}

    // возвращает статус сообщения с $messageId
function IQSMS_GetSMSStatus($messageId='') {
  if (!$messageId) return 'no messageId';
  $url = IQSMS_URL.'status?&login='.IQSMS_API_LOGIN.'&password='.IQSMS_API_PASSWORD.'&id='.$messageId;
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $tmp = curl_exec($curl);    
  curl_close($curl);
  return $tmp;
}


    // возвращает список доступных подписей в СМС
function IQSMS_GetSenders() {
  $url = IQSMS_URL.'senders?&login='.IQSMS_API_LOGIN.'&password='.IQSMS_API_PASSWORD;
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $tmp = curl_exec($curl);    
  curl_close($curl);
  return $tmp;
}






?>