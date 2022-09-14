<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:41
 * Time: 2022/09/14
 * Class SfUserRequest
 * @package App\Requests
 */

class SfUserRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'userName' => 'required|max:100|string',
            'realName' => 'nullable|max:200|string',
            'pwdUser' => 'required|max:100|string',
            'groupId' => 'nullable|int',
            'lastLogin' => 'nullable|max:100|string',
            'status' => 'required|max:6|string',
            'loginKey' => 'required|max:255|string',
            'activateKey' => 'required|max:50|string',
            'dateTimeChange' => 'required|max:100|string'
        ];
    }
}
