<?php
/**
 * Created by PhpStorm.
 * User: zfh
 * Date: 2019-11-27
 * Time: 10:28
 */
namespace Delivery;

use ReflectionClass;
use ReflectionException;

class Container
{
    private $binds = [];
    public static $instance = null;

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function bind($name, $class = null)
    {
        if (is_object($class) || $class instanceof Closure) {
            self::getInstance()->binds[$name] = $class;
        } else {
            self::getInstance()->make($name);
        }
    }

    /**
     * @param $name
     * @return object
     */
    public function get($name)
    {
        return self::getInstance()->make($name);
    }

    /**
     *
     * @param $class_name
     * @return mixed|object
     */
    public function make($class_name)
    {
        try {
            if (array_key_exists($class_name, $this->binds)) {
                return $this->binds[$class_name];
            }

            $ref = new ReflectionClass($class_name);
            $params = [];
            $constructor = $ref->getConstructor();
            if (!is_null($constructor)) {
                $con_params = $constructor->getParameters();
                foreach ($con_params as $con_param) {
                    if (!is_null($con_param->getClass())) {
                        $params[] = $this->make($con_param->name);
                    } else {
                        $params[] = $con_param->name;
                    }
                }
            }

            $class = $ref->newInstanceArgs($params);
            $this->binds[$class_name] = $class;
            return $class;

        } catch (ReflectionException $exception) {
            //
            echo $exception->getMessage();
        }
    }
}