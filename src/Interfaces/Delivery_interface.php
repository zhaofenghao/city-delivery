<?php
namespace Delivery\Interfaces;
/**
 * 第三方配送配置接口
 * Created by PhpStorm.
 * User: zfh
 * Date: 2019-11-27
 * Time: 11:37
 */

interface Delivery_interface
{
    /**
     * 设置环境
     * @param $env
     * @return mixed
     */
    public function setEnv($env);
    /**
     * 设置配置
     * @param $config
     * @return mixed
     */
    public function setConfig($config);

    /**
     * 获取配置
     * @return mixed
     */
    public function getConfig();

    /**
     * 秘钥签名
     * @param $params
     * @return mixed
     */
    public function sign($params);

    /**
     * 请求接口
     * @param $func_name
     * @param $params
     * @return array
     */
    public function call($func_name, $params);
}