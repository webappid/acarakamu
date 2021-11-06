<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\AppMenu;
use App\Repositories\AppMenuRepository;
use App\Repositories\Requests\AppMenuRepositoryRequest;
use App\Services\Requests\AppMenuServiceRequest;
use App\Services\Responses\AppMenuServiceResponse;
use App\Services\Responses\AppMenuServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 14:04:00
 * Time: 2021/11/06
 * Class AppMenuServiceTrait
 * @package App\Services
 */
trait AppMenuServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(AppMenuServiceRequest $appMenuServiceRequest, AppMenuRepositoryRequest $appMenuRepositoryRequest, AppMenuRepository $appMenuRepository, AppMenuServiceResponse $appMenuServiceResponse): AppMenuServiceResponse
    {
        $appMenuRepositoryRequest = Lazy::transform($appMenuServiceRequest, $appMenuRepositoryRequest);

        $result = app()->call([$appMenuRepository, 'store'], ['appMenuRepositoryRequest' => $appMenuRepositoryRequest]);
        if ($result != null) {
            $appMenuServiceResponse->status = true;
            $appMenuServiceResponse->message = 'Store Data Success';
            $appMenuServiceResponse->appMenu = $result;
        } else {
            $appMenuServiceResponse->status = false;
            $appMenuServiceResponse->message = 'Store Data Failed';
        }

        return $appMenuServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(string $name, AppMenuServiceRequest $appMenuServiceRequest, AppMenuRepositoryRequest $appMenuRepositoryRequest, AppMenuRepository $appMenuRepository, AppMenuServiceResponse $appMenuServiceResponse): AppMenuServiceResponse
    {
        $appMenuRepositoryRequest = Lazy::transform($appMenuServiceRequest, $appMenuRepositoryRequest);

        $result = app()->call([$appMenuRepository, 'update'], ['name' => $name, 'appMenuRepositoryRequest' => $appMenuRepositoryRequest]);
        if ($result != null) {
            $appMenuServiceResponse->status = true;
            $appMenuServiceResponse->message = 'Update Data Success';
            $appMenuServiceResponse->appMenu = $result;
        } else {
            $appMenuServiceResponse->status = false;
            $appMenuServiceResponse->message = 'Update Data Failed';
        }

        return $appMenuServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $name, AppMenuRepository $appMenuRepository, AppMenuServiceResponse $appMenuServiceResponse): AppMenuServiceResponse
    {
        $status = app()->call([$appMenuRepository, 'delete'], compact('name'));
        $appMenuServiceResponse->status = $status;
        if($status){
            $appMenuServiceResponse->message = "Delete Success";
        }else{
            $appMenuServiceResponse->message = "Delete Failed";
        }

        return $appMenuServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param AppMenuServiceResponseList $appMenuServiceResponseList
     * @return AppMenuServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, AppMenuServiceResponseList $appMenuServiceResponseList): AppMenuServiceResponseList{
        if (count($result) > 0) {
            $appMenuServiceResponseList->status = true;
            $appMenuServiceResponseList->message = 'Data Found';
            $appMenuServiceResponseList->appMenuList = $result;
            $appMenuServiceResponseList->count = $result->total();
            $appMenuServiceResponseList->countFiltered = $result->count();
        } else {
            $appMenuServiceResponseList->status = false;
            $appMenuServiceResponseList->message = 'Data Not Found';
        }
        return $appMenuServiceResponseList;
    }

    /**
     * @param AppMenu|null $appMenu
     * @param AppMenuServiceResponse $appMenuServiceResponse
     * @return AppMenuServiceResponse
     */
    private function formatResult(?AppMenu $appMenu, AppMenuServiceResponse $appMenuServiceResponse): AppMenuServiceResponse{
        if($appMenu == null){
            $appMenuServiceResponse->status = false;
            $appMenuServiceResponse->message = "Data Not Found";
        }else{
            $appMenuServiceResponse->status = true;
            $appMenuServiceResponse->message = "Data Found";
            $appMenuServiceResponse->appMenu = $appMenu;
        }

        return $appMenuServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(AppMenuRepository $appMenuRepository, AppMenuServiceResponseList $appMenuServiceResponseList, int $length = 12, string $q = null): AppMenuServiceResponseList
    {
        $result = app()->call([$appMenuRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $appMenuServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(AppMenuRepository $appMenuRepository, string $q = null): int
    {
        return app()->call([$appMenuRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByName(string $name, AppMenuRepository $appMenuRepository, AppMenuServiceResponse $appMenuServiceResponse): AppMenuServiceResponse
    {
        $appMenu = app()->call([$appMenuRepository, 'getByName'], compact('name'));
        return $this->formatResult($appMenu, $appMenuServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByNameList(string $name, AppMenuRepository $appMenuRepository, AppMenuServiceResponseList $appMenuServiceResponseList, string $q = null,  int $length = 12): AppMenuServiceResponseList
    {
        $appMenu = app()->call([$appMenuRepository, 'getByNameList'], compact('name', 'length', 'q'));
        return $this->formatResultList($appMenu, $appMenuServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id, AppMenuRepository $appMenuRepository, AppMenuServiceResponse $appMenuServiceResponse): AppMenuServiceResponse
    {
        $appMenu = app()->call([$appMenuRepository, 'getById'], compact('id'));
        return $this->formatResult($appMenu, $appMenuServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, AppMenuRepository $appMenuRepository, AppMenuServiceResponseList $appMenuServiceResponseList, string $q = null,  int $length = 12): AppMenuServiceResponseList
    {
        $appMenu = app()->call([$appMenuRepository, 'getByIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($appMenu, $appMenuServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByAppRouteName(string $name, AppMenuRepository $appMenuRepository, AppMenuServiceResponse $appMenuServiceResponse): AppMenuServiceResponse
    {
        $appMenu = app()->call([$appMenuRepository, 'getByAppRouteName'], compact('name'));
        return $this->formatResult($appMenu, $appMenuServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByAppRouteNameList(string $name, AppMenuRepository $appMenuRepository, AppMenuServiceResponseList $appMenuServiceResponseList, string $q = null,  int $length = 12): AppMenuServiceResponseList
    {
        $appMenu = app()->call([$appMenuRepository, 'getByAppRouteNameList'], compact('name', 'length', 'q'));
        return $this->formatResultList($appMenu, $appMenuServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByAppRouteId(int $id, AppMenuRepository $appMenuRepository, AppMenuServiceResponse $appMenuServiceResponse): AppMenuServiceResponse
    {
        $appMenu = app()->call([$appMenuRepository, 'getByAppRouteId'], compact('id'));
        return $this->formatResult($appMenu, $appMenuServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByAppRouteIdList(int $id, AppMenuRepository $appMenuRepository, AppMenuServiceResponseList $appMenuServiceResponseList, string $q = null,  int $length = 12): AppMenuServiceResponseList
    {
        $appMenu = app()->call([$appMenuRepository, 'getByAppRouteIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($appMenu, $appMenuServiceResponseList);
    }

}
