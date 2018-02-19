<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 9:00 AM
 */

namespace Endava\Domain\ValueObject;


use Endava\Domain\Model\UserPasswordEncodingStrategyInterface;

class UserPassword
{

    const USER_PASSWORD_CANNOT_BE_EMPTY_MESSAGE = 'message.password.empty';
    const USER_PASSWORD_MUST_BE_EIGHT_CHARS_LONG_MESSAGE = 'message.password.minimum_eight_chars_required';
    const ERROR_CODE = 401;

    private $userPassword;
    /**
     * @var UserPasswordEncodingStrategyInterface
     */
    private $encodingStrategy;

    public function __construct($userPassword, UserPasswordEncodingStrategyInterface $encodingStrategy)
    {
        $this->encodingStrategy = $encodingStrategy;
        $this->setUserPassword($userPassword);
    }

    /**
     * @param $plainPassword
     * @return UserPassword
     */
    public function updatePassword($plainPassword){
        return new self($plainPassword, $this->encodingStrategy);
    }
    /**
     * @param mixed $userPassword
     */
    private function setUserPassword($userPassword)
    {
        $this->assertUserPasswordNotEmpty($userPassword);
        $this->assertUserPasswordIsMinimumEightChars($userPassword);
        $this->userPassword = $this->encodingStrategy->encodePasswordAndReturnValue($userPassword);
    }

    /**
     * @param $userPassword
     */
    private function assertUserPasswordNotEmpty($userPassword)
    {
        if (empty($userPassword)) {
            throw new \InvalidArgumentException(self::USER_PASSWORD_CANNOT_BE_EMPTY_MESSAGE, self::ERROR_CODE);
        }
    }

    /**
     * @param $userPassword
     */
    private function assertUserPasswordIsMinimumEightChars($userPassword)
    {
        if (strlen($userPassword) < 8) {
            throw new \InvalidArgumentException(self::USER_PASSWORD_MUST_BE_EIGHT_CHARS_LONG_MESSAGE, self::ERROR_CODE);
        }
    }

    /**
     * @return mixed
     */
    public function getUserPassword()
    {
        return $this->userPassword;
    }


    /**
     * @param UserPassword $userPassword
     * @return bool
     */
    public function equals(UserPassword $userPassword){
        return $this->userPassword == $userPassword->getUserPassword();
    }

}