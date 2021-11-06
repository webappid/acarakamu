<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:03
 * Time: 2021/11/06
 * Class AppSettingRequest
 * @package App\Requests
 */

class AppSettingRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'date_time_format' => 'required|max:15|string',
            'date_format' => 'required|max:15|string',
            'time_format' => 'required|max:15|string',
            'hour_minute_format' => 'required|max:15|string',
            'user_id' => 'required|int',
            'creator_id' => 'required|int',
            'owner_id' => 'required|int'
        ];
    }
}
