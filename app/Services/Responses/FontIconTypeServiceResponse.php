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
use App\Models\FontIconType;
use App\Models\SecurityLevel;
use WebAppId\DDD\Responses\AbstractResponse;

/**
 * @author: 
 * Date: 14:04:13
 * Time: 2021/11/06
 * Class FontIconTypeServiceResponse
 * @package App\Services\Responses
 */
class FontIconTypeServiceResponse extends AbstractResponse
{
    /**
     * @var FontIconType
     */
    public $fontIconType;
}
