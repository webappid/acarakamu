<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Responses;

use App\Models\AdsEvent;
use App\Models\AdsOrder;
use App\Models\AdsOrderDetail;
use App\Models\AdsRefPrice;
use App\Models\SecurityLevel;
use WebAppId\SmartResponse\Responses\AbstractResponse;

/**
 * @author: 
 * Date: 16:03:57
 * Time: 2022/09/14
 * Class AdsRefPriceServiceResponse
 * @package App\Services\Responses
 */
class AdsRefPriceServiceResponse extends AbstractResponse
{
    /**
     * @var AdsRefPrice
     */
    public $adsRefPrice;
}
