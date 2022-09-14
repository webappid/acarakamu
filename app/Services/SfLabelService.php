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

/**
 * @author: 
 * Date: 16:04:28
 * Time: 2022/09/14
 * Class SfLabelService
 * @package App\Services
 */
class SfLabelService 
{
    use SfLabelServiceTrait;
}
