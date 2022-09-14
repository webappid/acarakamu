<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:02
 * Time: 2022/09/14
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
