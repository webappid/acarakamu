<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:11
 * Time: 2021/11/06
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
