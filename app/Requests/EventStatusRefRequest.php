<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:10
 * Time: 2021/11/06
 * Class EventStatusRefRequest
 * @package App\Requests
 */

class EventStatusRefRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'eventStatusNama' => 'required|max:50|string',
            'eventStatusDateChange' => 'required|max:100|string',
            'eventStatusUserId' => 'required|int'
        ];
    }
}
