<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Services\AdsEventServiceTrait;
use App\Services\AdsOrderDetailServiceTrait;
use App\Services\AdsOrderServiceTrait;
use App\Services\AdsRefPriceServiceTrait;
use App\Services\CategoryRefServiceTrait;
use App\Services\CityRefServiceTrait;
use App\Services\EventGalleryServiceTrait;
use App\Services\EventHistoryServiceTrait;
use App\Services\EventMemberLikeServiceTrait;
use App\Services\EventServiceTrait;
use App\Services\EventStatusRefServiceTrait;
use App\Services\EventWishServiceTrait;
use App\Services\FailedJobServiceTrait;
use App\Services\ImageServiceTrait;
use App\Services\MemberInterestServiceTrait;
use App\Services\MemberServiceTrait;
use App\Services\MigrationServiceTrait;
use App\Services\OrderDetailServiceTrait;
use App\Services\OrderHistoryStatusServiceTrait;
use App\Services\OrderServiceTrait;
use App\Services\OrderStatusServiceTrait;
use App\Services\PersonalAccessTokenServiceTrait;
use App\Services\ProvincesRefServiceTrait;
use App\Services\RolePermissionServiceTrait;
use App\Services\RoleRouteServiceTrait;
use App\Services\SecurityLevelServiceTrait;
use App\Services\SfAccessRefServiceTrait;
use App\Services\SfConfigServiceTrait;
use App\Services\SfGroupMenuServiceTrait;
use App\Services\SfGroupModuleServiceTrait;
use App\Services\SfGroupServiceTrait;
use App\Services\SfLabelServiceTrait;
use App\Services\SfLanguageServiceTrait;
use App\Services\SfMenuLanguageServiceTrait;
use App\Services\SfMenuServiceTrait;
use App\Services\SfMicroprocessInputServiceTrait;
use App\Services\SfMicroprocessProcessServiceTrait;
use App\Services\SfMicroprocessRefParamServiceTrait;
use App\Services\SfMicroprocessRefProcessServiceTrait;
use App\Services\SfMicroprocessServiceTrait;
use App\Services\SfModuleServiceTrait;
use App\Services\SfUserResetPasswordHistServiceTrait;
use App\Services\SfUserServiceTrait;

/**
 * @author: 
 * Date: 16:04:43
 * Time: 2022/09/14
 * Class SfUserResetPasswordHistService
 * @package App\Services
 */
class SfUserResetPasswordHistService 
{
    use SfUserResetPasswordHistServiceTrait;
}
