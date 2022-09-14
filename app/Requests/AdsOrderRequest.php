<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:03:55
 * Time: 2022/09/14
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
