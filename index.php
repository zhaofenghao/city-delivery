<?php
/**
 * Created by PhpStorm.
 * User: zfh
 * Date: 2019-11-28
 * Time: 10:11
 */
namespace Delivery;
require "vendor/autoload.php";

$param = [
    'shop_no'           => '11047059',
    'origin_id'         => 'zfh_order_02',
    'city_code'         => '021',
    'cargo_price'       => 100,
    'is_prepay'         => 0,
    'receiver_name'     => '测试',
    'receiver_address'  => '南京',
    'receiver_lat'      => '32.047055',
    'receiver_lng'      => '118.80144',
    'receiver_phone'    => '15950568797',
    'callback'          => 'https://api.shop.ci123.com/store/get'
];

$user_config = [
    'app_secret'    => '9d362fa4b5b6937f6bd3001b5b370363',
    'app_key'       => 'dada20d65c96b434306',
    'source_id'     => 73753,
    'format'        => 'json',
    'v'             => '1.0',
    'body'          => ''
];

$env = 'dev';
$client_name = 'Dada';
$url = 'api/order/addAfterQuery';


try {
    $client = new DeliveryClient();
    $client->setConfig($client_name, $user_config, $env);
    $res = $client->call($url, $param);
    var_dump($res);
} catch (\Exception $exception) {
    echo $exception->getMessage();
}