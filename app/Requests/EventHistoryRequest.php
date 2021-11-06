<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:08
 * Time: 2021/11/06
 * Class EventHistoryRequest
 * @package App\Requests
 */

class EventHistoryRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'eventHitoryEventId' => 'required|int',
            'eventHistoryStatusId' => 'required|int',
            'eventHistoryMessage' => 'required|max:255|string',
            'eventHistoryDateTime' => 'required|max:100|string',
            'eventHistoryUserId' => 'required|int'
        ];
    }
}
