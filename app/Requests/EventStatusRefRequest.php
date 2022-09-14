<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:04
 * Time: 2022/09/14
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
