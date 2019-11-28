<?php
namespace Delivery\Request;
/**
 * Created by PhpStorm.
 * User: zfh
 * Date: 2019-11-28
 * Time: 10:59
 */
class Curl
{
    public static function curlRequest($url, $params = array(), $method = 'GET', $multi = array(), $headers = array(), $timeout = 3)
    {
        if (!function_exists('curl_init')) exit('Need to open the curl extension');
        $method = strtoupper($method);
        //代理配置
        $ci = curl_init();
        curl_setopt($ci, CURLOPT_USERAGENT, 'PHP-SDK OAuth2.0');
        curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ci, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ci, CURLOPT_HEADER, false);
        $headers = (array)$headers;
        switch ($method) {
            case 'POST':
                curl_setopt($ci, CURLOPT_POST, TRUE);
                if (!empty($params)) {
                    if ($multi) {
                        foreach ($multi as $key => $file) {
                            $params[$key] = '@' . $file;
                        }
                        curl_setopt($ci, CURLOPT_POSTFIELDS, $params);
                        $headers[] = 'Expect: ';
                    } else {
                        $params = is_array($params) ? http_build_query($params) : $params;
                        curl_setopt($ci, CURLOPT_POSTFIELDS, $params);
                    }
                }
                break;
            case 'GET':
                $method == 'DELETE' && curl_setopt($ci, CURLOPT_CUSTOMREQUEST, 'DELETE');
                if (!empty($params)) {
                    $url = $url . '?' . (is_array($params) ? http_build_query($params) : $params);
                }
                break;
            default:
                return '参数错误';
        }
        curl_setopt($ci, CURLINFO_HEADER_OUT, TRUE);
        curl_setopt($ci, CURLOPT_URL, $url);
        if ($headers) {
            curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
        }

        $response = curl_exec($ci);
        curl_close($ci);
        return $response;
    }
}
use http\Env\Request;