<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Responses;

use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\DDD\Responses\AbstractResponseList;

/**
 * @author: 
 * Date: 14:04:00
 * Time: 2021/11/06
 * Class AppRoleMenuServiceResponseList
 * @package App\Services\Responses
 */
class AppRoleMenuServiceResponseList extends AbstractResponseList
{
    /**
     * @var LengthAwarePaginator
     */
    public $appRoleMenuList;
}
