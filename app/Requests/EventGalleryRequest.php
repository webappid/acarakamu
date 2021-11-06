<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:07
 * Time: 2021/11/06
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
