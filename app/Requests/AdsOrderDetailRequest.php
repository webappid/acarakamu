<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:03:56
 * Time: 2021/11/06
 * Class AdsOrderDetailRequest
 * @package App\Requests
 */

class AdsOrderDetailRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'adsOrderDetailAdsOrderId' => 'required|int',
            'adsOrderDetailAdsRefPriceId' => 'required|int',
            'adsOrderDetailAdsEventId' => 'required|int',
            'adsOrderDetailQty' => 'required|int',
            'adsOrderDetailSubTotal' => 'required|numeric',
            'adsOrderDetailTotal' => 'required|numeric',
            'adsOrderDetailDateChange' => 'required|max:100|string'
        ];
    }
}
