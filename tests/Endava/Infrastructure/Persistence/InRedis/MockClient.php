<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 5:43 PM
 */

namespace TestEndava\Infrastructure\Persistence\InRedis;


use Endava\Infrastructure\Persistence\InRedis\PredisClientInterface;
use Predis\Command\CommandInterface;

class MockClient implements PredisClientInterface
{

    private $database = [];

    public function hset($key, $field, $value)
    {
        $this->database[$key][$field] = $value;
    }

    public function hget($key, $field)
    {
        return isset($this->database[$key][$field])?$this->database[$key][$field]:'';
    }

    public function hdel($key, $fields)
    {

        if(is_array($fields)){
            foreach ($fields as $field){
                unset($this->database[$key][$field]);
            }
        } else {
            unset($this->database[$key][$fields]);
        }

    }

    public function getProfile()
    {
        // TODO: Implement getProfile() method.
    }

    public function getOptions()
    {
        // TODO: Implement getOptions() method.
    }

    public function connect()
    {
        // TODO: Implement connect() method.
    }

    public function disconnect()
    {
        // TODO: Implement disconnect() method.
    }

    public function getConnection()
    {
        // TODO: Implement getConnection() method.
    }

    public function createCommand($method, $arguments = array())
    {
        // TODO: Implement createCommand() method.
    }

    public function executeCommand(CommandInterface $command)
    {
        // TODO: Implement executeCommand() method.
    }

    public function __call($method, $arguments)
    {
        // TODO: Implement __call() method.
    }


}