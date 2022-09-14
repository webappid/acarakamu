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
 * Class AdsEventRequest
 * @package App\Requests
 */

class AdsEventRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'adsEventEventId' => 'required|int',
            'adsEventAdsOrderId' => 'required|int',
            'adsEventHitNumber' => 'required|int',
            'adsEventDateChange' => 'required|max:100|string',
            'adsEventUserId' => 'required|int'
        ];
    }
}
