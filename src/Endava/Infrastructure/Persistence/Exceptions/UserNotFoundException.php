<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 9:48 AM
 */

namespace Endava\Infrastructure\Persistence\Exceptions;


class UserNotFoundException extends \Exception
{

    const USER_NOT_FOUND_MESSAGE = 'message.user.not_found';

    const ERROR_CODE = 401;

    public function __construct()
    {
        parent::__construct(self::USER_NOT_FOUND_MESSAGE, self::ERROR_CODE);
    }

}