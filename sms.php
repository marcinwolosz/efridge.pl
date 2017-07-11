<?php
function sms_send($params, $backup = false ) {

    static $content;

    if($backup == true){
        $url = 'http://api2.smsapi.pl/sms.do';
    }else{
        $url = 'http://api.smsapi.pl/sms.do';
    }

    $c = curl_init();
    curl_setopt( $c, CURLOPT_URL, $url );
    curl_setopt( $c, CURLOPT_POST, true );
    curl_setopt( $c, CURLOPT_POSTFIELDS, $params );
    curl_setopt( $c, CURLOPT_RETURNTRANSFER, true );

    $content = curl_exec( $c );
    $http_status = curl_getinfo($c, CURLINFO_HTTP_CODE);

    if($http_status != 200 && $backup == false){
        $backup = true;
        sms_send($params, $backup);
    }

    curl_close( $c );    
    return $content;
}

$params = array(
     'username' => 'marcinwoloszz@gmail.com',
     'password' => '21232f297a57a5a743894a0e4a801fc3',
     'to' => '535475125',
     'from' => 'Info',
     'message' => "Hello world!",
);

echo sms_send($params);

						
?>