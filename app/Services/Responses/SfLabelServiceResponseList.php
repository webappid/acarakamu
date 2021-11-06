<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Responses;

use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\DDD\Responses\AbstractResponseList;

/**
 * @author: 
 * Date: 14:04:38
 * Time: 2021/11/06
 * Class SfLabelServiceResponseList
 * @package App\Services\Responses
 */
class SfLabelServiceResponseList extends AbstractResponseList
{
    /**
     * @var LengthAwarePaginator
     */
    public $sfLabelList;
}
