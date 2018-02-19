<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 10:06 AM
 */

namespace Endava\Domain\ValueObject;


use Endava\Domain\Model\UserPasswordEncodingStrategyInterface;

class CreateUserRequestObject
{
    private $userName;
    private $userEmail;
    private $userPlainPassword;
    /**
     * @var UserPasswordEncodingStrategyInterface
     */
    private $encodingStrategy;

    public function __construct($userName, $userEmail, $userPlainPassword, UserPasswordEncodingStrategyInterface $encodingStrategy)
    {
        $this->userName          = $userName;
        $this->userEmail         = $userEmail;
        $this->userPlainPassword = $userPlainPassword;
        $this->encodingStrategy  = $encodingStrategy;
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

}