<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 1:38 PM
 */

namespace Endava\Application\Adapter;

use Endava\Application\Request\CreateUserRequest;
use Endava\Domain\ValueObject\CreateUserRequestObject;

class CreateUserRequestToObjectAdapter extends CreateUserRequestObject
{
    public function __construct(CreateUserRequest $request)
    {
        parent::__construct($request->getUserName(), $request->getUserEmail(),$request->getUserPlainPassword(), $request->getEncodingStrategy());
    }

}