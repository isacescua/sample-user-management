<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 1:42 PM
 */

namespace Endava\Domain\ValueObject;


use Endava\Domain\Model\UserPasswordEncodingStrategyInterface;

class UpdateUserRequestObject
{
    private $userId;
    private $userName;
    private $userEmail;
    private $userPlainPassword;
    /**
     * @var UserPasswordEncodingStrategyInterface
     */
    private $encodingStrategy;

    /**
     * UpdateUserRequestObject constructor.
     * @param $userId
     * @param $userName
     * @param $userEmail
     * @param $userPlainPassword
     * @param UserPasswordEncodingStrategyInterface $encodingStrategy
     */
    public function __construct($userId, $userName, $userEmail, $userPlainPassword, UserPasswordEncodingStrategyInterface $encodingStrategy)
    {

        $this->userId = $userId;
        $this->userName = $userName;
        $this->userEmail = $userEmail;
        $this->userPlainPassword = $userPlainPassword;
        $this->encodingStrategy = $encodingStrategy;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @return mixed
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * @return mixed
     */
    public function getUserPlainPassword()
    {
        return $this->userPlainPassword;
    }

    /**
     * @return UserPasswordEncodingStrategyInterface
     */
    public function getEncodingStrategy()
    {
        return $this->encodingStrategy;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }
}