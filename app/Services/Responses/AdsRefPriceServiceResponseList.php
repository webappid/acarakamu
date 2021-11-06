<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Responses;

use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\DDD\Responses\AbstractResponseList;

/**
 * @author: 
 * Date: 14:03:56
 * Time: 2021/11/06
 * Class AdsRefPriceServiceResponseList
 * @package App\Services\Responses
 */
class AdsRefPriceServiceResponseList extends AbstractResponseList
{
    /**
     * @var LengthAwarePaginator
     */
    public $adsRefPriceList;
}
