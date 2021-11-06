<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Services\AdsEventServiceTrait;
use App\Services\AdsOrderDetailServiceTrait;
use App\Services\AdsOrderServiceTrait;
use App\Services\AdsRefPriceServiceTrait;
use App\Services\AppMenuCategoryMenuServiceTrait;
use App\Services\AppMenuCategoryServiceTrait;
use App\Services\AppMenuRouteServiceTrait;
use App\Services\AppMenuServiceTrait;
use App\Services\AppRoleMenuServiceTrait;
use App\Services\AppRoleRouteServiceTrait;
use App\Services\AppRouteServiceTrait;
use App\Services\AppSettingServiceTrait;
use App\Services\CategoryRefServiceTrait;
use App\Services\CityRefServiceTrait;
use App\Services\EventGalleryServiceTrait;
use App\Services\EventHistoryServiceTrait;
use App\Services\EventMemberLikeServiceTrait;
use App\Services\EventServiceTrait;
use App\Services\EventStatusRefServiceTrait;
use App\Services\EventWishServiceTrait;
use App\Services\FailedJobServiceTrait;
use App\Services\FontIconServiceTrait;
use App\Services\FontIconTypeServiceTrait;
use App\Services\ImageServiceTrait;
use App\Services\MemberInterestServiceTrait;
use App\Services\MemberServiceTrait;
use App\Services\SecurityLevelServiceTrait;

/**
 * @author: 
 * Date: 14:04:17
 * Time: 2021/11/06
 * Class MemberInterestService
 * @package App\Services
 */
class MemberInterestService 
{
    use MemberInterestServiceTrait;
}
