>同城配送第三方，支持达达、美团、闪送、顺丰

### 从`composer`安装
```
composer require zhaofenghao/city-delivery
```
或者直接在composer.json中设置依赖的版本号，然后使用composer update更新。

### 文档
各第三方配送传送门：
1. [达达](https://newopen.imdada.cn/#/development/file/mustread?_k=4dmsnv)
2. [美团]()
3. [闪送]()
4. [顺丰]()

### 如何使用：
以达达为例：
```
$param = [
    'shop_no'           => '11047059',
    'origin_id'         => '112233',
    'city_code'         => '021',
    'cargo_price'       => 100,
    'is_prepay'         => 0,
    'receiver_name'     => '测试',
    'receiver_address'  => '南京',
    'receiver_lat'      => 'xxxx', // 高德地图坐标
    'receiver_lng'      => 'xxxx',
    'receiver_phone'    => '18888888888',
    'callback'          => 'xxx'
];

$user_config = [
    'app_secret'    => 'xxx',
    'app_key'       => 'xxx',
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
    
} catch (\Exception $exception) {
    echo $exception->getMessage();
}    
```