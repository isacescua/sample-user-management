<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 10:11 AM
 */

namespace Endava\Infrastructure\PasswordEncodingStrategies;


use Endava\Domain\Model\UserPasswordEncodingStrategyInterface;

class Md5PasswordEncodingStrategy implements UserPasswordEncodingStrategyInterface
{
    public function encodePasswordAndReturnValue($password)
    {
        return md5($password);
    }

}