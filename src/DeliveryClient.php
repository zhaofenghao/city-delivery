<?php
/**
 * Created by PhpStorm.
 * User: zfh
 * Date: 2019-11-28
 * Time: 14:59
 */
namespace Delivery;

class DeliveryClient
{
    private $client;

    /**
     * 第三方配送基础配置
     * @param $client_name
     * @param $user_config
     * @param string $env
     * @throws \Exception
     */
    public function setConfig($client_name, $user_config, $env = 'dev')
    {
        try {
            if (!in_array($client_name, ['Dada', 'Shunfeng', 'Meituan'])) {
                throw new \Exception('暂不支持的第三方配置');
            }

            if (!in_array($env, ['dev', 'prod'])) {
                throw new \Exception('暂不支持的环境配置');
            }
            $container = new Container();
            $class = $container->make(__NAMESPACE__ . '\App\\' . $client_name);
            $class->setEnv($env);
            $class->setConfig($user_config);

            $this->client = $class;

        } catch (\Exception $exception) {
            throw new \Exception($exception);
        }

    }

    /**
     * 请求接口
     * @param $url
     * @param $param
     * @return mixed
     */
    public function call($url, $param)
    {
        return $this->client->call($url, $param);
    }
}