<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:43
 * Time: 2022/09/14
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
