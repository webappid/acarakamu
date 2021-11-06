<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Responses;

use App\Models\AdsEvent;
use App\Models\AdsOrder;
use App\Models\SecurityLevel;
use WebAppId\DDD\Responses\AbstractResponse;

/**
 * @author: 
 * Date: 14:03:54
 * Time: 2021/11/06
 * Class AdsOrderServiceResponse
 * @package App\Services\Responses
 */
class AdsOrderServiceResponse extends AbstractResponse
{
    /**
     * @var AdsOrder
     */
    public $adsOrder;
}
