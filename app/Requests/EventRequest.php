<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:00
 * Time: 2022/09/14
 * Class EventRequest
 * @package App\Requests
 */

class EventRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'eventTitle' => 'required|max:50|string',
            'eventCoverImageId' => 'nullable|int',
            'eventDescription' => 'nullable|max:65535|string',
            'eventCityId' => 'required|int',
            'eventAlamatDetil' => 'nullable|max:65535|string',
            'eventCategoryId' => 'required|int',
            'eventPrice' => 'required|numeric',
            'eventInfo' => 'nullable|max:65535|string',
            'eventStatusId' => 'required|int',
            'eventDateTimeStart' => 'required|max:100|string',
            'eventDateTimeEnd' => 'required|max:100|string',
            'eventDateChange' => 'required|max:100|string',
            'eventQuota' => 'required|int',
            'eventQuotaSisa' => 'required|int',
            'eventGMT' => 'required|int',
            'eventOwnerUserId' => 'required|int',
            'eventUserId' => 'required|int'
        ];
    }
}
