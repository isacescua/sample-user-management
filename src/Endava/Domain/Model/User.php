<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 8:52 AM
 */

namespace Endava\Domain\Model;


use Endava\Domain\ValueObject\UserEmail;
use Endava\Domain\ValueObject\UserId;
use Endava\Domain\ValueObject\UserName;
use Endava\Domain\ValueObject\UserPassword;

class User
{
    /**
     * @var UserId
     */
    private $userId;
    /**
     * @var UserName
     */
    private $userName;
    /**
     * @var UserEmail
     */
    private $userEmail;
    /**
     * @var UserPassword
     */
    private $userPassword;

    public function __construct(UserId $userId, UserName $userName, UserEmail $userEmail, UserPassword $userPassword)
    {
        $this->userId = $userId;
        $this->userName = $userName;
        $this->userEmail = $userEmail;
        $this->userPassword = $userPassword;
    }

    /**
     * @return UserId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return UserName
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @return UserEmail
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * @param string $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $this->userName->updateUserName($userName);
    }

    /**
     * @param string $userEmail
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $this->userEmail->updateEmail($userEmail);
    }

    /**
     * @param string $userPassword
     */
    public function setUserPassword($userPassword)
    {
        $this->userPassword = $this->userPassword->updatePassword($userPassword);
    }

    public function toArray(){

        return (array) $this;
    }

    /**
     * @return UserPassword
     */
    public function getUserPassword()
    {
        return $this->userPassword;
    }


}