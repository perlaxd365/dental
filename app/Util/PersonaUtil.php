<?php
class PersonaUtil
{
    public static function getDni($dni)
    {
        $curl = curl_init();
        //$headers = array("authorization: token d2617b5f616372dd5dc28f7df1b2647cbf6d7c698d2fa0bec4a169b4bbb97b0f");
        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InBlcmxheGQzNjVAZ21haWwuY29tIn0.3j6QnXgLgOToXNsBWCe-UTHyWl7IAHgIo-zZZGi_IaE";
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://dniruc.apisperu.com/api/v1/dni/{$dni}?token={$token}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_SSL_VERIFYPEER => false,
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return  [
            "response" => $response, 
            "error" => $err
        ];
    }
}
