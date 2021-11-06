<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\AppRoleMenu;
use App\Repositories\AppRoleMenuRepository;
use App\Repositories\Requests\AppRoleMenuRepositoryRequest;
use App\Services\Requests\AppRoleMenuServiceRequest;
use App\Services\Responses\AppRoleMenuServiceResponse;
use App\Services\Responses\AppRoleMenuServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 14:04:00
 * Time: 2021/11/06
 * Class AppRoleMenuServiceTrait
 * @package App\Services
 */
trait AppRoleMenuServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(AppRoleMenuServiceRequest $appRoleMenuServiceRequest, AppRoleMenuRepositoryRequest $appRoleMenuRepositoryRequest, AppRoleMenuRepository $appRoleMenuRepository, AppRoleMenuServiceResponse $appRoleMenuServiceResponse): AppRoleMenuServiceResponse
    {
        $appRoleMenuRepositoryRequest = Lazy::transform($appRoleMenuServiceRequest, $appRoleMenuRepositoryRequest);

        $result = app()->call([$appRoleMenuRepository, 'store'], ['appRoleMenuRepositoryRequest' => $appRoleMenuRepositoryRequest]);
        if ($result != null) {
            $appRoleMenuServiceResponse->status = true;
            $appRoleMenuServiceResponse->message = 'Store Data Success';
            $appRoleMenuServiceResponse->appRoleMenu = $result;
        } else {
            $appRoleMenuServiceResponse->status = false;
            $appRoleMenuServiceResponse->message = 'Store Data Failed';
        }

        return $appRoleMenuServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, AppRoleMenuServiceRequest $appRoleMenuServiceRequest, AppRoleMenuRepositoryRequest $appRoleMenuRepositoryRequest, AppRoleMenuRepository $appRoleMenuRepository, AppRoleMenuServiceResponse $appRoleMenuServiceResponse): AppRoleMenuServiceResponse
    {
        $appRoleMenuRepositoryRequest = Lazy::transform($appRoleMenuServiceRequest, $appRoleMenuRepositoryRequest);

        $result = app()->call([$appRoleMenuRepository, 'update'], ['id' => $id, 'appRoleMenuRepositoryRequest' => $appRoleMenuRepositoryRequest]);
        if ($result != null) {
            $appRoleMenuServiceResponse->status = true;
            $appRoleMenuServiceResponse->message = 'Update Data Success';
            $appRoleMenuServiceResponse->appRoleMenu = $result;
        } else {
            $appRoleMenuServiceResponse->status = false;
            $appRoleMenuServiceResponse->message = 'Update Data Failed';
        }

        return $appRoleMenuServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, AppRoleMenuRepository $appRoleMenuRepository, AppRoleMenuServiceResponse $appRoleMenuServiceResponse): AppRoleMenuServiceResponse
    {
        $status = app()->call([$appRoleMenuRepository, 'delete'], compact('id'));
        $appRoleMenuServiceResponse->status = $status;
        if($status){
            $appRoleMenuServiceResponse->message = "Delete Success";
        }else{
            $appRoleMenuServiceResponse->message = "Delete Failed";
        }

        return $appRoleMenuServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param AppRoleMenuServiceResponseList $appRoleMenuServiceResponseList
     * @return AppRoleMenuServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, AppRoleMenuServiceResponseList $appRoleMenuServiceResponseList): AppRoleMenuServiceResponseList{
        if (count($result) > 0) {
            $appRoleMenuServiceResponseList->status = true;
            $appRoleMenuServiceResponseList->message = 'Data Found';
            $appRoleMenuServiceResponseList->appRoleMenuList = $result;
            $appRoleMenuServiceResponseList->count = $result->total();
            $appRoleMenuServiceResponseList->countFiltered = $result->count();
        } else {
            $appRoleMenuServiceResponseList->status = false;
            $appRoleMenuServiceResponseList->message = 'Data Not Found';
        }
        return $appRoleMenuServiceResponseList;
    }

    /**
     * @param AppRoleMenu|null $appRoleMenu
     * @param AppRoleMenuServiceResponse $appRoleMenuServiceResponse
     * @return AppRoleMenuServiceResponse
     */
    private function formatResult(?AppRoleMenu $appRoleMenu, AppRoleMenuServiceResponse $appRoleMenuServiceResponse): AppRoleMenuServiceResponse{
        if($appRoleMenu == null){
            $appRoleMenuServiceResponse->status = false;
            $appRoleMenuServiceResponse->message = "Data Not Found";
        }else{
            $appRoleMenuServiceResponse->status = true;
            $appRoleMenuServiceResponse->message = "Data Found";
            $appRoleMenuServiceResponse->appRoleMenu = $appRoleMenu;
        }

        return $appRoleMenuServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(AppRoleMenuRepository $appRoleMenuRepository, AppRoleMenuServiceResponseList $appRoleMenuServiceResponseList, int $length = 12, string $q = null): AppRoleMenuServiceResponseList
    {
        $result = app()->call([$appRoleMenuRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $appRoleMenuServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(AppRoleMenuRepository $appRoleMenuRepository, string $q = null): int
    {
        return app()->call([$appRoleMenuRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByMenuIdRoleId(int $menuId, int $roleId, AppRoleMenuRepository $appRoleMenuRepository, AppRoleMenuServiceResponse $appRoleMenuServiceResponse): AppRoleMenuServiceResponse
    {
        $appRoleMenu = app()->call([$appRoleMenuRepository, 'getByMenuIdRoleId'], compact('menuId', 'roleId'));
        return $this->formatResult($appRoleMenu, $appRoleMenuServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByMenuIdRoleIdList(int $menuId, int $roleId, AppRoleMenuRepository $appRoleMenuRepository, AppRoleMenuServiceResponseList $appRoleMenuServiceResponseList, string $q = null,  int $length = 12): AppRoleMenuServiceResponseList
    {
        $appRoleMenu = app()->call([$appRoleMenuRepository, 'getByMenuIdRoleIdList'], compact('menuId', 'roleId', 'length', 'q'));
        return $this->formatResultList($appRoleMenu, $appRoleMenuServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id, AppRoleMenuRepository $appRoleMenuRepository, AppRoleMenuServiceResponse $appRoleMenuServiceResponse): AppRoleMenuServiceResponse
    {
        $appRoleMenu = app()->call([$appRoleMenuRepository, 'getById'], compact('id'));
        return $this->formatResult($appRoleMenu, $appRoleMenuServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, AppRoleMenuRepository $appRoleMenuRepository, AppRoleMenuServiceResponseList $appRoleMenuServiceResponseList, string $q = null,  int $length = 12): AppRoleMenuServiceResponseList
    {
        $appRoleMenu = app()->call([$appRoleMenuRepository, 'getByIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($appRoleMenu, $appRoleMenuServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuName(string $name, AppRoleMenuRepository $appRoleMenuRepository, AppRoleMenuServiceResponse $appRoleMenuServiceResponse): AppRoleMenuServiceResponse
    {
        $appRoleMenu = app()->call([$appRoleMenuRepository, 'getByAppMenuName'], compact('name'));
        return $this->formatResult($appRoleMenu, $appRoleMenuServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuNameList(string $name, AppRoleMenuRepository $appRoleMenuRepository, AppRoleMenuServiceResponseList $appRoleMenuServiceResponseList, string $q = null,  int $length = 12): AppRoleMenuServiceResponseList
    {
        $appRoleMenu = app()->call([$appRoleMenuRepository, 'getByAppMenuNameList'], compact('name', 'length', 'q'));
        return $this->formatResultList($appRoleMenu, $appRoleMenuServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuId(int $id, AppRoleMenuRepository $appRoleMenuRepository, AppRoleMenuServiceResponse $appRoleMenuServiceResponse): AppRoleMenuServiceResponse
    {
        $appRoleMenu = app()->call([$appRoleMenuRepository, 'getByAppMenuId'], compact('id'));
        return $this->formatResult($appRoleMenu, $appRoleMenuServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuIdList(int $id, AppRoleMenuRepository $appRoleMenuRepository, AppRoleMenuServiceResponseList $appRoleMenuServiceResponseList, string $q = null,  int $length = 12): AppRoleMenuServiceResponseList
    {
        $appRoleMenu = app()->call([$appRoleMenuRepository, 'getByAppMenuIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($appRoleMenu, $appRoleMenuServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByRoleName(string $name, AppRoleMenuRepository $appRoleMenuRepository, AppRoleMenuServiceResponse $appRoleMenuServiceResponse): AppRoleMenuServiceResponse
    {
        $appRoleMenu = app()->call([$appRoleMenuRepository, 'getByRoleName'], compact('name'));
        return $this->formatResult($appRoleMenu, $appRoleMenuServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByRoleNameList(string $name, AppRoleMenuRepository $appRoleMenuRepository, AppRoleMenuServiceResponseList $appRoleMenuServiceResponseList, string $q = null,  int $length = 12): AppRoleMenuServiceResponseList
    {
        $appRoleMenu = app()->call([$appRoleMenuRepository, 'getByRoleNameList'], compact('name', 'length', 'q'));
        return $this->formatResultList($appRoleMenu, $appRoleMenuServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByRoleId(int $id, AppRoleMenuRepository $appRoleMenuRepository, AppRoleMenuServiceResponse $appRoleMenuServiceResponse): AppRoleMenuServiceResponse
    {
        $appRoleMenu = app()->call([$appRoleMenuRepository, 'getByRoleId'], compact('id'));
        return $this->formatResult($appRoleMenu, $appRoleMenuServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByRoleIdList(int $id, AppRoleMenuRepository $appRoleMenuRepository, AppRoleMenuServiceResponseList $appRoleMenuServiceResponseList, string $q = null,  int $length = 12): AppRoleMenuServiceResponseList
    {
        $appRoleMenu = app()->call([$appRoleMenuRepository, 'getByRoleIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($appRoleMenu, $appRoleMenuServiceResponseList);
    }

}
