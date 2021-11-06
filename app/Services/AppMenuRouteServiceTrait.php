<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\AppMenuRoute;
use App\Repositories\AppMenuRouteRepository;
use App\Repositories\Requests\AppMenuRouteRepositoryRequest;
use App\Services\Requests\AppMenuRouteServiceRequest;
use App\Services\Responses\AppMenuRouteServiceResponse;
use App\Services\Responses\AppMenuRouteServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 14:03:59
 * Time: 2021/11/06
 * Class AppMenuRouteServiceTrait
 * @package App\Services
 */
trait AppMenuRouteServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(AppMenuRouteServiceRequest $appMenuRouteServiceRequest, AppMenuRouteRepositoryRequest $appMenuRouteRepositoryRequest, AppMenuRouteRepository $appMenuRouteRepository, AppMenuRouteServiceResponse $appMenuRouteServiceResponse): AppMenuRouteServiceResponse
    {
        $appMenuRouteRepositoryRequest = Lazy::transform($appMenuRouteServiceRequest, $appMenuRouteRepositoryRequest);

        $result = app()->call([$appMenuRouteRepository, 'store'], ['appMenuRouteRepositoryRequest' => $appMenuRouteRepositoryRequest]);
        if ($result != null) {
            $appMenuRouteServiceResponse->status = true;
            $appMenuRouteServiceResponse->message = 'Store Data Success';
            $appMenuRouteServiceResponse->appMenuRoute = $result;
        } else {
            $appMenuRouteServiceResponse->status = false;
            $appMenuRouteServiceResponse->message = 'Store Data Failed';
        }

        return $appMenuRouteServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, AppMenuRouteServiceRequest $appMenuRouteServiceRequest, AppMenuRouteRepositoryRequest $appMenuRouteRepositoryRequest, AppMenuRouteRepository $appMenuRouteRepository, AppMenuRouteServiceResponse $appMenuRouteServiceResponse): AppMenuRouteServiceResponse
    {
        $appMenuRouteRepositoryRequest = Lazy::transform($appMenuRouteServiceRequest, $appMenuRouteRepositoryRequest);

        $result = app()->call([$appMenuRouteRepository, 'update'], ['id' => $id, 'appMenuRouteRepositoryRequest' => $appMenuRouteRepositoryRequest]);
        if ($result != null) {
            $appMenuRouteServiceResponse->status = true;
            $appMenuRouteServiceResponse->message = 'Update Data Success';
            $appMenuRouteServiceResponse->appMenuRoute = $result;
        } else {
            $appMenuRouteServiceResponse->status = false;
            $appMenuRouteServiceResponse->message = 'Update Data Failed';
        }

        return $appMenuRouteServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, AppMenuRouteRepository $appMenuRouteRepository, AppMenuRouteServiceResponse $appMenuRouteServiceResponse): AppMenuRouteServiceResponse
    {
        $status = app()->call([$appMenuRouteRepository, 'delete'], compact('id'));
        $appMenuRouteServiceResponse->status = $status;
        if($status){
            $appMenuRouteServiceResponse->message = "Delete Success";
        }else{
            $appMenuRouteServiceResponse->message = "Delete Failed";
        }

        return $appMenuRouteServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param AppMenuRouteServiceResponseList $appMenuRouteServiceResponseList
     * @return AppMenuRouteServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, AppMenuRouteServiceResponseList $appMenuRouteServiceResponseList): AppMenuRouteServiceResponseList{
        if (count($result) > 0) {
            $appMenuRouteServiceResponseList->status = true;
            $appMenuRouteServiceResponseList->message = 'Data Found';
            $appMenuRouteServiceResponseList->appMenuRouteList = $result;
            $appMenuRouteServiceResponseList->count = $result->total();
            $appMenuRouteServiceResponseList->countFiltered = $result->count();
        } else {
            $appMenuRouteServiceResponseList->status = false;
            $appMenuRouteServiceResponseList->message = 'Data Not Found';
        }
        return $appMenuRouteServiceResponseList;
    }

    /**
     * @param AppMenuRoute|null $appMenuRoute
     * @param AppMenuRouteServiceResponse $appMenuRouteServiceResponse
     * @return AppMenuRouteServiceResponse
     */
    private function formatResult(?AppMenuRoute $appMenuRoute, AppMenuRouteServiceResponse $appMenuRouteServiceResponse): AppMenuRouteServiceResponse{
        if($appMenuRoute == null){
            $appMenuRouteServiceResponse->status = false;
            $appMenuRouteServiceResponse->message = "Data Not Found";
        }else{
            $appMenuRouteServiceResponse->status = true;
            $appMenuRouteServiceResponse->message = "Data Found";
            $appMenuRouteServiceResponse->appMenuRoute = $appMenuRoute;
        }

        return $appMenuRouteServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(AppMenuRouteRepository $appMenuRouteRepository, AppMenuRouteServiceResponseList $appMenuRouteServiceResponseList, int $length = 12, string $q = null): AppMenuRouteServiceResponseList
    {
        $result = app()->call([$appMenuRouteRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $appMenuRouteServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(AppMenuRouteRepository $appMenuRouteRepository, string $q = null): int
    {
        return app()->call([$appMenuRouteRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getById(int $id, AppMenuRouteRepository $appMenuRouteRepository, AppMenuRouteServiceResponse $appMenuRouteServiceResponse): AppMenuRouteServiceResponse
    {
        $appMenuRoute = app()->call([$appMenuRouteRepository, 'getById'], compact('id'));
        return $this->formatResult($appMenuRoute, $appMenuRouteServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, AppMenuRouteRepository $appMenuRouteRepository, AppMenuRouteServiceResponseList $appMenuRouteServiceResponseList, string $q = null,  int $length = 12): AppMenuRouteServiceResponseList
    {
        $appMenuRoute = app()->call([$appMenuRouteRepository, 'getByIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($appMenuRoute, $appMenuRouteServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuName(string $name, AppMenuRouteRepository $appMenuRouteRepository, AppMenuRouteServiceResponse $appMenuRouteServiceResponse): AppMenuRouteServiceResponse
    {
        $appMenuRoute = app()->call([$appMenuRouteRepository, 'getByAppMenuName'], compact('name'));
        return $this->formatResult($appMenuRoute, $appMenuRouteServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuNameList(string $name, AppMenuRouteRepository $appMenuRouteRepository, AppMenuRouteServiceResponseList $appMenuRouteServiceResponseList, string $q = null,  int $length = 12): AppMenuRouteServiceResponseList
    {
        $appMenuRoute = app()->call([$appMenuRouteRepository, 'getByAppMenuNameList'], compact('name', 'length', 'q'));
        return $this->formatResultList($appMenuRoute, $appMenuRouteServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuId(int $id, AppMenuRouteRepository $appMenuRouteRepository, AppMenuRouteServiceResponse $appMenuRouteServiceResponse): AppMenuRouteServiceResponse
    {
        $appMenuRoute = app()->call([$appMenuRouteRepository, 'getByAppMenuId'], compact('id'));
        return $this->formatResult($appMenuRoute, $appMenuRouteServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuIdList(int $id, AppMenuRouteRepository $appMenuRouteRepository, AppMenuRouteServiceResponseList $appMenuRouteServiceResponseList, string $q = null,  int $length = 12): AppMenuRouteServiceResponseList
    {
        $appMenuRoute = app()->call([$appMenuRouteRepository, 'getByAppMenuIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($appMenuRoute, $appMenuRouteServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByAppRouteName(string $name, AppMenuRouteRepository $appMenuRouteRepository, AppMenuRouteServiceResponse $appMenuRouteServiceResponse): AppMenuRouteServiceResponse
    {
        $appMenuRoute = app()->call([$appMenuRouteRepository, 'getByAppRouteName'], compact('name'));
        return $this->formatResult($appMenuRoute, $appMenuRouteServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByAppRouteNameList(string $name, AppMenuRouteRepository $appMenuRouteRepository, AppMenuRouteServiceResponseList $appMenuRouteServiceResponseList, string $q = null,  int $length = 12): AppMenuRouteServiceResponseList
    {
        $appMenuRoute = app()->call([$appMenuRouteRepository, 'getByAppRouteNameList'], compact('name', 'length', 'q'));
        return $this->formatResultList($appMenuRoute, $appMenuRouteServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByAppRouteId(int $id, AppMenuRouteRepository $appMenuRouteRepository, AppMenuRouteServiceResponse $appMenuRouteServiceResponse): AppMenuRouteServiceResponse
    {
        $appMenuRoute = app()->call([$appMenuRouteRepository, 'getByAppRouteId'], compact('id'));
        return $this->formatResult($appMenuRoute, $appMenuRouteServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByAppRouteIdList(int $id, AppMenuRouteRepository $appMenuRouteRepository, AppMenuRouteServiceResponseList $appMenuRouteServiceResponseList, string $q = null,  int $length = 12): AppMenuRouteServiceResponseList
    {
        $appMenuRoute = app()->call([$appMenuRouteRepository, 'getByAppRouteIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($appMenuRoute, $appMenuRouteServiceResponseList);
    }

}
