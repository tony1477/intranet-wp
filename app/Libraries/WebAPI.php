<?php

namespace App\Libraries;

class WebAPI
{
    private static string $token = '';
    private static string $cookieName = 'X-WPG-Recruitment';

    public static function connect(string $url) 
    {
        $headers = array('Authorization: Bearer '. (self::$token ?? ''), 'Content-Type: application/json');
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public static function verify(string $url) 
    {
        self::$token = $_COOKIE[self::$cookieName] ?? '';
        if(self::$token=='') return json_encode([
            'status' => 'failed',
            'message' => 'No Token Provided!'
        ]);
        
        $response = self::connect($url);
        return $response;
    }

    public static function get(string $url) 
    {
        // $url = API_WEBSITE.'/api/employee';
        if(self::$token=='') self::$token = $_COOKIE[self::$cookieName];
        return self::connect($url);
    }
}
