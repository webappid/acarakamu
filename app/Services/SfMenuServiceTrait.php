<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\SfMenu;
use App\Repositories\Requests\SfMenuRepositoryRequest;
use App\Repositories\SfMenuRepository;
use App\Services\Requests\SfMenuServiceRequest;
use App\Services\Responses\SfMenuServiceResponse;
use App\Services\Responses\SfMenuServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:31
 * Time: 2022/09/14
 * Class SfMenuServiceTrait
 * @package App\Services
 */
trait SfMenuServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(SfMenuServiceRequest $sfMenuServiceRequest, SfMenuRepositoryRequest $sfMenuRepositoryRequest, SfMenuRepository $sfMenuRepository, SfMenuServiceResponse $sfMenuServiceResponse): SfMenuServiceResponse
    {
        $sfMenuRepositoryRequest = Lazy::transform($sfMenuServiceRequest, $sfMenuRepositoryRequest);

        $result = app()->call([$sfMenuRepository, 'store'], ['sfMenuRepositoryRequest' => $sfMenuRepositoryRequest]);
        if ($result != null) {
            $sfMenuServiceResponse->status = true;
            $sfMenuServiceResponse->message = 'Store Data Success';
            $sfMenuServiceResponse->sfMenu = $result;
        } else {
            $sfMenuServiceResponse->status = false;
            $sfMenuServiceResponse->message = 'Store Data Failed';
        }

        return $sfMenuServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $menuId, SfMenuServiceRequest $sfMenuServiceRequest, SfMenuRepositoryRequest $sfMenuRepositoryRequest, SfMenuRepository $sfMenuRepository, SfMenuServiceResponse $sfMenuServiceResponse): SfMenuServiceResponse
    {
        $sfMenuRepositoryRequest = Lazy::transform($sfMenuServiceRequest, $sfMenuRepositoryRequest);

        $result = app()->call([$sfMenuRepository, 'update'], ['menuId' => $menuId, 'sfMenuRepositoryRequest' => $sfMenuRepositoryRequest]);
        if ($result != null) {
            $sfMenuServiceResponse->status = true;
            $sfMenuServiceResponse->message = 'Update Data Success';
            $sfMenuServiceResponse->sfMenu = $result;
        } else {
            $sfMenuServiceResponse->status = false;
            $sfMenuServiceResponse->message = 'Update Data Failed';
        }

        return $sfMenuServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $menuId, SfMenuRepository $sfMenuRepository, SfMenuServiceResponse $sfMenuServiceResponse): SfMenuServiceResponse
    {
        $status = app()->call([$sfMenuRepository, 'delete'], compact('menuId'));
        $sfMenuServiceResponse->status = $status;
        if($status){
            $sfMenuServiceResponse->message = "Delete Success";
        }else{
            $sfMenuServiceResponse->message = "Delete Failed";
        }

        return $sfMenuServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param SfMenuServiceResponseList $sfMenuServiceResponseList
     * @return SfMenuServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, SfMenuServiceResponseList $sfMenuServiceResponseList): SfMenuServiceResponseList{
        if (count($result) > 0) {
            $sfMenuServiceResponseList->status = true;
            $sfMenuServiceResponseList->message = 'Data Found';
            $sfMenuServiceResponseList->sfMenuList = $result;
            $sfMenuServiceResponseList->count = $result->total();
            $sfMenuServiceResponseList->countFiltered = $result->count();
        } else {
            $sfMenuServiceResponseList->status = false;
            $sfMenuServiceResponseList->message = 'Data Not Found';
        }
        return $sfMenuServiceResponseList;
    }

    /**
     * @param SfMenu|null $sfMenu
     * @param SfMenuServiceResponse $sfMenuServiceResponse
     * @return SfMenuServiceResponse
     */
    private function formatResult(?SfMenu $sfMenu, SfMenuServiceResponse $sfMenuServiceResponse): SfMenuServiceResponse{
        if($sfMenu == null){
            $sfMenuServiceResponse->status = false;
            $sfMenuServiceResponse->message = "Data Not Found";
        }else{
            $sfMenuServiceResponse->status = true;
            $sfMenuServiceResponse->message = "Data Found";
            $sfMenuServiceResponse->sfMenu = $sfMenu;
        }

        return $sfMenuServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(SfMenuRepository $sfMenuRepository, SfMenuServiceResponseList $sfMenuServiceResponseList, int $length = 12, string $q = null): SfMenuServiceResponseList
    {
        $result = app()->call([$sfMenuRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $sfMenuServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(SfMenuRepository $sfMenuRepository, string $q = null): int
    {
        return app()->call([$sfMenuRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByMenuId(int $menuId, SfMenuRepository $sfMenuRepository, SfMenuServiceResponse $sfMenuServiceResponse): SfMenuServiceResponse
    {
        $sfMenu = app()->call([$sfMenuRepository, 'getByMenuId'], compact('menuId'));
        return $this->formatResult($sfMenu, $sfMenuServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByMenuIdList(int $menuId, SfMenuRepository $sfMenuRepository, SfMenuServiceResponseList $sfMenuServiceResponseList, string $q = null,  int $length = 12): SfMenuServiceResponseList
    {
        $sfMenu = app()->call([$sfMenuRepository, 'getByMenuIdList'], compact('menuId', 'length', 'q'));
        return $this->formatResultList($sfMenu, $sfMenuServiceResponseList);
    }

}
