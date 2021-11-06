<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:28
 * Time: 2021/11/06
 * Class PersonalAccessTokenRequest
 * @package App\Requests
 */

class PersonalAccessTokenRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'tokenable_type' => 'required|max:255|string',
            'tokenable_id' => 'required|int',
            'name' => 'required|max:255|string',
            'token' => 'required|max:64|string',
            'abilities' => 'nullable|max:65535|string',
            'last_used_at' => 'nullable|max:100|string'
        ];
    }
}
