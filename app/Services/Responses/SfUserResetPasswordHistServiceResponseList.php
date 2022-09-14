<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Responses;

use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\SmartResponse\Responses\AbstractResponseList;

/**
 * @author: 
 * Date: 16:04:43
 * Time: 2022/09/14
 * Class SfUserResetPasswordHistServiceResponseList
 * @package App\Services\Responses
 */
class SfUserResetPasswordHistServiceResponseList extends AbstractResponseList
{
    /**
     * @var LengthAwarePaginator
     */
    public $sfUserResetPasswordHistList;
}
