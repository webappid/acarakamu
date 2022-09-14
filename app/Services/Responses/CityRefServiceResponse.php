<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Responses;

use App\Models\AdsEvent;
use App\Models\AdsOrder;
use App\Models\AdsOrderDetail;
use App\Models\AdsRefPrice;
use App\Models\CategoryRef;
use App\Models\CityRef;
use App\Models\SecurityLevel;
use WebAppId\SmartResponse\Responses\AbstractResponse;

/**
 * @author: 
 * Date: 16:03:59
 * Time: 2022/09/14
 * Class CityRefServiceResponse
 * @package App\Services\Responses
 */
class CityRefServiceResponse extends AbstractResponse
{
    /**
     * @var CityRef
     */
    public $cityRef;
}
