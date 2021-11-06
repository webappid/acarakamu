<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:58
 * Time: 2021/11/06
 * Class UserActivityRequest
 * @package App\Requests
 */

class UserActivityRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'user_id' => 'nullable|int',
            'activity' => 'required|max:255|string',
            'tz' => 'required|max:50|string'
        ];
    }
}
