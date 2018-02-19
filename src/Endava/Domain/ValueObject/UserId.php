<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 9:00 AM
 */

namespace Endava\Domain\ValueObject;


use Ramsey\Uuid\Uuid;

class UserId
{
    private $userId;

    const USER_ID_CANNOT_BE_EMPTY_MESSAGE = 'message.user_id.empty';
    const ERROR_CODE = 401;


    private function __construct($userId)
    {
        $this->setUserId($userId);
    }

    public function __toString()
    {
        return (string) $this->getUserId();
    }


    /**
     * @param $userId
     * @return UserId
     */
    public static function fromString($userId){
        return new self($userId);
    }

    /**
     * @return UserId
     */
    public static function getNext(){
        return new self(Uuid::uuid4());
    }

    /**
     * @param mixed $userId
     * @throws \InvalidArgumentException
     */
    private function setUserId($userId)
    {
        $this->assertUserIdNotEmpty($userId);
        $this->userId = $userId;
    }

    /**
     * @param $userId
     * @throws \InvalidArgumentException
     */
    private function assertUserIdNotEmpty($userId)
    {
        if (empty($userId)) {
            throw new \InvalidArgumentException(self::USER_ID_CANNOT_BE_EMPTY_MESSAGE, self::ERROR_CODE);
        }
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param UserId $userId
     * @return bool
     */
    public function equals(UserId $userId){
        return $this->userId === $userId->getUserId();
    }
}