<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:06
 * Time: 2022/09/14
 * Class EventWishRequest
 * @package App\Requests
 */

class EventWishRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'wishListEventId' => 'required|int',
            'wishListEventMemberId' => 'required|int'
        ];
    }
}
