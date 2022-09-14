<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Responses;

use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\SmartResponse\Responses\AbstractResponseList;

/**
 * @author: 
 * Date: 16:04:28
 * Time: 2022/09/14
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
