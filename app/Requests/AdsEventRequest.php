<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:03:53
 * Time: 2021/11/06
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
