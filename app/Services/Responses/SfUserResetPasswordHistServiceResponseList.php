<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Responses;

use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\DDD\Responses\AbstractResponseList;

/**
 * @author: 
 * Date: 14:04:54
 * Time: 2021/11/06
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
