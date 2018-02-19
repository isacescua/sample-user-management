<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 1:54 PM
 */

namespace Endava\Application\Adapter;


use Endava\Application\Request\UpdateUserRequest;
use Endava\Domain\ValueObject\UpdateUserRequestObject;

class UpdateUserRequestToObjectAdapter extends UpdateUserRequestObject
{
    public function __construct(UpdateUserRequest $request)
    {
        parent::__construct($request->getUserId(), $request->getUserName(), $request->getUserEmail(),$request->getUserPlainPassword(), $request->getEncodingStrategy());
    }
}