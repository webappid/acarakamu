<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Responses;

use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\SmartResponse\Responses\AbstractResponseList;

/**
 * @author: 
 * Date: 16:03:59
 * Time: 2022/09/14
 * Class CityRefServiceResponseList
 * @package App\Services\Responses
 */
class CityRefServiceResponseList extends AbstractResponseList
{
    /**
     * @var LengthAwarePaginator
     */
    public $cityRefList;
}
