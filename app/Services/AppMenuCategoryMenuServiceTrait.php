<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\AppMenuCategoryMenu;
use App\Repositories\AppMenuCategoryMenuRepository;
use App\Repositories\Requests\AppMenuCategoryMenuRepositoryRequest;
use App\Services\Requests\AppMenuCategoryMenuServiceRequest;
use App\Services\Responses\AppMenuCategoryMenuServiceResponse;
use App\Services\Responses\AppMenuCategoryMenuServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 14:03:58
 * Time: 2021/11/06
 * Class AppMenuCategoryMenuServiceTrait
 * @package App\Services
 */
trait AppMenuCategoryMenuServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(AppMenuCategoryMenuServiceRequest $appMenuCategoryMenuServiceRequest, AppMenuCategoryMenuRepositoryRequest $appMenuCategoryMenuRepositoryRequest, AppMenuCategoryMenuRepository $appMenuCategoryMenuRepository, AppMenuCategoryMenuServiceResponse $appMenuCategoryMenuServiceResponse): AppMenuCategoryMenuServiceResponse
    {
        $appMenuCategoryMenuRepositoryRequest = Lazy::transform($appMenuCategoryMenuServiceRequest, $appMenuCategoryMenuRepositoryRequest);

        $result = app()->call([$appMenuCategoryMenuRepository, 'store'], ['appMenuCategoryMenuRepositoryRequest' => $appMenuCategoryMenuRepositoryRequest]);
        if ($result != null) {
            $appMenuCategoryMenuServiceResponse->status = true;
            $appMenuCategoryMenuServiceResponse->message = 'Store Data Success';
            $appMenuCategoryMenuServiceResponse->appMenuCategoryMenu = $result;
        } else {
            $appMenuCategoryMenuServiceResponse->status = false;
            $appMenuCategoryMenuServiceResponse->message = 'Store Data Failed';
        }

        return $appMenuCategoryMenuServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, AppMenuCategoryMenuServiceRequest $appMenuCategoryMenuServiceRequest, AppMenuCategoryMenuRepositoryRequest $appMenuCategoryMenuRepositoryRequest, AppMenuCategoryMenuRepository $appMenuCategoryMenuRepository, AppMenuCategoryMenuServiceResponse $appMenuCategoryMenuServiceResponse): AppMenuCategoryMenuServiceResponse
    {
        $appMenuCategoryMenuRepositoryRequest = Lazy::transform($appMenuCategoryMenuServiceRequest, $appMenuCategoryMenuRepositoryRequest);

        $result = app()->call([$appMenuCategoryMenuRepository, 'update'], ['id' => $id, 'appMenuCategoryMenuRepositoryRequest' => $appMenuCategoryMenuRepositoryRequest]);
        if ($result != null) {
            $appMenuCategoryMenuServiceResponse->status = true;
            $appMenuCategoryMenuServiceResponse->message = 'Update Data Success';
            $appMenuCategoryMenuServiceResponse->appMenuCategoryMenu = $result;
        } else {
            $appMenuCategoryMenuServiceResponse->status = false;
            $appMenuCategoryMenuServiceResponse->message = 'Update Data Failed';
        }

        return $appMenuCategoryMenuServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, AppMenuCategoryMenuRepository $appMenuCategoryMenuRepository, AppMenuCategoryMenuServiceResponse $appMenuCategoryMenuServiceResponse): AppMenuCategoryMenuServiceResponse
    {
        $status = app()->call([$appMenuCategoryMenuRepository, 'delete'], compact('id'));
        $appMenuCategoryMenuServiceResponse->status = $status;
        if($status){
            $appMenuCategoryMenuServiceResponse->message = "Delete Success";
        }else{
            $appMenuCategoryMenuServiceResponse->message = "Delete Failed";
        }

        return $appMenuCategoryMenuServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param AppMenuCategoryMenuServiceResponseList $appMenuCategoryMenuServiceResponseList
     * @return AppMenuCategoryMenuServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, AppMenuCategoryMenuServiceResponseList $appMenuCategoryMenuServiceResponseList): AppMenuCategoryMenuServiceResponseList{
        if (count($result) > 0) {
            $appMenuCategoryMenuServiceResponseList->status = true;
            $appMenuCategoryMenuServiceResponseList->message = 'Data Found';
            $appMenuCategoryMenuServiceResponseList->appMenuCategoryMenuList = $result;
            $appMenuCategoryMenuServiceResponseList->count = $result->total();
            $appMenuCategoryMenuServiceResponseList->countFiltered = $result->count();
        } else {
            $appMenuCategoryMenuServiceResponseList->status = false;
            $appMenuCategoryMenuServiceResponseList->message = 'Data Not Found';
        }
        return $appMenuCategoryMenuServiceResponseList;
    }

    /**
     * @param AppMenuCategoryMenu|null $appMenuCategoryMenu
     * @param AppMenuCategoryMenuServiceResponse $appMenuCategoryMenuServiceResponse
     * @return AppMenuCategoryMenuServiceResponse
     */
    private function formatResult(?AppMenuCategoryMenu $appMenuCategoryMenu, AppMenuCategoryMenuServiceResponse $appMenuCategoryMenuServiceResponse): AppMenuCategoryMenuServiceResponse{
        if($appMenuCategoryMenu == null){
            $appMenuCategoryMenuServiceResponse->status = false;
            $appMenuCategoryMenuServiceResponse->message = "Data Not Found";
        }else{
            $appMenuCategoryMenuServiceResponse->status = true;
            $appMenuCategoryMenuServiceResponse->message = "Data Found";
            $appMenuCategoryMenuServiceResponse->appMenuCategoryMenu = $appMenuCategoryMenu;
        }

        return $appMenuCategoryMenuServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(AppMenuCategoryMenuRepository $appMenuCategoryMenuRepository, AppMenuCategoryMenuServiceResponseList $appMenuCategoryMenuServiceResponseList, int $length = 12, string $q = null): AppMenuCategoryMenuServiceResponseList
    {
        $result = app()->call([$appMenuCategoryMenuRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $appMenuCategoryMenuServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(AppMenuCategoryMenuRepository $appMenuCategoryMenuRepository, string $q = null): int
    {
        return app()->call([$appMenuCategoryMenuRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getById(int $id, AppMenuCategoryMenuRepository $appMenuCategoryMenuRepository, AppMenuCategoryMenuServiceResponse $appMenuCategoryMenuServiceResponse): AppMenuCategoryMenuServiceResponse
    {
        $appMenuCategoryMenu = app()->call([$appMenuCategoryMenuRepository, 'getById'], compact('id'));
        return $this->formatResult($appMenuCategoryMenu, $appMenuCategoryMenuServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, AppMenuCategoryMenuRepository $appMenuCategoryMenuRepository, AppMenuCategoryMenuServiceResponseList $appMenuCategoryMenuServiceResponseList, string $q = null,  int $length = 12): AppMenuCategoryMenuServiceResponseList
    {
        $appMenuCategoryMenu = app()->call([$appMenuCategoryMenuRepository, 'getByIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($appMenuCategoryMenu, $appMenuCategoryMenuServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuCategoryName(string $name, AppMenuCategoryMenuRepository $appMenuCategoryMenuRepository, AppMenuCategoryMenuServiceResponse $appMenuCategoryMenuServiceResponse): AppMenuCategoryMenuServiceResponse
    {
        $appMenuCategoryMenu = app()->call([$appMenuCategoryMenuRepository, 'getByAppMenuCategoryName'], compact('name'));
        return $this->formatResult($appMenuCategoryMenu, $appMenuCategoryMenuServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuCategoryNameList(string $name, AppMenuCategoryMenuRepository $appMenuCategoryMenuRepository, AppMenuCategoryMenuServiceResponseList $appMenuCategoryMenuServiceResponseList, string $q = null,  int $length = 12): AppMenuCategoryMenuServiceResponseList
    {
        $appMenuCategoryMenu = app()->call([$appMenuCategoryMenuRepository, 'getByAppMenuCategoryNameList'], compact('name', 'length', 'q'));
        return $this->formatResultList($appMenuCategoryMenu, $appMenuCategoryMenuServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuCategoryId(int $id, AppMenuCategoryMenuRepository $appMenuCategoryMenuRepository, AppMenuCategoryMenuServiceResponse $appMenuCategoryMenuServiceResponse): AppMenuCategoryMenuServiceResponse
    {
        $appMenuCategoryMenu = app()->call([$appMenuCategoryMenuRepository, 'getByAppMenuCategoryId'], compact('id'));
        return $this->formatResult($appMenuCategoryMenu, $appMenuCategoryMenuServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuCategoryIdList(int $id, AppMenuCategoryMenuRepository $appMenuCategoryMenuRepository, AppMenuCategoryMenuServiceResponseList $appMenuCategoryMenuServiceResponseList, string $q = null,  int $length = 12): AppMenuCategoryMenuServiceResponseList
    {
        $appMenuCategoryMenu = app()->call([$appMenuCategoryMenuRepository, 'getByAppMenuCategoryIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($appMenuCategoryMenu, $appMenuCategoryMenuServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuName(string $name, AppMenuCategoryMenuRepository $appMenuCategoryMenuRepository, AppMenuCategoryMenuServiceResponse $appMenuCategoryMenuServiceResponse): AppMenuCategoryMenuServiceResponse
    {
        $appMenuCategoryMenu = app()->call([$appMenuCategoryMenuRepository, 'getByAppMenuName'], compact('name'));
        return $this->formatResult($appMenuCategoryMenu, $appMenuCategoryMenuServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuNameList(string $name, AppMenuCategoryMenuRepository $appMenuCategoryMenuRepository, AppMenuCategoryMenuServiceResponseList $appMenuCategoryMenuServiceResponseList, string $q = null,  int $length = 12): AppMenuCategoryMenuServiceResponseList
    {
        $appMenuCategoryMenu = app()->call([$appMenuCategoryMenuRepository, 'getByAppMenuNameList'], compact('name', 'length', 'q'));
        return $this->formatResultList($appMenuCategoryMenu, $appMenuCategoryMenuServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuId(int $id, AppMenuCategoryMenuRepository $appMenuCategoryMenuRepository, AppMenuCategoryMenuServiceResponse $appMenuCategoryMenuServiceResponse): AppMenuCategoryMenuServiceResponse
    {
        $appMenuCategoryMenu = app()->call([$appMenuCategoryMenuRepository, 'getByAppMenuId'], compact('id'));
        return $this->formatResult($appMenuCategoryMenu, $appMenuCategoryMenuServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuIdList(int $id, AppMenuCategoryMenuRepository $appMenuCategoryMenuRepository, AppMenuCategoryMenuServiceResponseList $appMenuCategoryMenuServiceResponseList, string $q = null,  int $length = 12): AppMenuCategoryMenuServiceResponseList
    {
        $appMenuCategoryMenu = app()->call([$appMenuCategoryMenuRepository, 'getByAppMenuIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($appMenuCategoryMenu, $appMenuCategoryMenuServiceResponseList);
    }

}
