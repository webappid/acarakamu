<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:03:54
 * Time: 2021/11/06
 * Class AdsOrderRequest
 * @package App\Requests
 */

class AdsOrderRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'adsOrderNumber' => 'required|max:50|string',
            'adsOrderDateOrder' => 'required|max:100|string',
            'adsOrderStatusId' => 'required|int',
            'adsOrderDateChange' => 'nullable|max:100|string',
            'adsOrderQty' => 'required|int',
            'adsOrderTotal' => 'required|numeric',
            'adsOrderUserId' => 'required|int'
        ];
    }
}
