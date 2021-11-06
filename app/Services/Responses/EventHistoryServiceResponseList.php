<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Responses;

use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\DDD\Responses\AbstractResponseList;

/**
 * @author: 
 * Date: 14:04:08
 * Time: 2021/11/06
 * Class EventHistoryServiceResponseList
 * @package App\Services\Responses
 */
class EventHistoryServiceResponseList extends AbstractResponseList
{
    /**
     * @var LengthAwarePaginator
     */
    public $eventHistoryList;
}
