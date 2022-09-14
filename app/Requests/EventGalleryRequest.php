<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:01
 * Time: 2022/09/14
 * Class EventGalleryRequest
 * @package App\Requests
 */

class EventGalleryRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'eventGalleryEventId' => 'required|int',
            'eventGalleryImageId' => 'required|int',
            'eventGalleryDateChange' => 'required|max:100|string',
            'eventGalleryUserId' => 'required|int'
        ];
    }
}
