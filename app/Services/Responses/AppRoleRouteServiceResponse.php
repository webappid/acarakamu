<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Responses;

use App\Models\AdsEvent;
use App\Models\AdsOrder;
use App\Models\AdsOrderDetail;
use App\Models\AdsRefPrice;
use App\Models\AppMenu;
use App\Models\AppMenuCategory;
use App\Models\AppMenuCategoryMenu;
use App\Models\AppMenuRoute;
use App\Models\AppRoleMenu;
use App\Models\AppRoleRoute;
use App\Models\SecurityLevel;
use WebAppId\DDD\Responses\AbstractResponse;

/**
 * @author: 
 * Date: 14:04:01
 * Time: 2021/11/06
 * Class AppRoleRouteServiceResponse
 * @package App\Services\Responses
 */
class AppRoleRouteServiceResponse extends AbstractResponse
{
    /**
     * @var AppRoleRoute
     */
    public $appRoleRoute;
}
