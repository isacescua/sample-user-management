<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 9:27 AM
 */

namespace Endava\Domain\Model;


interface UserPasswordEncodingStrategyInterface
{
    /**
     * @param $password
     * @return mixed
     */
    public function encodePasswordAndReturnValue($password);
}