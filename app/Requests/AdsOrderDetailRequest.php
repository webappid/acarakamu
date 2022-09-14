<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:03:57
 * Time: 2022/09/14
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
