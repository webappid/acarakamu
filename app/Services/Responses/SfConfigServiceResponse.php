<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Responses;

use App\Models\AdsEvent;
use App\Models\AdsOrder;
use App\Models\AdsOrderDetail;
use App\Models\AdsRefPrice;
use App\Models\CategoryRef;
use App\Models\CityRef;
use App\Models\Event;
use App\Models\EventGallery;
use App\Models\EventHistory;
use App\Models\EventMemberLike;
use App\Models\EventStatusRef;
use App\Models\EventWish;
use App\Models\FailedJob;
use App\Models\Image;
use App\Models\Member;
use App\Models\MemberInterest;
use App\Models\Migration;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderHistoryStatus;
use App\Models\OrderStatus;
use App\Models\PersonalAccessToken;
use App\Models\ProvincesRef;
use App\Models\RoleRoute;
use App\Models\SecurityLevel;
use App\Models\SfAccessRef;
use App\Models\SfConfig;
use WebAppId\SmartResponse\Responses\AbstractResponse;
use WebAppId\User\Models\RolePermission;

/**
 * @author: 
 * Date: 16:04:24
 * Time: 2022/09/14
 * Class SfConfigServiceResponse
 * @package App\Services\Responses
 */
class SfConfigServiceResponse extends AbstractResponse
{
    /**
     * @var SfConfig
     */
    public $sfConfig;
}
