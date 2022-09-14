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
use App\Models\SecurityLevel;
use WebAppId\SmartResponse\Responses\AbstractResponse;

/**
 * @author: 
 * Date: 16:04:09
 * Time: 2022/09/14
 * Class MemberServiceResponse
 * @package App\Services\Responses
 */
class MemberServiceResponse extends AbstractResponse
{
    /**
     * @var Member
     */
    public $member;
}
