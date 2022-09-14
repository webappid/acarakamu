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
use App\Models\SfGroup;
use App\Models\SfGroupMenu;
use App\Models\SfGroupModule;
use App\Models\SfLabel;
use App\Models\SfLanguage;
use App\Models\SfMenu;
use App\Models\SfMenuLanguage;
use App\Models\SfMicroprocess;
use App\Models\SfMicroprocessInput;
use App\Models\SfMicroprocessProcess;
use App\Models\SfMicroprocessRefParam;
use App\Models\SfMicroprocessRefProcess;
use App\Models\SfModule;
use App\Models\SfUser;
use WebAppId\SmartResponse\Responses\AbstractResponse;
use WebAppId\User\Models\RolePermission;

/**
 * @author: 
 * Date: 16:04:41
 * Time: 2022/09/14
 * Class SfUserServiceResponse
 * @package App\Services\Responses
 */
class SfUserServiceResponse extends AbstractResponse
{
    /**
     * @var SfUser
     */
    public $sfUser;
}
