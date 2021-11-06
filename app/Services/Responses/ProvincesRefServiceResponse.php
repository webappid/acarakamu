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
use App\Models\AppRoute;
use App\Models\AppSetting;
use App\Models\CategoryRef;
use App\Models\CityRef;
use App\Models\Event;
use App\Models\EventGallery;
use App\Models\EventHistory;
use App\Models\EventMemberLike;
use App\Models\EventStatusRef;
use App\Models\EventWish;
use App\Models\FailedJob;
use App\Models\FontIcon;
use App\Models\FontIconType;
use App\Models\Image;
use App\Models\Member;
use App\Models\MemberInterest;
use App\Models\Migration;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderHistoryStatus;
use App\Models\OrderStatus;
use App\Models\Permission;
use App\Models\PersonalAccessToken;
use App\Models\ProvincesRef;
use App\Models\SecurityLevel;
use WebAppId\DDD\Responses\AbstractResponse;

/**
 * @author: 
 * Date: 14:04:29
 * Time: 2021/11/06
 * Class ProvincesRefServiceResponse
 * @package App\Services\Responses
 */
class ProvincesRefServiceResponse extends AbstractResponse
{
    /**
     * @var ProvincesRef
     */
    public $provincesRef;
}
