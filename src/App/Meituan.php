<?php
namespace Delivery\App;
use Delivery\Interfaces\Delivery_interface;

/**
 * Created by PhpStorm.
 * User: zfh
 * Date: 2019-11-28
 * Time: 15:18
 */
class Meituan implements Delivery_interface
{

    /**
     * 设置环境
     * @param $env
     * @return mixed
     */
    public function setEnv($env)
    {
        // TODO: Implement setEnv() method.
    }

    /**
     * 设置配置
     * @param $config
     * @return mixed
     */
    public function setConfig($config)
    {
        // TODO: Implement setConfig() method.
    }

    /**
     * 获取配置
     * @return mixed
     */
    public function getConfig()
    {
        // TODO: Implement getConfig() method.
    }

    /**
     * 秘钥签名
     * @param $params
     * @return mixed
     */
    public function sign($params)
    {
        // TODO: Implement sign() method.
    }

    /**
     * 请求接口
     * @param $func_name
     * @param $params
     * @return array
     */
    public function call($func_name, $params)
    {
        // TODO: Implement call() method.
    }
}