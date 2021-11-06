<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:54
 * Time: 2021/11/06
 * Class SfUserResetPasswordHistRequest
 * @package App\Requests
 */

class SfUserResetPasswordHistRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'userResetPasswordHistUserId' => 'required|int',
            'userResetPasswordHistCode' => 'required|max:20|string',
            'userResetPasswordHistValidUntil' => 'required|max:100|string',
            'userResetPasswordHistStatus' => 'required|max:6|string'
        ];
    }
}
