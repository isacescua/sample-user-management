<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 9:00 AM
 */

namespace Endava\Domain\ValueObject;


class UserName
{
    private $userName;

    const USER_NAME_CANNOT_BE_EMPTY_MESSAGE = 'message.username.empty';

    const ERROR_CODE = 401;

    public function __construct($userName)
    {
        $this->setUserName($userName);
    }

    /**
     * @param mixed $userName
     */
    private function setUserName($userName)
    {
        $this->assertUserNameNotEmpty($userName);
        $this->userName = $userName;
    }

    /**
     * @param $userName
     * @return UserName
     */
    public function updateUserName($userName){
        return new self($userName);
    }

    /**
     * @param $userName
     */
    private function assertUserNameNotEmpty($userName){
        if (empty($userName)){
            throw new \InvalidArgumentException(self::USER_NAME_CANNOT_BE_EMPTY_MESSAGE, self::ERROR_CODE);
        }
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param UserName $userName
     * @return bool
     */
    public function equals(UserName $userName){
        return $this->userName === $userName->getUserName();
    }

}