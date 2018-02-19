<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 8:59 AM
 */

namespace Endava\Domain\ValueObject;


class UserEmail
{
    private $userEmail;

    const USER_EMAIL_CANNOT_BE_EMPTY_MESSAGE = 'message.email.empty';
    const USER_EMAIL_INVALID_MESSAGE = 'message.email.invalid';

    const ERROR_CODE = 401;

    public function __construct($userEmail)
    {

        $this->setUserEmail($userEmail);
    }

    /**
     * @param $userEmail
     * @return UserEmail
     */
    public function updateEmail($userEmail){
        return new self($userEmail);
    }

    /**
     * @param mixed $userEmail
     */
    private function setUserEmail($userEmail)
    {
        $this->assertUserEmailNotEmpty($userEmail);
        $this->assertUserEmailIsValid($userEmail);
        $this->userEmail = $userEmail;
    }

    /**
     * @param $userEmail
     */
    private function assertUserEmailNotEmpty($userEmail){
        if (empty($userEmail)){
            throw new \InvalidArgumentException(self::USER_EMAIL_CANNOT_BE_EMPTY_MESSAGE, self::ERROR_CODE);
        }
    }

    private function assertUserEmailIsValid($userEmail){
        if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException(self::USER_EMAIL_INVALID_MESSAGE, self::ERROR_CODE);
        }
    }
    /**
     * @return mixed
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * @param UserEmail $userEmail
     * @return bool
     */
    public function equals(UserEmail $userEmail){
        return $this->userEmail === $userEmail->getUserEmail();
    }


}