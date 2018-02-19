<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 5:35 PM
 */

namespace Endava\Infrastructure\Persistence\InRedis;


use Predis\ClientInterface;

interface PredisClientInterface extends ClientInterface
{
    public function hset($key, $field, $value);
    public function hget($key, $field);
    public function hdel($key, $fields);
}