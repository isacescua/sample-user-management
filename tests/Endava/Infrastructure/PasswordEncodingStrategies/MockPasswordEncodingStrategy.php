<?php

namespace TestEndava\Infrastructure\PasswordEncodingStrategies;

use Endava\Domain\Model\UserPasswordEncodingStrategyInterface;

/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 4:38 PM
 */

class MockPasswordEncodingStrategy implements UserPasswordEncodingStrategyInterface
{
    public function encodePasswordAndReturnValue($password)
    {
        return md5($password);
    }

}