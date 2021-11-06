<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Responses;

use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\DDD\Responses\AbstractResponseList;

/**
 * @author: 
 * Date: 14:03:55
 * Time: 2021/11/06
 * Class AdsOrderDetailServiceResponseList
 * @package App\Services\Responses
 */
class AdsOrderDetailServiceResponseList extends AbstractResponseList
{
    /**
     * @var LengthAwarePaginator
     */
    public $adsOrderDetailList;
}
