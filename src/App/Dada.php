<?php
/**
 * Created by PhpStorm.
 * User: zfh
 * Date: 2019-11-27
 * Time: 11:55
 */

namespace Delivery\App;
use Delivery\Interfaces\Delivery_interface;
use Delivery\Request\Curl;

class Dada implements Delivery_interface
{
    private $request_url = 'newopen.qa.imdada.cn/'; // newopen.imdada.cn
    private $user_config = [
        'app_secret'    => '',
        'app_key'       => '',
        'source_id'     => 0,
        'format'        => 'json',
        'v'             => '1.0',
        'body'          => ''
    ];

    public function __construct()
    {
//        error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
//        ini_set('display_errors', 1);
    }

    /**
     * 设置环境
     * @param $env
     * @return mixed
     */
    public function setEnv($env)
    {
        switch ($env) {
            case 'dev':
                $this->request_url = 'newopen.qa.imdada.cn/';
                break;
            case 'prod':
                $this->request_url = 'newopen.imdada.cn';
                break;
            default:
        }
        return $this->request_url;
    }

    /**
     * 设置配置
     * @param $config
     * @return mixed
     */
    public function setConfig($config)
    {
        $this->user_config = array_merge($this->user_config, $config);
        // TODO: Implement setConfig() method.
    }

    /**
     * 获取配置
     * @return mixed
     */
    public function getConfig()
    {
        return $this->user_config;
        // TODO: Implement getConfig() method.
    }

    /**
     * 请求接口
     * @param $func_name
     * @param $params
     * @return array
     */
    public function call($func_name, $params)
    {
        $header = [
            'Content-Type: application/json',
            'Charset: UTF8',
        ];

        // 原始参数
        $origin_param = [
            'body'      => json_encode($params, JSON_UNESCAPED_SLASHES),
            'format'    => $this->user_config['format'],
            'timestamp' => time(),
            'app_key'   => $this->user_config['app_key'],
            'v'         => $this->user_config['v'],
            'source_id' => $this->user_config['source_id']
        ];
        $origin_param['signature'] = $this->sign($origin_param);
        $url = $this->request_url . $func_name;
        $res = Curl::curlRequest($url, json_encode($origin_param, JSON_UNESCAPED_SLASHES), 'POST', 0 ,$header, 10);
        return $res;
    }

    public function sign($params)
    {
        // step 1 参数排序
        ksort($params);
        // step 2 字符串拼接
        $param_str = '';
        foreach ($params as $key => $value) {
            $param_str .= $key . $value;
        }
        $param_str = $this->user_config['app_secret'] . $param_str . $this->user_config['app_secret'];

        // step 3 生成秘钥
        $sign_secret = strtoupper(md5($param_str));
        return $sign_secret;
    }
}