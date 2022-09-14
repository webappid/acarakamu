<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\RoleRoute;
use App\Repositories\Requests\RoleRouteRepositoryRequest;
use App\Repositories\RoleRouteRepository;
use App\Services\Requests\RoleRouteServiceRequest;
use App\Services\Responses\RoleRouteServiceResponse;
use App\Services\Responses\RoleRouteServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:21
 * Time: 2022/09/14
 * Class RoleRouteServiceTrait
 * @package App\Services
 */
trait RoleRouteServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(RoleRouteServiceRequest $roleRouteServiceRequest, RoleRouteRepositoryRequest $roleRouteRepositoryRequest, RoleRouteRepository $roleRouteRepository, RoleRouteServiceResponse $roleRouteServiceResponse): RoleRouteServiceResponse
    {
        $roleRouteRepositoryRequest = Lazy::transform($roleRouteServiceRequest, $roleRouteRepositoryRequest);

        $result = app()->call([$roleRouteRepository, 'store'], ['roleRouteRepositoryRequest' => $roleRouteRepositoryRequest]);
        if ($result != null) {
            $roleRouteServiceResponse->status = true;
            $roleRouteServiceResponse->message = 'Store Data Success';
            $roleRouteServiceResponse->roleRoute = $result;
        } else {
            $roleRouteServiceResponse->status = false;
            $roleRouteServiceResponse->message = 'Store Data Failed';
        }

        return $roleRouteServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, RoleRouteServiceRequest $roleRouteServiceRequest, RoleRouteRepositoryRequest $roleRouteRepositoryRequest, RoleRouteRepository $roleRouteRepository, RoleRouteServiceResponse $roleRouteServiceResponse): RoleRouteServiceResponse
    {
        $roleRouteRepositoryRequest = Lazy::transform($roleRouteServiceRequest, $roleRouteRepositoryRequest);

        $result = app()->call([$roleRouteRepository, 'update'], ['id' => $id, 'roleRouteRepositoryRequest' => $roleRouteRepositoryRequest]);
        if ($result != null) {
            $roleRouteServiceResponse->status = true;
            $roleRouteServiceResponse->message = 'Update Data Success';
            $roleRouteServiceResponse->roleRoute = $result;
        } else {
            $roleRouteServiceResponse->status = false;
            $roleRouteServiceResponse->message = 'Update Data Failed';
        }

        return $roleRouteServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, RoleRouteRepository $roleRouteRepository, RoleRouteServiceResponse $roleRouteServiceResponse): RoleRouteServiceResponse
    {
        $status = app()->call([$roleRouteRepository, 'delete'], compact('id'));
        $roleRouteServiceResponse->status = $status;
        if($status){
            $roleRouteServiceResponse->message = "Delete Success";
        }else{
            $roleRouteServiceResponse->message = "Delete Failed";
        }

        return $roleRouteServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param RoleRouteServiceResponseList $roleRouteServiceResponseList
     * @return RoleRouteServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, RoleRouteServiceResponseList $roleRouteServiceResponseList): RoleRouteServiceResponseList{
        if (count($result) > 0) {
            $roleRouteServiceResponseList->status = true;
            $roleRouteServiceResponseList->message = 'Data Found';
            $roleRouteServiceResponseList->roleRouteList = $result;
            $roleRouteServiceResponseList->count = $result->total();
            $roleRouteServiceResponseList->countFiltered = $result->count();
        } else {
            $roleRouteServiceResponseList->status = false;
            $roleRouteServiceResponseList->message = 'Data Not Found';
        }
        return $roleRouteServiceResponseList;
    }

    /**
     * @param RoleRoute|null $roleRoute
     * @param RoleRouteServiceResponse $roleRouteServiceResponse
     * @return RoleRouteServiceResponse
     */
    private function formatResult(?RoleRoute $roleRoute, RoleRouteServiceResponse $roleRouteServiceResponse): RoleRouteServiceResponse{
        if($roleRoute == null){
            $roleRouteServiceResponse->status = false;
            $roleRouteServiceResponse->message = "Data Not Found";
        }else{
            $roleRouteServiceResponse->status = true;
            $roleRouteServiceResponse->message = "Data Found";
            $roleRouteServiceResponse->roleRoute = $roleRoute;
        }

        return $roleRouteServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(RoleRouteRepository $roleRouteRepository, RoleRouteServiceResponseList $roleRouteServiceResponseList, int $length = 12, string $q = null): RoleRouteServiceResponseList
    {
        $result = app()->call([$roleRouteRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $roleRouteServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(RoleRouteRepository $roleRouteRepository, string $q = null): int
    {
        return app()->call([$roleRouteRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getById(int $id, RoleRouteRepository $roleRouteRepository, RoleRouteServiceResponse $roleRouteServiceResponse): RoleRouteServiceResponse
    {
        $roleRoute = app()->call([$roleRouteRepository, 'getById'], compact('id'));
        return $this->formatResult($roleRoute, $roleRouteServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, RoleRouteRepository $roleRouteRepository, RoleRouteServiceResponseList $roleRouteServiceResponseList, string $q = null,  int $length = 12): RoleRouteServiceResponseList
    {
        $roleRoute = app()->call([$roleRouteRepository, 'getByIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($roleRoute, $roleRouteServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByRoleName(string $name, RoleRouteRepository $roleRouteRepository, RoleRouteServiceResponse $roleRouteServiceResponse): RoleRouteServiceResponse
    {
        $roleRoute = app()->call([$roleRouteRepository, 'getByRoleName'], compact('name'));
        return $this->formatResult($roleRoute, $roleRouteServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByRoleNameList(string $name, RoleRouteRepository $roleRouteRepository, RoleRouteServiceResponseList $roleRouteServiceResponseList, string $q = null,  int $length = 12): RoleRouteServiceResponseList
    {
        $roleRoute = app()->call([$roleRouteRepository, 'getByRoleNameList'], compact('name', 'length', 'q'));
        return $this->formatResultList($roleRoute, $roleRouteServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByRoleId(int $id, RoleRouteRepository $roleRouteRepository, RoleRouteServiceResponse $roleRouteServiceResponse): RoleRouteServiceResponse
    {
        $roleRoute = app()->call([$roleRouteRepository, 'getByRoleId'], compact('id'));
        return $this->formatResult($roleRoute, $roleRouteServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByRoleIdList(int $id, RoleRouteRepository $roleRouteRepository, RoleRouteServiceResponseList $roleRouteServiceResponseList, string $q = null,  int $length = 12): RoleRouteServiceResponseList
    {
        $roleRoute = app()->call([$roleRouteRepository, 'getByRoleIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($roleRoute, $roleRouteServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByRouteName(string $name, RoleRouteRepository $roleRouteRepository, RoleRouteServiceResponse $roleRouteServiceResponse): RoleRouteServiceResponse
    {
        $roleRoute = app()->call([$roleRouteRepository, 'getByRouteName'], compact('name'));
        return $this->formatResult($roleRoute, $roleRouteServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByRouteNameList(string $name, RoleRouteRepository $roleRouteRepository, RoleRouteServiceResponseList $roleRouteServiceResponseList, string $q = null,  int $length = 12): RoleRouteServiceResponseList
    {
        $roleRoute = app()->call([$roleRouteRepository, 'getByRouteNameList'], compact('name', 'length', 'q'));
        return $this->formatResultList($roleRoute, $roleRouteServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByRouteId(int $id, RoleRouteRepository $roleRouteRepository, RoleRouteServiceResponse $roleRouteServiceResponse): RoleRouteServiceResponse
    {
        $roleRoute = app()->call([$roleRouteRepository, 'getByRouteId'], compact('id'));
        return $this->formatResult($roleRoute, $roleRouteServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByRouteIdList(int $id, RoleRouteRepository $roleRouteRepository, RoleRouteServiceResponseList $roleRouteServiceResponseList, string $q = null,  int $length = 12): RoleRouteServiceResponseList
    {
        $roleRoute = app()->call([$roleRouteRepository, 'getByRouteIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($roleRoute, $roleRouteServiceResponseList);
    }

}
