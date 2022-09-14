<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\SfGroupMenu;
use App\Repositories\Requests\SfGroupMenuRepositoryRequest;
use App\Repositories\SfGroupMenuRepository;
use App\Services\Requests\SfGroupMenuServiceRequest;
use App\Services\Responses\SfGroupMenuServiceResponse;
use App\Services\Responses\SfGroupMenuServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:26
 * Time: 2022/09/14
 * Class SfGroupMenuServiceTrait
 * @package App\Services
 */
trait SfGroupMenuServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(SfGroupMenuServiceRequest $sfGroupMenuServiceRequest, SfGroupMenuRepositoryRequest $sfGroupMenuRepositoryRequest, SfGroupMenuRepository $sfGroupMenuRepository, SfGroupMenuServiceResponse $sfGroupMenuServiceResponse): SfGroupMenuServiceResponse
    {
        $sfGroupMenuRepositoryRequest = Lazy::transform($sfGroupMenuServiceRequest, $sfGroupMenuRepositoryRequest);

        $result = app()->call([$sfGroupMenuRepository, 'store'], ['sfGroupMenuRepositoryRequest' => $sfGroupMenuRepositoryRequest]);
        if ($result != null) {
            $sfGroupMenuServiceResponse->status = true;
            $sfGroupMenuServiceResponse->message = 'Store Data Success';
            $sfGroupMenuServiceResponse->sfGroupMenu = $result;
        } else {
            $sfGroupMenuServiceResponse->status = false;
            $sfGroupMenuServiceResponse->message = 'Store Data Failed';
        }

        return $sfGroupMenuServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $groupMenuId, SfGroupMenuServiceRequest $sfGroupMenuServiceRequest, SfGroupMenuRepositoryRequest $sfGroupMenuRepositoryRequest, SfGroupMenuRepository $sfGroupMenuRepository, SfGroupMenuServiceResponse $sfGroupMenuServiceResponse): SfGroupMenuServiceResponse
    {
        $sfGroupMenuRepositoryRequest = Lazy::transform($sfGroupMenuServiceRequest, $sfGroupMenuRepositoryRequest);

        $result = app()->call([$sfGroupMenuRepository, 'update'], ['groupMenuId' => $groupMenuId, 'sfGroupMenuRepositoryRequest' => $sfGroupMenuRepositoryRequest]);
        if ($result != null) {
            $sfGroupMenuServiceResponse->status = true;
            $sfGroupMenuServiceResponse->message = 'Update Data Success';
            $sfGroupMenuServiceResponse->sfGroupMenu = $result;
        } else {
            $sfGroupMenuServiceResponse->status = false;
            $sfGroupMenuServiceResponse->message = 'Update Data Failed';
        }

        return $sfGroupMenuServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $groupMenuId, SfGroupMenuRepository $sfGroupMenuRepository, SfGroupMenuServiceResponse $sfGroupMenuServiceResponse): SfGroupMenuServiceResponse
    {
        $status = app()->call([$sfGroupMenuRepository, 'delete'], compact('groupMenuId'));
        $sfGroupMenuServiceResponse->status = $status;
        if($status){
            $sfGroupMenuServiceResponse->message = "Delete Success";
        }else{
            $sfGroupMenuServiceResponse->message = "Delete Failed";
        }

        return $sfGroupMenuServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param SfGroupMenuServiceResponseList $sfGroupMenuServiceResponseList
     * @return SfGroupMenuServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, SfGroupMenuServiceResponseList $sfGroupMenuServiceResponseList): SfGroupMenuServiceResponseList{
        if (count($result) > 0) {
            $sfGroupMenuServiceResponseList->status = true;
            $sfGroupMenuServiceResponseList->message = 'Data Found';
            $sfGroupMenuServiceResponseList->sfGroupMenuList = $result;
            $sfGroupMenuServiceResponseList->count = $result->total();
            $sfGroupMenuServiceResponseList->countFiltered = $result->count();
        } else {
            $sfGroupMenuServiceResponseList->status = false;
            $sfGroupMenuServiceResponseList->message = 'Data Not Found';
        }
        return $sfGroupMenuServiceResponseList;
    }

    /**
     * @param SfGroupMenu|null $sfGroupMenu
     * @param SfGroupMenuServiceResponse $sfGroupMenuServiceResponse
     * @return SfGroupMenuServiceResponse
     */
    private function formatResult(?SfGroupMenu $sfGroupMenu, SfGroupMenuServiceResponse $sfGroupMenuServiceResponse): SfGroupMenuServiceResponse{
        if($sfGroupMenu == null){
            $sfGroupMenuServiceResponse->status = false;
            $sfGroupMenuServiceResponse->message = "Data Not Found";
        }else{
            $sfGroupMenuServiceResponse->status = true;
            $sfGroupMenuServiceResponse->message = "Data Found";
            $sfGroupMenuServiceResponse->sfGroupMenu = $sfGroupMenu;
        }

        return $sfGroupMenuServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(SfGroupMenuRepository $sfGroupMenuRepository, SfGroupMenuServiceResponseList $sfGroupMenuServiceResponseList, int $length = 12, string $q = null): SfGroupMenuServiceResponseList
    {
        $result = app()->call([$sfGroupMenuRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $sfGroupMenuServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(SfGroupMenuRepository $sfGroupMenuRepository, string $q = null): int
    {
        return app()->call([$sfGroupMenuRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByGroupMenuId(int $groupMenuId, SfGroupMenuRepository $sfGroupMenuRepository, SfGroupMenuServiceResponse $sfGroupMenuServiceResponse): SfGroupMenuServiceResponse
    {
        $sfGroupMenu = app()->call([$sfGroupMenuRepository, 'getByGroupMenuId'], compact('groupMenuId'));
        return $this->formatResult($sfGroupMenu, $sfGroupMenuServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByGroupMenuIdList(int $groupMenuId, SfGroupMenuRepository $sfGroupMenuRepository, SfGroupMenuServiceResponseList $sfGroupMenuServiceResponseList, string $q = null,  int $length = 12): SfGroupMenuServiceResponseList
    {
        $sfGroupMenu = app()->call([$sfGroupMenuRepository, 'getByGroupMenuIdList'], compact('groupMenuId', 'length', 'q'));
        return $this->formatResultList($sfGroupMenu, $sfGroupMenuServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfGroupGroupId(int $groupId, SfGroupMenuRepository $sfGroupMenuRepository, SfGroupMenuServiceResponse $sfGroupMenuServiceResponse): SfGroupMenuServiceResponse
    {
        $sfGroupMenu = app()->call([$sfGroupMenuRepository, 'getBySfGroupGroupId'], compact('groupId'));
        return $this->formatResult($sfGroupMenu, $sfGroupMenuServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfGroupGroupIdList(int $groupId, SfGroupMenuRepository $sfGroupMenuRepository, SfGroupMenuServiceResponseList $sfGroupMenuServiceResponseList, string $q = null,  int $length = 12): SfGroupMenuServiceResponseList
    {
        $sfGroupMenu = app()->call([$sfGroupMenuRepository, 'getBySfGroupGroupIdList'], compact('groupId', 'length', 'q'));
        return $this->formatResultList($sfGroupMenu, $sfGroupMenuServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfMenuMenuId(int $menuId, SfGroupMenuRepository $sfGroupMenuRepository, SfGroupMenuServiceResponse $sfGroupMenuServiceResponse): SfGroupMenuServiceResponse
    {
        $sfGroupMenu = app()->call([$sfGroupMenuRepository, 'getBySfMenuMenuId'], compact('menuId'));
        return $this->formatResult($sfGroupMenu, $sfGroupMenuServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfMenuMenuIdList(int $menuId, SfGroupMenuRepository $sfGroupMenuRepository, SfGroupMenuServiceResponseList $sfGroupMenuServiceResponseList, string $q = null,  int $length = 12): SfGroupMenuServiceResponseList
    {
        $sfGroupMenu = app()->call([$sfGroupMenuRepository, 'getBySfMenuMenuIdList'], compact('menuId', 'length', 'q'));
        return $this->formatResultList($sfGroupMenu, $sfGroupMenuServiceResponseList);
    }

}
