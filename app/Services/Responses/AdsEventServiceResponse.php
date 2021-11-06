<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Responses;

use App\Models\AdsEvent;
use App\Models\SecurityLevel;
use WebAppId\DDD\Responses\AbstractResponse;

/**
 * @author: 
 * Date: 14:03:53
 * Time: 2021/11/06
 * Class AdsEventServiceResponse
 * @package App\Services\Responses
 */
class AdsEventServiceResponse extends AbstractResponse
{
    /**
     * @var AdsEvent
     */
    public $adsEvent;
}
