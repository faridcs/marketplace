<?php
/**
 * Created by PhpStorm.
 * User: faridcs
 * Date: 6/10/18
 * Time: 6:48 PM
 */

namespace App\Enums;

class ApiErrorStatus extends Enum
{
    const OK = 200;
    const Bad_Request = 400;
    const Unauthorized = 401;
    const Forbidden = 403;
    const Not_Found = 404;
    const Token_Error = 301;
    const Invalid_IP = 302;
    const Access_Denied = 303;
    const Internal_Server_Error = 500;
}