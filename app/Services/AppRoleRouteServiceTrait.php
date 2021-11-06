<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\AppRoleRoute;
use App\Repositories\AppRoleRouteRepository;
use App\Repositories\Requests\AppRoleRouteRepositoryRequest;
use App\Services\Requests\AppRoleRouteServiceRequest;
use App\Services\Responses\AppRoleRouteServiceResponse;
use App\Services\Responses\AppRoleRouteServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 14:04:01
 * Time: 2021/11/06
 * Class AppRoleRouteServiceTrait
 * @package App\Services
 */
trait AppRoleRouteServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(AppRoleRouteServiceRequest $appRoleRouteServiceRequest, AppRoleRouteRepositoryRequest $appRoleRouteRepositoryRequest, AppRoleRouteRepository $appRoleRouteRepository, AppRoleRouteServiceResponse $appRoleRouteServiceResponse): AppRoleRouteServiceResponse
    {
        $appRoleRouteRepositoryRequest = Lazy::transform($appRoleRouteServiceRequest, $appRoleRouteRepositoryRequest);

        $result = app()->call([$appRoleRouteRepository, 'store'], ['appRoleRouteRepositoryRequest' => $appRoleRouteRepositoryRequest]);
        if ($result != null) {
            $appRoleRouteServiceResponse->status = true;
            $appRoleRouteServiceResponse->message = 'Store Data Success';
            $appRoleRouteServiceResponse->appRoleRoute = $result;
        } else {
            $appRoleRouteServiceResponse->status = false;
            $appRoleRouteServiceResponse->message = 'Store Data Failed';
        }

        return $appRoleRouteServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, AppRoleRouteServiceRequest $appRoleRouteServiceRequest, AppRoleRouteRepositoryRequest $appRoleRouteRepositoryRequest, AppRoleRouteRepository $appRoleRouteRepository, AppRoleRouteServiceResponse $appRoleRouteServiceResponse): AppRoleRouteServiceResponse
    {
        $appRoleRouteRepositoryRequest = Lazy::transform($appRoleRouteServiceRequest, $appRoleRouteRepositoryRequest);

        $result = app()->call([$appRoleRouteRepository, 'update'], ['id' => $id, 'appRoleRouteRepositoryRequest' => $appRoleRouteRepositoryRequest]);
        if ($result != null) {
            $appRoleRouteServiceResponse->status = true;
            $appRoleRouteServiceResponse->message = 'Update Data Success';
            $appRoleRouteServiceResponse->appRoleRoute = $result;
        } else {
            $appRoleRouteServiceResponse->status = false;
            $appRoleRouteServiceResponse->message = 'Update Data Failed';
        }

        return $appRoleRouteServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, AppRoleRouteRepository $appRoleRouteRepository, AppRoleRouteServiceResponse $appRoleRouteServiceResponse): AppRoleRouteServiceResponse
    {
        $status = app()->call([$appRoleRouteRepository, 'delete'], compact('id'));
        $appRoleRouteServiceResponse->status = $status;
        if($status){
            $appRoleRouteServiceResponse->message = "Delete Success";
        }else{
            $appRoleRouteServiceResponse->message = "Delete Failed";
        }

        return $appRoleRouteServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param AppRoleRouteServiceResponseList $appRoleRouteServiceResponseList
     * @return AppRoleRouteServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, AppRoleRouteServiceResponseList $appRoleRouteServiceResponseList): AppRoleRouteServiceResponseList{
        if (count($result) > 0) {
            $appRoleRouteServiceResponseList->status = true;
            $appRoleRouteServiceResponseList->message = 'Data Found';
            $appRoleRouteServiceResponseList->appRoleRouteList = $result;
            $appRoleRouteServiceResponseList->count = $result->total();
            $appRoleRouteServiceResponseList->countFiltered = $result->count();
        } else {
            $appRoleRouteServiceResponseList->status = false;
            $appRoleRouteServiceResponseList->message = 'Data Not Found';
        }
        return $appRoleRouteServiceResponseList;
    }

    /**
     * @param AppRoleRoute|null $appRoleRoute
     * @param AppRoleRouteServiceResponse $appRoleRouteServiceResponse
     * @return AppRoleRouteServiceResponse
     */
    private function formatResult(?AppRoleRoute $appRoleRoute, AppRoleRouteServiceResponse $appRoleRouteServiceResponse): AppRoleRouteServiceResponse{
        if($appRoleRoute == null){
            $appRoleRouteServiceResponse->status = false;
            $appRoleRouteServiceResponse->message = "Data Not Found";
        }else{
            $appRoleRouteServiceResponse->status = true;
            $appRoleRouteServiceResponse->message = "Data Found";
            $appRoleRouteServiceResponse->appRoleRoute = $appRoleRoute;
        }

        return $appRoleRouteServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(AppRoleRouteRepository $appRoleRouteRepository, AppRoleRouteServiceResponseList $appRoleRouteServiceResponseList, int $length = 12, string $q = null): AppRoleRouteServiceResponseList
    {
        $result = app()->call([$appRoleRouteRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $appRoleRouteServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(AppRoleRouteRepository $appRoleRouteRepository, string $q = null): int
    {
        return app()->call([$appRoleRouteRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByRouteIdRoleId(int $routeId, int $roleId, AppRoleRouteRepository $appRoleRouteRepository, AppRoleRouteServiceResponse $appRoleRouteServiceResponse): AppRoleRouteServiceResponse
    {
        $appRoleRoute = app()->call([$appRoleRouteRepository, 'getByRouteIdRoleId'], compact('routeId', 'roleId'));
        return $this->formatResult($appRoleRoute, $appRoleRouteServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByRouteIdRoleIdList(int $routeId, int $roleId, AppRoleRouteRepository $appRoleRouteRepository, AppRoleRouteServiceResponseList $appRoleRouteServiceResponseList, string $q = null,  int $length = 12): AppRoleRouteServiceResponseList
    {
        $appRoleRoute = app()->call([$appRoleRouteRepository, 'getByRouteIdRoleIdList'], compact('routeId', 'roleId', 'length', 'q'));
        return $this->formatResultList($appRoleRoute, $appRoleRouteServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id, AppRoleRouteRepository $appRoleRouteRepository, AppRoleRouteServiceResponse $appRoleRouteServiceResponse): AppRoleRouteServiceResponse
    {
        $appRoleRoute = app()->call([$appRoleRouteRepository, 'getById'], compact('id'));
        return $this->formatResult($appRoleRoute, $appRoleRouteServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, AppRoleRouteRepository $appRoleRouteRepository, AppRoleRouteServiceResponseList $appRoleRouteServiceResponseList, string $q = null,  int $length = 12): AppRoleRouteServiceResponseList
    {
        $appRoleRoute = app()->call([$appRoleRouteRepository, 'getByIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($appRoleRoute, $appRoleRouteServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByRoleName(string $name, AppRoleRouteRepository $appRoleRouteRepository, AppRoleRouteServiceResponse $appRoleRouteServiceResponse): AppRoleRouteServiceResponse
    {
        $appRoleRoute = app()->call([$appRoleRouteRepository, 'getByRoleName'], compact('name'));
        return $this->formatResult($appRoleRoute, $appRoleRouteServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByRoleNameList(string $name, AppRoleRouteRepository $appRoleRouteRepository, AppRoleRouteServiceResponseList $appRoleRouteServiceResponseList, string $q = null,  int $length = 12): AppRoleRouteServiceResponseList
    {
        $appRoleRoute = app()->call([$appRoleRouteRepository, 'getByRoleNameList'], compact('name', 'length', 'q'));
        return $this->formatResultList($appRoleRoute, $appRoleRouteServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByRoleId(int $id, AppRoleRouteRepository $appRoleRouteRepository, AppRoleRouteServiceResponse $appRoleRouteServiceResponse): AppRoleRouteServiceResponse
    {
        $appRoleRoute = app()->call([$appRoleRouteRepository, 'getByRoleId'], compact('id'));
        return $this->formatResult($appRoleRoute, $appRoleRouteServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByRoleIdList(int $id, AppRoleRouteRepository $appRoleRouteRepository, AppRoleRouteServiceResponseList $appRoleRouteServiceResponseList, string $q = null,  int $length = 12): AppRoleRouteServiceResponseList
    {
        $appRoleRoute = app()->call([$appRoleRouteRepository, 'getByRoleIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($appRoleRoute, $appRoleRouteServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByAppRouteName(string $name, AppRoleRouteRepository $appRoleRouteRepository, AppRoleRouteServiceResponse $appRoleRouteServiceResponse): AppRoleRouteServiceResponse
    {
        $appRoleRoute = app()->call([$appRoleRouteRepository, 'getByAppRouteName'], compact('name'));
        return $this->formatResult($appRoleRoute, $appRoleRouteServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByAppRouteNameList(string $name, AppRoleRouteRepository $appRoleRouteRepository, AppRoleRouteServiceResponseList $appRoleRouteServiceResponseList, string $q = null,  int $length = 12): AppRoleRouteServiceResponseList
    {
        $appRoleRoute = app()->call([$appRoleRouteRepository, 'getByAppRouteNameList'], compact('name', 'length', 'q'));
        return $this->formatResultList($appRoleRoute, $appRoleRouteServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByAppRouteId(int $id, AppRoleRouteRepository $appRoleRouteRepository, AppRoleRouteServiceResponse $appRoleRouteServiceResponse): AppRoleRouteServiceResponse
    {
        $appRoleRoute = app()->call([$appRoleRouteRepository, 'getByAppRouteId'], compact('id'));
        return $this->formatResult($appRoleRoute, $appRoleRouteServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByAppRouteIdList(int $id, AppRoleRouteRepository $appRoleRouteRepository, AppRoleRouteServiceResponseList $appRoleRouteServiceResponseList, string $q = null,  int $length = 12): AppRoleRouteServiceResponseList
    {
        $appRoleRoute = app()->call([$appRoleRouteRepository, 'getByAppRouteIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($appRoleRoute, $appRoleRouteServiceResponseList);
    }

}
