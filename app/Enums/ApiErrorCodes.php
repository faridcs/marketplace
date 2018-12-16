<?php
/**
 * Created by PhpStorm.
 * User: faridcs
 * Date: 6/12/18
 * Time: 10:12 AM
 */

namespace App\Enums;

class ApiErrorCodes extends Enum
{
    const Unknown = 1000;
    const Credentials_Error = 1001;
    const Credentials_Verify_Error = 1002;
    const Invalid_Params = 1003;
    const Duplicate_Entry = 1004;
    const Not_Existed_Entry = 1005;
}