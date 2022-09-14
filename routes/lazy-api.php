<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/


Route::get('/security-level/{Id}/detail', App\Http\Controllers\SecurityLevel\SecurityLevelDetailController::class)->name('lazy.security-level.detail');

Route::post('/security-level/store', App\Http\Controllers\SecurityLevel\SecurityLevelStoreController::class)->name('lazy.security-level.store');

Route::get('/security-level/list', App\Http\Controllers\SecurityLevel\SecurityLevelListController::class)->name('lazy.security-level.list');

Route::delete('/security-level/{Id}/delete', App\Http\Controllers\SecurityLevel\SecurityLevelDeleteController::class)->name('lazy.security-level.delete');

Route::put('/security-level/{Id}/update', App\Http\Controllers\SecurityLevel\SecurityLevelUpdateController::class)->name('lazy.security-level.update');

Route::get('/ads-event/{adsEventId}/detail', App\Http\Controllers\AdsEvent\AdsEventDetailController::class)->name('lazy.ads-event.detail');

Route::post('/ads-event/store', App\Http\Controllers\AdsEvent\AdsEventStoreController::class)->name('lazy.ads-event.store');

Route::get('/ads-event/list', App\Http\Controllers\AdsEvent\AdsEventListController::class)->name('lazy.ads-event.list');

Route::delete('/ads-event/{adsEventId}/delete', App\Http\Controllers\AdsEvent\AdsEventDeleteController::class)->name('lazy.ads-event.delete');

Route::put('/ads-event/{adsEventId}/update', App\Http\Controllers\AdsEvent\AdsEventUpdateController::class)->name('lazy.ads-event.update');

Route::get('/ads-order/{adsOrderId}/detail', App\Http\Controllers\AdsOrder\AdsOrderDetailController::class)->name('lazy.ads-order.detail');

Route::post('/ads-order/store', App\Http\Controllers\AdsOrder\AdsOrderStoreController::class)->name('lazy.ads-order.store');

Route::get('/ads-order/list', App\Http\Controllers\AdsOrder\AdsOrderListController::class)->name('lazy.ads-order.list');

Route::delete('/ads-order/{adsOrderId}/delete', App\Http\Controllers\AdsOrder\AdsOrderDeleteController::class)->name('lazy.ads-order.delete');

Route::put('/ads-order/{adsOrderId}/update', App\Http\Controllers\AdsOrder\AdsOrderUpdateController::class)->name('lazy.ads-order.update');

Route::get('/ads-order-detail/{adsOrderDetailId}/detail', App\Http\Controllers\AdsOrderDetail\AdsOrderDetailDetailController::class)->name('lazy.ads-order-detail.detail');

Route::post('/ads-order-detail/store', App\Http\Controllers\AdsOrderDetail\AdsOrderDetailStoreController::class)->name('lazy.ads-order-detail.store');

Route::get('/ads-order-detail/list', App\Http\Controllers\AdsOrderDetail\AdsOrderDetailListController::class)->name('lazy.ads-order-detail.list');

Route::delete('/ads-order-detail/{adsOrderDetailId}/delete', App\Http\Controllers\AdsOrderDetail\AdsOrderDetailDeleteController::class)->name('lazy.ads-order-detail.delete');

Route::put('/ads-order-detail/{adsOrderDetailId}/update', App\Http\Controllers\AdsOrderDetail\AdsOrderDetailUpdateController::class)->name('lazy.ads-order-detail.update');

Route::get('/ads-ref-price/{adsPriceRefId}/detail', App\Http\Controllers\AdsRefPrice\AdsRefPriceDetailController::class)->name('lazy.ads-ref-price.detail');

Route::post('/ads-ref-price/store', App\Http\Controllers\AdsRefPrice\AdsRefPriceStoreController::class)->name('lazy.ads-ref-price.store');

Route::get('/ads-ref-price/list', App\Http\Controllers\AdsRefPrice\AdsRefPriceListController::class)->name('lazy.ads-ref-price.list');

Route::delete('/ads-ref-price/{adsPriceRefId}/delete', App\Http\Controllers\AdsRefPrice\AdsRefPriceDeleteController::class)->name('lazy.ads-ref-price.delete');

Route::put('/ads-ref-price/{adsPriceRefId}/update', App\Http\Controllers\AdsRefPrice\AdsRefPriceUpdateController::class)->name('lazy.ads-ref-price.update');

Route::get('/category-ref/{categoryId}/detail', App\Http\Controllers\CategoryRef\CategoryRefDetailController::class)->name('lazy.category-ref.detail');

Route::post('/category-ref/store', App\Http\Controllers\CategoryRef\CategoryRefStoreController::class)->name('lazy.category-ref.store');

Route::get('/category-ref/list', App\Http\Controllers\CategoryRef\CategoryRefListController::class)->name('lazy.category-ref.list');

Route::delete('/category-ref/{categoryId}/delete', App\Http\Controllers\CategoryRef\CategoryRefDeleteController::class)->name('lazy.category-ref.delete');

Route::put('/category-ref/{categoryId}/update', App\Http\Controllers\CategoryRef\CategoryRefUpdateController::class)->name('lazy.category-ref.update');

Route::get('/city-ref/{cityId}/detail', App\Http\Controllers\CityRef\CityRefDetailController::class)->name('lazy.city-ref.detail');

Route::post('/city-ref/store', App\Http\Controllers\CityRef\CityRefStoreController::class)->name('lazy.city-ref.store');

Route::get('/city-ref/list', App\Http\Controllers\CityRef\CityRefListController::class)->name('lazy.city-ref.list');

Route::delete('/city-ref/{cityId}/delete', App\Http\Controllers\CityRef\CityRefDeleteController::class)->name('lazy.city-ref.delete');

Route::put('/city-ref/{cityId}/update', App\Http\Controllers\CityRef\CityRefUpdateController::class)->name('lazy.city-ref.update');

Route::get('/event/{eventId}/detail', App\Http\Controllers\Event\EventDetailController::class)->name('lazy.event.detail');

Route::post('/event/store', App\Http\Controllers\Event\EventStoreController::class)->name('lazy.event.store');

Route::get('/event/list', App\Http\Controllers\Event\EventListController::class)->name('lazy.event.list');

Route::delete('/event/{eventId}/delete', App\Http\Controllers\Event\EventDeleteController::class)->name('lazy.event.delete');

Route::put('/event/{eventId}/update', App\Http\Controllers\Event\EventUpdateController::class)->name('lazy.event.update');

Route::get('/event-gallery/{eventGalleryId}/detail', App\Http\Controllers\EventGallery\EventGalleryDetailController::class)->name('lazy.event-gallery.detail');

Route::post('/event-gallery/store', App\Http\Controllers\EventGallery\EventGalleryStoreController::class)->name('lazy.event-gallery.store');

Route::get('/event-gallery/list', App\Http\Controllers\EventGallery\EventGalleryListController::class)->name('lazy.event-gallery.list');

Route::delete('/event-gallery/{eventGalleryId}/delete', App\Http\Controllers\EventGallery\EventGalleryDeleteController::class)->name('lazy.event-gallery.delete');

Route::put('/event-gallery/{eventGalleryId}/update', App\Http\Controllers\EventGallery\EventGalleryUpdateController::class)->name('lazy.event-gallery.update');

Route::get('/event-history/{eventHistoryId}/detail', App\Http\Controllers\EventHistory\EventHistoryDetailController::class)->name('lazy.event-history.detail');

Route::post('/event-history/store', App\Http\Controllers\EventHistory\EventHistoryStoreController::class)->name('lazy.event-history.store');

Route::get('/event-history/list', App\Http\Controllers\EventHistory\EventHistoryListController::class)->name('lazy.event-history.list');

Route::delete('/event-history/{eventHistoryId}/delete', App\Http\Controllers\EventHistory\EventHistoryDeleteController::class)->name('lazy.event-history.delete');

Route::put('/event-history/{eventHistoryId}/update', App\Http\Controllers\EventHistory\EventHistoryUpdateController::class)->name('lazy.event-history.update');

Route::get('/event-member-like/{eventMemberLikeId}/detail', App\Http\Controllers\EventMemberLike\EventMemberLikeDetailController::class)->name('lazy.event-member-like.detail');

Route::post('/event-member-like/store', App\Http\Controllers\EventMemberLike\EventMemberLikeStoreController::class)->name('lazy.event-member-like.store');

Route::get('/event-member-like/list', App\Http\Controllers\EventMemberLike\EventMemberLikeListController::class)->name('lazy.event-member-like.list');

Route::delete('/event-member-like/{eventMemberLikeId}/delete', App\Http\Controllers\EventMemberLike\EventMemberLikeDeleteController::class)->name('lazy.event-member-like.delete');

Route::put('/event-member-like/{eventMemberLikeId}/update', App\Http\Controllers\EventMemberLike\EventMemberLikeUpdateController::class)->name('lazy.event-member-like.update');

Route::get('/event-status-ref/{eventStatusId}/detail', App\Http\Controllers\EventStatusRef\EventStatusRefDetailController::class)->name('lazy.event-status-ref.detail');

Route::post('/event-status-ref/store', App\Http\Controllers\EventStatusRef\EventStatusRefStoreController::class)->name('lazy.event-status-ref.store');

Route::get('/event-status-ref/list', App\Http\Controllers\EventStatusRef\EventStatusRefListController::class)->name('lazy.event-status-ref.list');

Route::delete('/event-status-ref/{eventStatusId}/delete', App\Http\Controllers\EventStatusRef\EventStatusRefDeleteController::class)->name('lazy.event-status-ref.delete');

Route::put('/event-status-ref/{eventStatusId}/update', App\Http\Controllers\EventStatusRef\EventStatusRefUpdateController::class)->name('lazy.event-status-ref.update');

Route::get('/event-wish/{wishListId}/detail', App\Http\Controllers\EventWish\EventWishDetailController::class)->name('lazy.event-wish.detail');

Route::post('/event-wish/store', App\Http\Controllers\EventWish\EventWishStoreController::class)->name('lazy.event-wish.store');

Route::get('/event-wish/list', App\Http\Controllers\EventWish\EventWishListController::class)->name('lazy.event-wish.list');

Route::delete('/event-wish/{wishListId}/delete', App\Http\Controllers\EventWish\EventWishDeleteController::class)->name('lazy.event-wish.delete');

Route::put('/event-wish/{wishListId}/update', App\Http\Controllers\EventWish\EventWishUpdateController::class)->name('lazy.event-wish.update');

Route::get('/failed-job/{uuid}/detail', App\Http\Controllers\FailedJobs\FailedJobDetailController::class)->name('lazy.failed-job.detail');

Route::post('/failed-job/store', App\Http\Controllers\FailedJobs\FailedJobStoreController::class)->name('lazy.failed-job.store');

Route::get('/failed-job/list', App\Http\Controllers\FailedJobs\FailedJobListController::class)->name('lazy.failed-job.list');

Route::delete('/failed-job/{uuid}/delete', App\Http\Controllers\FailedJobs\FailedJobDeleteController::class)->name('lazy.failed-job.delete');

Route::put('/failed-job/{uuid}/update', App\Http\Controllers\FailedJobs\FailedJobUpdateController::class)->name('lazy.failed-job.update');

Route::get('/image/{imageId}/detail', App\Http\Controllers\Image\ImageDetailController::class)->name('lazy.image.detail');

Route::post('/image/store', App\Http\Controllers\Image\ImageStoreController::class)->name('lazy.image.store');

Route::get('/image/list', App\Http\Controllers\Image\ImageListController::class)->name('lazy.image.list');

Route::delete('/image/{imageId}/delete', App\Http\Controllers\Image\ImageDeleteController::class)->name('lazy.image.delete');

Route::put('/image/{imageId}/update', App\Http\Controllers\Image\ImageUpdateController::class)->name('lazy.image.update');

Route::get('/member/{memberId}/detail', App\Http\Controllers\Member\MemberDetailController::class)->name('lazy.member.detail');

Route::post('/member/store', App\Http\Controllers\Member\MemberStoreController::class)->name('lazy.member.store');

Route::get('/member/list', App\Http\Controllers\Member\MemberListController::class)->name('lazy.member.list');

Route::delete('/member/{memberId}/delete', App\Http\Controllers\Member\MemberDeleteController::class)->name('lazy.member.delete');

Route::put('/member/{memberId}/update', App\Http\Controllers\Member\MemberUpdateController::class)->name('lazy.member.update');

Route::get('/member-interest/{memberInterestId}/detail', App\Http\Controllers\MemberInterest\MemberInterestDetailController::class)->name('lazy.member-interest.detail');

Route::post('/member-interest/store', App\Http\Controllers\MemberInterest\MemberInterestStoreController::class)->name('lazy.member-interest.store');

Route::get('/member-interest/list', App\Http\Controllers\MemberInterest\MemberInterestListController::class)->name('lazy.member-interest.list');

Route::delete('/member-interest/{memberInterestId}/delete', App\Http\Controllers\MemberInterest\MemberInterestDeleteController::class)->name('lazy.member-interest.delete');

Route::put('/member-interest/{memberInterestId}/update', App\Http\Controllers\MemberInterest\MemberInterestUpdateController::class)->name('lazy.member-interest.update');

Route::get('/migration/{id}/detail', App\Http\Controllers\Migrations\MigrationDetailController::class)->name('lazy.migration.detail');

Route::post('/migration/store', App\Http\Controllers\Migrations\MigrationStoreController::class)->name('lazy.migration.store');

Route::get('/migration/list', App\Http\Controllers\Migrations\MigrationListController::class)->name('lazy.migration.list');

Route::delete('/migration/{id}/delete', App\Http\Controllers\Migrations\MigrationDeleteController::class)->name('lazy.migration.delete');

Route::put('/migration/{id}/update', App\Http\Controllers\Migrations\MigrationUpdateController::class)->name('lazy.migration.update');

Route::get('/order/{orderId}/detail', App\Http\Controllers\Order\OrderDetailController::class)->name('lazy.order.detail');

Route::post('/order/store', App\Http\Controllers\Order\OrderStoreController::class)->name('lazy.order.store');

Route::get('/order/list', App\Http\Controllers\Order\OrderListController::class)->name('lazy.order.list');

Route::delete('/order/{orderId}/delete', App\Http\Controllers\Order\OrderDeleteController::class)->name('lazy.order.delete');

Route::put('/order/{orderId}/update', App\Http\Controllers\Order\OrderUpdateController::class)->name('lazy.order.update');

Route::get('/order-detail/{orderDetailId}/detail', App\Http\Controllers\OrderDetail\OrderDetailDetailController::class)->name('lazy.order-detail.detail');

Route::post('/order-detail/store', App\Http\Controllers\OrderDetail\OrderDetailStoreController::class)->name('lazy.order-detail.store');

Route::get('/order-detail/list', App\Http\Controllers\OrderDetail\OrderDetailListController::class)->name('lazy.order-detail.list');

Route::delete('/order-detail/{orderDetailId}/delete', App\Http\Controllers\OrderDetail\OrderDetailDeleteController::class)->name('lazy.order-detail.delete');

Route::put('/order-detail/{orderDetailId}/update', App\Http\Controllers\OrderDetail\OrderDetailUpdateController::class)->name('lazy.order-detail.update');

Route::get('/order-history-status/{orderHistoryStatusId}/detail', App\Http\Controllers\OrderHistoryStatus\OrderHistoryStatusDetailController::class)->name('lazy.order-history-status.detail');

Route::post('/order-history-status/store', App\Http\Controllers\OrderHistoryStatus\OrderHistoryStatusStoreController::class)->name('lazy.order-history-status.store');

Route::get('/order-history-status/list', App\Http\Controllers\OrderHistoryStatus\OrderHistoryStatusListController::class)->name('lazy.order-history-status.list');

Route::delete('/order-history-status/{orderHistoryStatusId}/delete', App\Http\Controllers\OrderHistoryStatus\OrderHistoryStatusDeleteController::class)->name('lazy.order-history-status.delete');

Route::put('/order-history-status/{orderHistoryStatusId}/update', App\Http\Controllers\OrderHistoryStatus\OrderHistoryStatusUpdateController::class)->name('lazy.order-history-status.update');

Route::get('/order-status/{orderStatusId}/detail', App\Http\Controllers\OrderStatus\OrderStatusDetailController::class)->name('lazy.order-status.detail');

Route::post('/order-status/store', App\Http\Controllers\OrderStatus\OrderStatusStoreController::class)->name('lazy.order-status.store');

Route::get('/order-status/list', App\Http\Controllers\OrderStatus\OrderStatusListController::class)->name('lazy.order-status.list');

Route::delete('/order-status/{orderStatusId}/delete', App\Http\Controllers\OrderStatus\OrderStatusDeleteController::class)->name('lazy.order-status.delete');

Route::put('/order-status/{orderStatusId}/update', App\Http\Controllers\OrderStatus\OrderStatusUpdateController::class)->name('lazy.order-status.update');

Route::get('/permission/{id}/detail', App\Http\Controllers\Permissions\PermissionDetailController::class)->name('lazy.permission.detail');

Route::post('/permission/store', App\Http\Controllers\Permissions\PermissionStoreController::class)->name('lazy.permission.store');

Route::get('/permission/list', App\Http\Controllers\Permissions\PermissionListController::class)->name('lazy.permission.list');

Route::delete('/permission/{id}/delete', App\Http\Controllers\Permissions\PermissionDeleteController::class)->name('lazy.permission.delete');

Route::put('/permission/{id}/update', App\Http\Controllers\Permissions\PermissionUpdateController::class)->name('lazy.permission.update');

Route::get('/personal-access-token/{token}/detail', App\Http\Controllers\PersonalAccessTokens\PersonalAccessTokenDetailController::class)->name('lazy.personal-access-token.detail');

Route::post('/personal-access-token/store', App\Http\Controllers\PersonalAccessTokens\PersonalAccessTokenStoreController::class)->name('lazy.personal-access-token.store');

Route::get('/personal-access-token/list', App\Http\Controllers\PersonalAccessTokens\PersonalAccessTokenListController::class)->name('lazy.personal-access-token.list');

Route::delete('/personal-access-token/{token}/delete', App\Http\Controllers\PersonalAccessTokens\PersonalAccessTokenDeleteController::class)->name('lazy.personal-access-token.delete');

Route::put('/personal-access-token/{token}/update', App\Http\Controllers\PersonalAccessTokens\PersonalAccessTokenUpdateController::class)->name('lazy.personal-access-token.update');

Route::get('/provinces-ref/{provincesRefId}/detail', App\Http\Controllers\ProvincesRef\ProvincesRefDetailController::class)->name('lazy.provinces-ref.detail');

Route::post('/provinces-ref/store', App\Http\Controllers\ProvincesRef\ProvincesRefStoreController::class)->name('lazy.provinces-ref.store');

Route::get('/provinces-ref/list', App\Http\Controllers\ProvincesRef\ProvincesRefListController::class)->name('lazy.provinces-ref.list');

Route::delete('/provinces-ref/{provincesRefId}/delete', App\Http\Controllers\ProvincesRef\ProvincesRefDeleteController::class)->name('lazy.provinces-ref.delete');

Route::put('/provinces-ref/{provincesRefId}/update', App\Http\Controllers\ProvincesRef\ProvincesRefUpdateController::class)->name('lazy.provinces-ref.update');

Route::get('/role-permission/{id}/detail', App\Http\Controllers\RolePermissions\RolePermissionDetailController::class)->name('lazy.role-permission.detail');

Route::post('/role-permission/store', App\Http\Controllers\RolePermissions\RolePermissionStoreController::class)->name('lazy.role-permission.store');

Route::get('/role-permission/list', App\Http\Controllers\RolePermissions\RolePermissionListController::class)->name('lazy.role-permission.list');

Route::delete('/role-permission/{id}/delete', App\Http\Controllers\RolePermissions\RolePermissionDeleteController::class)->name('lazy.role-permission.delete');

Route::put('/role-permission/{id}/update', App\Http\Controllers\RolePermissions\RolePermissionUpdateController::class)->name('lazy.role-permission.update');

Route::get('/role-route/{id}/detail', App\Http\Controllers\RoleRoutes\RoleRouteDetailController::class)->name('lazy.role-route.detail');

Route::post('/role-route/store', App\Http\Controllers\RoleRoutes\RoleRouteStoreController::class)->name('lazy.role-route.store');

Route::get('/role-route/list', App\Http\Controllers\RoleRoutes\RoleRouteListController::class)->name('lazy.role-route.list');

Route::delete('/role-route/{id}/delete', App\Http\Controllers\RoleRoutes\RoleRouteDeleteController::class)->name('lazy.role-route.delete');

Route::put('/role-route/{id}/update', App\Http\Controllers\RoleRoutes\RoleRouteUpdateController::class)->name('lazy.role-route.update');

Route::get('/route/{name}/detail', App\Http\Controllers\Routes\RouteDetailController::class)->name('lazy.route.detail');

Route::post('/route/store', App\Http\Controllers\Routes\RouteStoreController::class)->name('lazy.route.store');

Route::get('/route/list', App\Http\Controllers\Routes\RouteListController::class)->name('lazy.route.list');

Route::delete('/route/{name}/delete', App\Http\Controllers\Routes\RouteDeleteController::class)->name('lazy.route.delete');

Route::put('/route/{name}/update', App\Http\Controllers\Routes\RouteUpdateController::class)->name('lazy.route.update');

Route::get('/sf-access-ref/{accessId}/detail', App\Http\Controllers\SfAccessRef\SfAccessRefDetailController::class)->name('lazy.sf-access-ref.detail');

Route::post('/sf-access-ref/store', App\Http\Controllers\SfAccessRef\SfAccessRefStoreController::class)->name('lazy.sf-access-ref.store');

Route::get('/sf-access-ref/list', App\Http\Controllers\SfAccessRef\SfAccessRefListController::class)->name('lazy.sf-access-ref.list');

Route::delete('/sf-access-ref/{accessId}/delete', App\Http\Controllers\SfAccessRef\SfAccessRefDeleteController::class)->name('lazy.sf-access-ref.delete');

Route::put('/sf-access-ref/{accessId}/update', App\Http\Controllers\SfAccessRef\SfAccessRefUpdateController::class)->name('lazy.sf-access-ref.update');

Route::get('/sf-config/{configCode}/detail', App\Http\Controllers\SfConfig\SfConfigDetailController::class)->name('lazy.sf-config.detail');

Route::post('/sf-config/store', App\Http\Controllers\SfConfig\SfConfigStoreController::class)->name('lazy.sf-config.store');

Route::get('/sf-config/list', App\Http\Controllers\SfConfig\SfConfigListController::class)->name('lazy.sf-config.list');

Route::delete('/sf-config/{configCode}/delete', App\Http\Controllers\SfConfig\SfConfigDeleteController::class)->name('lazy.sf-config.delete');

Route::put('/sf-config/{configCode}/update', App\Http\Controllers\SfConfig\SfConfigUpdateController::class)->name('lazy.sf-config.update');

Route::get('/sf-group/{groupId}/detail', App\Http\Controllers\SfGroup\SfGroupDetailController::class)->name('lazy.sf-group.detail');

Route::post('/sf-group/store', App\Http\Controllers\SfGroup\SfGroupStoreController::class)->name('lazy.sf-group.store');

Route::get('/sf-group/list', App\Http\Controllers\SfGroup\SfGroupListController::class)->name('lazy.sf-group.list');

Route::delete('/sf-group/{groupId}/delete', App\Http\Controllers\SfGroup\SfGroupDeleteController::class)->name('lazy.sf-group.delete');

Route::put('/sf-group/{groupId}/update', App\Http\Controllers\SfGroup\SfGroupUpdateController::class)->name('lazy.sf-group.update');

Route::get('/sf-group-menu/{groupMenuId}/detail', App\Http\Controllers\SfGroupMenu\SfGroupMenuDetailController::class)->name('lazy.sf-group-menu.detail');

Route::post('/sf-group-menu/store', App\Http\Controllers\SfGroupMenu\SfGroupMenuStoreController::class)->name('lazy.sf-group-menu.store');

Route::get('/sf-group-menu/list', App\Http\Controllers\SfGroupMenu\SfGroupMenuListController::class)->name('lazy.sf-group-menu.list');

Route::delete('/sf-group-menu/{groupMenuId}/delete', App\Http\Controllers\SfGroupMenu\SfGroupMenuDeleteController::class)->name('lazy.sf-group-menu.delete');

Route::put('/sf-group-menu/{groupMenuId}/update', App\Http\Controllers\SfGroupMenu\SfGroupMenuUpdateController::class)->name('lazy.sf-group-menu.update');

Route::get('/sf-group-module/{groupModId}/detail', App\Http\Controllers\SfGroupModule\SfGroupModuleDetailController::class)->name('lazy.sf-group-module.detail');

Route::post('/sf-group-module/store', App\Http\Controllers\SfGroupModule\SfGroupModuleStoreController::class)->name('lazy.sf-group-module.store');

Route::get('/sf-group-module/list', App\Http\Controllers\SfGroupModule\SfGroupModuleListController::class)->name('lazy.sf-group-module.list');

Route::delete('/sf-group-module/{groupModId}/delete', App\Http\Controllers\SfGroupModule\SfGroupModuleDeleteController::class)->name('lazy.sf-group-module.delete');

Route::put('/sf-group-module/{groupModId}/update', App\Http\Controllers\SfGroupModule\SfGroupModuleUpdateController::class)->name('lazy.sf-group-module.update');

Route::get('/sf-label/{labelId}/detail', App\Http\Controllers\SfLabel\SfLabelDetailController::class)->name('lazy.sf-label.detail');

Route::post('/sf-label/store', App\Http\Controllers\SfLabel\SfLabelStoreController::class)->name('lazy.sf-label.store');

Route::get('/sf-label/list', App\Http\Controllers\SfLabel\SfLabelListController::class)->name('lazy.sf-label.list');

Route::delete('/sf-label/{labelId}/delete', App\Http\Controllers\SfLabel\SfLabelDeleteController::class)->name('lazy.sf-label.delete');

Route::put('/sf-label/{labelId}/update', App\Http\Controllers\SfLabel\SfLabelUpdateController::class)->name('lazy.sf-label.update');

Route::get('/sf-language/{languageId}/detail', App\Http\Controllers\SfLanguage\SfLanguageDetailController::class)->name('lazy.sf-language.detail');

Route::post('/sf-language/store', App\Http\Controllers\SfLanguage\SfLanguageStoreController::class)->name('lazy.sf-language.store');

Route::get('/sf-language/list', App\Http\Controllers\SfLanguage\SfLanguageListController::class)->name('lazy.sf-language.list');

Route::delete('/sf-language/{languageId}/delete', App\Http\Controllers\SfLanguage\SfLanguageDeleteController::class)->name('lazy.sf-language.delete');

Route::put('/sf-language/{languageId}/update', App\Http\Controllers\SfLanguage\SfLanguageUpdateController::class)->name('lazy.sf-language.update');

Route::get('/sf-menu/{menuId}/detail', App\Http\Controllers\SfMenu\SfMenuDetailController::class)->name('lazy.sf-menu.detail');

Route::post('/sf-menu/store', App\Http\Controllers\SfMenu\SfMenuStoreController::class)->name('lazy.sf-menu.store');

Route::get('/sf-menu/list', App\Http\Controllers\SfMenu\SfMenuListController::class)->name('lazy.sf-menu.list');

Route::delete('/sf-menu/{menuId}/delete', App\Http\Controllers\SfMenu\SfMenuDeleteController::class)->name('lazy.sf-menu.delete');

Route::put('/sf-menu/{menuId}/update', App\Http\Controllers\SfMenu\SfMenuUpdateController::class)->name('lazy.sf-menu.update');

Route::get('/sf-menu-language/{menuLangId}/detail', App\Http\Controllers\SfMenuLanguage\SfMenuLanguageDetailController::class)->name('lazy.sf-menu-language.detail');

Route::post('/sf-menu-language/store', App\Http\Controllers\SfMenuLanguage\SfMenuLanguageStoreController::class)->name('lazy.sf-menu-language.store');

Route::get('/sf-menu-language/list', App\Http\Controllers\SfMenuLanguage\SfMenuLanguageListController::class)->name('lazy.sf-menu-language.list');

Route::delete('/sf-menu-language/{menuLangId}/delete', App\Http\Controllers\SfMenuLanguage\SfMenuLanguageDeleteController::class)->name('lazy.sf-menu-language.delete');

Route::put('/sf-menu-language/{menuLangId}/update', App\Http\Controllers\SfMenuLanguage\SfMenuLanguageUpdateController::class)->name('lazy.sf-menu-language.update');

Route::get('/sf-microprocess/{microprocessCode}/detail', App\Http\Controllers\SfMicroprocess\SfMicroprocessDetailController::class)->name('lazy.sf-microprocess.detail');

Route::post('/sf-microprocess/store', App\Http\Controllers\SfMicroprocess\SfMicroprocessStoreController::class)->name('lazy.sf-microprocess.store');

Route::get('/sf-microprocess/list', App\Http\Controllers\SfMicroprocess\SfMicroprocessListController::class)->name('lazy.sf-microprocess.list');

Route::delete('/sf-microprocess/{microprocessCode}/delete', App\Http\Controllers\SfMicroprocess\SfMicroprocessDeleteController::class)->name('lazy.sf-microprocess.delete');

Route::put('/sf-microprocess/{microprocessCode}/update', App\Http\Controllers\SfMicroprocess\SfMicroprocessUpdateController::class)->name('lazy.sf-microprocess.update');

Route::get('/sf-microprocess-input/{microprocessInputId}/detail', App\Http\Controllers\SfMicroprocessInput\SfMicroprocessInputDetailController::class)->name('lazy.sf-microprocess-input.detail');

Route::post('/sf-microprocess-input/store', App\Http\Controllers\SfMicroprocessInput\SfMicroprocessInputStoreController::class)->name('lazy.sf-microprocess-input.store');

Route::get('/sf-microprocess-input/list', App\Http\Controllers\SfMicroprocessInput\SfMicroprocessInputListController::class)->name('lazy.sf-microprocess-input.list');

Route::delete('/sf-microprocess-input/{microprocessInputId}/delete', App\Http\Controllers\SfMicroprocessInput\SfMicroprocessInputDeleteController::class)->name('lazy.sf-microprocess-input.delete');

Route::put('/sf-microprocess-input/{microprocessInputId}/update', App\Http\Controllers\SfMicroprocessInput\SfMicroprocessInputUpdateController::class)->name('lazy.sf-microprocess-input.update');

Route::get('/sf-microprocess-process/{microprocessProcessId}/detail', App\Http\Controllers\SfMicroprocessProcess\SfMicroprocessProcessDetailController::class)->name('lazy.sf-microprocess-process.detail');

Route::post('/sf-microprocess-process/store', App\Http\Controllers\SfMicroprocessProcess\SfMicroprocessProcessStoreController::class)->name('lazy.sf-microprocess-process.store');

Route::get('/sf-microprocess-process/list', App\Http\Controllers\SfMicroprocessProcess\SfMicroprocessProcessListController::class)->name('lazy.sf-microprocess-process.list');

Route::delete('/sf-microprocess-process/{microprocessProcessId}/delete', App\Http\Controllers\SfMicroprocessProcess\SfMicroprocessProcessDeleteController::class)->name('lazy.sf-microprocess-process.delete');

Route::put('/sf-microprocess-process/{microprocessProcessId}/update', App\Http\Controllers\SfMicroprocessProcess\SfMicroprocessProcessUpdateController::class)->name('lazy.sf-microprocess-process.update');

Route::get('/sf-microprocess-ref-param/{paramName}/detail', App\Http\Controllers\SfMicroprocessRefParam\SfMicroprocessRefParamDetailController::class)->name('lazy.sf-microprocess-ref-param.detail');

Route::post('/sf-microprocess-ref-param/store', App\Http\Controllers\SfMicroprocessRefParam\SfMicroprocessRefParamStoreController::class)->name('lazy.sf-microprocess-ref-param.store');

Route::get('/sf-microprocess-ref-param/list', App\Http\Controllers\SfMicroprocessRefParam\SfMicroprocessRefParamListController::class)->name('lazy.sf-microprocess-ref-param.list');

Route::delete('/sf-microprocess-ref-param/{paramName}/delete', App\Http\Controllers\SfMicroprocessRefParam\SfMicroprocessRefParamDeleteController::class)->name('lazy.sf-microprocess-ref-param.delete');

Route::put('/sf-microprocess-ref-param/{paramName}/update', App\Http\Controllers\SfMicroprocessRefParam\SfMicroprocessRefParamUpdateController::class)->name('lazy.sf-microprocess-ref-param.update');

Route::get('/sf-microprocess-ref-process/{processCode}/detail', App\Http\Controllers\SfMicroprocessRefProcess\SfMicroprocessRefProcessDetailController::class)->name('lazy.sf-microprocess-ref-process.detail');

Route::post('/sf-microprocess-ref-process/store', App\Http\Controllers\SfMicroprocessRefProcess\SfMicroprocessRefProcessStoreController::class)->name('lazy.sf-microprocess-ref-process.store');

Route::get('/sf-microprocess-ref-process/list', App\Http\Controllers\SfMicroprocessRefProcess\SfMicroprocessRefProcessListController::class)->name('lazy.sf-microprocess-ref-process.list');

Route::delete('/sf-microprocess-ref-process/{processCode}/delete', App\Http\Controllers\SfMicroprocessRefProcess\SfMicroprocessRefProcessDeleteController::class)->name('lazy.sf-microprocess-ref-process.delete');

Route::put('/sf-microprocess-ref-process/{processCode}/update', App\Http\Controllers\SfMicroprocessRefProcess\SfMicroprocessRefProcessUpdateController::class)->name('lazy.sf-microprocess-ref-process.update');

Route::get('/sf-module/{moduleCode}/detail', App\Http\Controllers\SfModule\SfModuleDetailController::class)->name('lazy.sf-module.detail');

Route::post('/sf-module/store', App\Http\Controllers\SfModule\SfModuleStoreController::class)->name('lazy.sf-module.store');

Route::get('/sf-module/list', App\Http\Controllers\SfModule\SfModuleListController::class)->name('lazy.sf-module.list');

Route::delete('/sf-module/{moduleCode}/delete', App\Http\Controllers\SfModule\SfModuleDeleteController::class)->name('lazy.sf-module.delete');

Route::put('/sf-module/{moduleCode}/update', App\Http\Controllers\SfModule\SfModuleUpdateController::class)->name('lazy.sf-module.update');

Route::get('/sf-user/{userName}/detail', App\Http\Controllers\SfUser\SfUserDetailController::class)->name('lazy.sf-user.detail');

Route::post('/sf-user/store', App\Http\Controllers\SfUser\SfUserStoreController::class)->name('lazy.sf-user.store');

Route::get('/sf-user/list', App\Http\Controllers\SfUser\SfUserListController::class)->name('lazy.sf-user.list');

Route::delete('/sf-user/{userName}/delete', App\Http\Controllers\SfUser\SfUserDeleteController::class)->name('lazy.sf-user.delete');

Route::put('/sf-user/{userName}/update', App\Http\Controllers\SfUser\SfUserUpdateController::class)->name('lazy.sf-user.update');

Route::get('/sf-user-reset-password-hist/{userResetPasswordHistId}/detail', App\Http\Controllers\SfUserResetPasswordHist\SfUserResetPasswordHistDetailController::class)->name('lazy.sf-user-reset-password-hist.detail');

Route::post('/sf-user-reset-password-hist/store', App\Http\Controllers\SfUserResetPasswordHist\SfUserResetPasswordHistStoreController::class)->name('lazy.sf-user-reset-password-hist.store');

Route::get('/sf-user-reset-password-hist/list', App\Http\Controllers\SfUserResetPasswordHist\SfUserResetPasswordHistListController::class)->name('lazy.sf-user-reset-password-hist.list');

Route::delete('/sf-user-reset-password-hist/{userResetPasswordHistId}/delete', App\Http\Controllers\SfUserResetPasswordHist\SfUserResetPasswordHistDeleteController::class)->name('lazy.sf-user-reset-password-hist.delete');

Route::put('/sf-user-reset-password-hist/{userResetPasswordHistId}/update', App\Http\Controllers\SfUserResetPasswordHist\SfUserResetPasswordHistUpdateController::class)->name('lazy.sf-user-reset-password-hist.update');

Route::get('/system-log/{logId}/detail', App\Http\Controllers\SystemLog\SystemLogDetailController::class)->name('lazy.system-log.detail');

Route::post('/system-log/store', App\Http\Controllers\SystemLog\SystemLogStoreController::class)->name('lazy.system-log.store');

Route::get('/system-log/list', App\Http\Controllers\SystemLog\SystemLogListController::class)->name('lazy.system-log.list');

Route::delete('/system-log/{logId}/delete', App\Http\Controllers\SystemLog\SystemLogDeleteController::class)->name('lazy.system-log.delete');

Route::put('/system-log/{logId}/update', App\Http\Controllers\SystemLog\SystemLogUpdateController::class)->name('lazy.system-log.update');
