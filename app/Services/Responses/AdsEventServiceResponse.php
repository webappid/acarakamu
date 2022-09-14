<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Responses;

use App\Models\AdsEvent;
use App\Models\SecurityLevel;
use WebAppId\SmartResponse\Responses\AbstractResponse;

/**
 * @author: 
 * Date: 16:03:55
 * Time: 2022/09/14
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
