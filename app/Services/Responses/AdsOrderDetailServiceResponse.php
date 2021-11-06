<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Responses;

use App\Models\AdsEvent;
use App\Models\AdsOrder;
use App\Models\AdsOrderDetail;
use App\Models\SecurityLevel;
use WebAppId\DDD\Responses\AbstractResponse;

/**
 * @author: 
 * Date: 14:03:55
 * Time: 2021/11/06
 * Class AdsOrderDetailServiceResponse
 * @package App\Services\Responses
 */
class AdsOrderDetailServiceResponse extends AbstractResponse
{
    /**
     * @var AdsOrderDetail
     */
    public $adsOrderDetail;
}
