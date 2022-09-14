<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Services\Requests\RolePermissionServiceRequest;
use App\Services\Responses\RolePermissionServiceResponse;
use App\Services\Responses\RolePermissionServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\User\Models\RolePermission;
use WebAppId\User\Repositories\Requests\RolePermissionRepositoryRequest;
use WebAppId\User\Repositories\RolePermissionRepository;

/**
 * @author: 
 * Date: 16:04:20
 * Time: 2022/09/14
 * Class RolePermissionServiceTrait
 * @package App\Services
 */
trait RolePermissionServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(RolePermissionServiceRequest $rolePermissionServiceRequest, RolePermissionRepositoryRequest $rolePermissionRepositoryRequest, RolePermissionRepository $rolePermissionRepository, RolePermissionServiceResponse $rolePermissionServiceResponse): RolePermissionServiceResponse
    {
        $rolePermissionRepositoryRequest = Lazy::transform($rolePermissionServiceRequest, $rolePermissionRepositoryRequest);

        $result = app()->call([$rolePermissionRepository, 'store'], ['rolePermissionRepositoryRequest' => $rolePermissionRepositoryRequest]);
        if ($result != null) {
            $rolePermissionServiceResponse->status = true;
            $rolePermissionServiceResponse->message = 'Store Data Success';
            $rolePermissionServiceResponse->rolePermission = $result;
        } else {
            $rolePermissionServiceResponse->status = false;
            $rolePermissionServiceResponse->message = 'Store Data Failed';
        }

        return $rolePermissionServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, RolePermissionServiceRequest $rolePermissionServiceRequest, RolePermissionRepositoryRequest $rolePermissionRepositoryRequest, RolePermissionRepository $rolePermissionRepository, RolePermissionServiceResponse $rolePermissionServiceResponse): RolePermissionServiceResponse
    {
        $rolePermissionRepositoryRequest = Lazy::transform($rolePermissionServiceRequest, $rolePermissionRepositoryRequest);

        $result = app()->call([$rolePermissionRepository, 'update'], ['id' => $id, 'rolePermissionRepositoryRequest' => $rolePermissionRepositoryRequest]);
        if ($result != null) {
            $rolePermissionServiceResponse->status = true;
            $rolePermissionServiceResponse->message = 'Update Data Success';
            $rolePermissionServiceResponse->rolePermission = $result;
        } else {
            $rolePermissionServiceResponse->status = false;
            $rolePermissionServiceResponse->message = 'Update Data Failed';
        }

        return $rolePermissionServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, RolePermissionRepository $rolePermissionRepository, RolePermissionServiceResponse $rolePermissionServiceResponse): RolePermissionServiceResponse
    {
        $status = app()->call([$rolePermissionRepository, 'delete'], compact('id'));
        $rolePermissionServiceResponse->status = $status;
        if($status){
            $rolePermissionServiceResponse->message = "Delete Success";
        }else{
            $rolePermissionServiceResponse->message = "Delete Failed";
        }

        return $rolePermissionServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param RolePermissionServiceResponseList $rolePermissionServiceResponseList
     * @return RolePermissionServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, RolePermissionServiceResponseList $rolePermissionServiceResponseList): RolePermissionServiceResponseList{
        if (count($result) > 0) {
            $rolePermissionServiceResponseList->status = true;
            $rolePermissionServiceResponseList->message = 'Data Found';
            $rolePermissionServiceResponseList->rolePermissionList = $result;
            $rolePermissionServiceResponseList->count = $result->total();
            $rolePermissionServiceResponseList->countFiltered = $result->count();
        } else {
            $rolePermissionServiceResponseList->status = false;
            $rolePermissionServiceResponseList->message = 'Data Not Found';
        }
        return $rolePermissionServiceResponseList;
    }

    /**
     * @param RolePermission|null $rolePermission
     * @param RolePermissionServiceResponse $rolePermissionServiceResponse
     * @return RolePermissionServiceResponse
     */
    private function formatResult(?RolePermission $rolePermission, RolePermissionServiceResponse $rolePermissionServiceResponse): RolePermissionServiceResponse{
        if($rolePermission == null){
            $rolePermissionServiceResponse->status = false;
            $rolePermissionServiceResponse->message = "Data Not Found";
        }else{
            $rolePermissionServiceResponse->status = true;
            $rolePermissionServiceResponse->message = "Data Found";
            $rolePermissionServiceResponse->rolePermission = $rolePermission;
        }

        return $rolePermissionServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(RolePermissionRepository $rolePermissionRepository, RolePermissionServiceResponseList $rolePermissionServiceResponseList, int $length = 12, string $q = null): RolePermissionServiceResponseList
    {
        $result = app()->call([$rolePermissionRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $rolePermissionServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(RolePermissionRepository $rolePermissionRepository, string $q = null): int
    {
        return app()->call([$rolePermissionRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getById(int $id, RolePermissionRepository $rolePermissionRepository, RolePermissionServiceResponse $rolePermissionServiceResponse): RolePermissionServiceResponse
    {
        $rolePermission = app()->call([$rolePermissionRepository, 'getById'], compact('id'));
        return $this->formatResult($rolePermission, $rolePermissionServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, RolePermissionRepository $rolePermissionRepository, RolePermissionServiceResponseList $rolePermissionServiceResponseList, string $q = null,  int $length = 12): RolePermissionServiceResponseList
    {
        $rolePermission = app()->call([$rolePermissionRepository, 'getByIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($rolePermission, $rolePermissionServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserEmail(string $email, RolePermissionRepository $rolePermissionRepository, RolePermissionServiceResponse $rolePermissionServiceResponse): RolePermissionServiceResponse
    {
        $rolePermission = app()->call([$rolePermissionRepository, 'getByUserEmail'], compact('email'));
        return $this->formatResult($rolePermission, $rolePermissionServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserEmailList(string $email, RolePermissionRepository $rolePermissionRepository, RolePermissionServiceResponseList $rolePermissionServiceResponseList, string $q = null,  int $length = 12): RolePermissionServiceResponseList
    {
        $rolePermission = app()->call([$rolePermissionRepository, 'getByUserEmailList'], compact('email', 'length', 'q'));
        return $this->formatResultList($rolePermission, $rolePermissionServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserId(int $id, RolePermissionRepository $rolePermissionRepository, RolePermissionServiceResponse $rolePermissionServiceResponse): RolePermissionServiceResponse
    {
        $rolePermission = app()->call([$rolePermissionRepository, 'getByUserId'], compact('id'));
        return $this->formatResult($rolePermission, $rolePermissionServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserIdList(int $id, RolePermissionRepository $rolePermissionRepository, RolePermissionServiceResponseList $rolePermissionServiceResponseList, string $q = null,  int $length = 12): RolePermissionServiceResponseList
    {
        $rolePermission = app()->call([$rolePermissionRepository, 'getByUserIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($rolePermission, $rolePermissionServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByPermissionId(int $id, RolePermissionRepository $rolePermissionRepository, RolePermissionServiceResponse $rolePermissionServiceResponse): RolePermissionServiceResponse
    {
        $rolePermission = app()->call([$rolePermissionRepository, 'getByPermissionId'], compact('id'));
        return $this->formatResult($rolePermission, $rolePermissionServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByPermissionIdList(int $id, RolePermissionRepository $rolePermissionRepository, RolePermissionServiceResponseList $rolePermissionServiceResponseList, string $q = null,  int $length = 12): RolePermissionServiceResponseList
    {
        $rolePermission = app()->call([$rolePermissionRepository, 'getByPermissionIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($rolePermission, $rolePermissionServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByRoleName(string $name, RolePermissionRepository $rolePermissionRepository, RolePermissionServiceResponse $rolePermissionServiceResponse): RolePermissionServiceResponse
    {
        $rolePermission = app()->call([$rolePermissionRepository, 'getByRoleName'], compact('name'));
        return $this->formatResult($rolePermission, $rolePermissionServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByRoleNameList(string $name, RolePermissionRepository $rolePermissionRepository, RolePermissionServiceResponseList $rolePermissionServiceResponseList, string $q = null,  int $length = 12): RolePermissionServiceResponseList
    {
        $rolePermission = app()->call([$rolePermissionRepository, 'getByRoleNameList'], compact('name', 'length', 'q'));
        return $this->formatResultList($rolePermission, $rolePermissionServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByRoleId(int $id, RolePermissionRepository $rolePermissionRepository, RolePermissionServiceResponse $rolePermissionServiceResponse): RolePermissionServiceResponse
    {
        $rolePermission = app()->call([$rolePermissionRepository, 'getByRoleId'], compact('id'));
        return $this->formatResult($rolePermission, $rolePermissionServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByRoleIdList(int $id, RolePermissionRepository $rolePermissionRepository, RolePermissionServiceResponseList $rolePermissionServiceResponseList, string $q = null,  int $length = 12): RolePermissionServiceResponseList
    {
        $rolePermission = app()->call([$rolePermissionRepository, 'getByRoleIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($rolePermission, $rolePermissionServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUpdatedByUserEmail(string $email, RolePermissionRepository $rolePermissionRepository, RolePermissionServiceResponse $rolePermissionServiceResponse): RolePermissionServiceResponse
    {
        $rolePermission = app()->call([$rolePermissionRepository, 'getByUpdatedByUserEmail'], compact('email'));
        return $this->formatResult($rolePermission, $rolePermissionServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUpdatedByUserEmailList(string $email, RolePermissionRepository $rolePermissionRepository, RolePermissionServiceResponseList $rolePermissionServiceResponseList, string $q = null,  int $length = 12): RolePermissionServiceResponseList
    {
        $rolePermission = app()->call([$rolePermissionRepository, 'getByUpdatedByUserEmailList'], compact('email', 'length', 'q'));
        return $this->formatResultList($rolePermission, $rolePermissionServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUpdatedByUserId(int $id, RolePermissionRepository $rolePermissionRepository, RolePermissionServiceResponse $rolePermissionServiceResponse): RolePermissionServiceResponse
    {
        $rolePermission = app()->call([$rolePermissionRepository, 'getByUpdatedByUserId'], compact('id'));
        return $this->formatResult($rolePermission, $rolePermissionServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUpdatedByUserIdList(int $id, RolePermissionRepository $rolePermissionRepository, RolePermissionServiceResponseList $rolePermissionServiceResponseList, string $q = null,  int $length = 12): RolePermissionServiceResponseList
    {
        $rolePermission = app()->call([$rolePermissionRepository, 'getByUpdatedByUserIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($rolePermission, $rolePermissionServiceResponseList);
    }

}
