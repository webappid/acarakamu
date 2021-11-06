<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\Permission;
use App\Repositories\PermissionRepository;
use App\Repositories\Requests\PermissionRepositoryRequest;
use App\Services\Requests\PermissionServiceRequest;
use App\Services\Responses\PermissionServiceResponse;
use App\Services\Responses\PermissionServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 14:04:25
 * Time: 2021/11/06
 * Class PermissionServiceTrait
 * @package App\Services
 */
trait PermissionServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(PermissionServiceRequest $permissionServiceRequest, PermissionRepositoryRequest $permissionRepositoryRequest, PermissionRepository $permissionRepository, PermissionServiceResponse $permissionServiceResponse): PermissionServiceResponse
    {
        $permissionRepositoryRequest = Lazy::transform($permissionServiceRequest, $permissionRepositoryRequest);

        $result = app()->call([$permissionRepository, 'store'], ['permissionRepositoryRequest' => $permissionRepositoryRequest]);
        if ($result != null) {
            $permissionServiceResponse->status = true;
            $permissionServiceResponse->message = 'Store Data Success';
            $permissionServiceResponse->permission = $result;
        } else {
            $permissionServiceResponse->status = false;
            $permissionServiceResponse->message = 'Store Data Failed';
        }

        return $permissionServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, PermissionServiceRequest $permissionServiceRequest, PermissionRepositoryRequest $permissionRepositoryRequest, PermissionRepository $permissionRepository, PermissionServiceResponse $permissionServiceResponse): PermissionServiceResponse
    {
        $permissionRepositoryRequest = Lazy::transform($permissionServiceRequest, $permissionRepositoryRequest);

        $result = app()->call([$permissionRepository, 'update'], ['id' => $id, 'permissionRepositoryRequest' => $permissionRepositoryRequest]);
        if ($result != null) {
            $permissionServiceResponse->status = true;
            $permissionServiceResponse->message = 'Update Data Success';
            $permissionServiceResponse->permission = $result;
        } else {
            $permissionServiceResponse->status = false;
            $permissionServiceResponse->message = 'Update Data Failed';
        }

        return $permissionServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, PermissionRepository $permissionRepository, PermissionServiceResponse $permissionServiceResponse): PermissionServiceResponse
    {
        $status = app()->call([$permissionRepository, 'delete'], compact('id'));
        $permissionServiceResponse->status = $status;
        if($status){
            $permissionServiceResponse->message = "Delete Success";
        }else{
            $permissionServiceResponse->message = "Delete Failed";
        }

        return $permissionServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param PermissionServiceResponseList $permissionServiceResponseList
     * @return PermissionServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, PermissionServiceResponseList $permissionServiceResponseList): PermissionServiceResponseList{
        if (count($result) > 0) {
            $permissionServiceResponseList->status = true;
            $permissionServiceResponseList->message = 'Data Found';
            $permissionServiceResponseList->permissionList = $result;
            $permissionServiceResponseList->count = $result->total();
            $permissionServiceResponseList->countFiltered = $result->count();
        } else {
            $permissionServiceResponseList->status = false;
            $permissionServiceResponseList->message = 'Data Not Found';
        }
        return $permissionServiceResponseList;
    }

    /**
     * @param Permission|null $permission
     * @param PermissionServiceResponse $permissionServiceResponse
     * @return PermissionServiceResponse
     */
    private function formatResult(?Permission $permission, PermissionServiceResponse $permissionServiceResponse): PermissionServiceResponse{
        if($permission == null){
            $permissionServiceResponse->status = false;
            $permissionServiceResponse->message = "Data Not Found";
        }else{
            $permissionServiceResponse->status = true;
            $permissionServiceResponse->message = "Data Found";
            $permissionServiceResponse->permission = $permission;
        }

        return $permissionServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(PermissionRepository $permissionRepository, PermissionServiceResponseList $permissionServiceResponseList, int $length = 12, string $q = null): PermissionServiceResponseList
    {
        $result = app()->call([$permissionRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $permissionServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(PermissionRepository $permissionRepository, string $q = null): int
    {
        return app()->call([$permissionRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getById(int $id, PermissionRepository $permissionRepository, PermissionServiceResponse $permissionServiceResponse): PermissionServiceResponse
    {
        $permission = app()->call([$permissionRepository, 'getById'], compact('id'));
        return $this->formatResult($permission, $permissionServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, PermissionRepository $permissionRepository, PermissionServiceResponseList $permissionServiceResponseList, string $q = null,  int $length = 12): PermissionServiceResponseList
    {
        $permission = app()->call([$permissionRepository, 'getByIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($permission, $permissionServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserApiToken(string $apiToken, PermissionRepository $permissionRepository, PermissionServiceResponse $permissionServiceResponse): PermissionServiceResponse
    {
        $permission = app()->call([$permissionRepository, 'getByUserApiToken'], compact('apiToken'));
        return $this->formatResult($permission, $permissionServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserApiTokenList(string $apiToken, PermissionRepository $permissionRepository, PermissionServiceResponseList $permissionServiceResponseList, string $q = null,  int $length = 12): PermissionServiceResponseList
    {
        $permission = app()->call([$permissionRepository, 'getByUserApiTokenList'], compact('apiToken', 'length', 'q'));
        return $this->formatResultList($permission, $permissionServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserEmail(string $email, PermissionRepository $permissionRepository, PermissionServiceResponse $permissionServiceResponse): PermissionServiceResponse
    {
        $permission = app()->call([$permissionRepository, 'getByUserEmail'], compact('email'));
        return $this->formatResult($permission, $permissionServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserEmailList(string $email, PermissionRepository $permissionRepository, PermissionServiceResponseList $permissionServiceResponseList, string $q = null,  int $length = 12): PermissionServiceResponseList
    {
        $permission = app()->call([$permissionRepository, 'getByUserEmailList'], compact('email', 'length', 'q'));
        return $this->formatResultList($permission, $permissionServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserId(int $id, PermissionRepository $permissionRepository, PermissionServiceResponse $permissionServiceResponse): PermissionServiceResponse
    {
        $permission = app()->call([$permissionRepository, 'getByUserId'], compact('id'));
        return $this->formatResult($permission, $permissionServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserIdList(int $id, PermissionRepository $permissionRepository, PermissionServiceResponseList $permissionServiceResponseList, string $q = null,  int $length = 12): PermissionServiceResponseList
    {
        $permission = app()->call([$permissionRepository, 'getByUserIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($permission, $permissionServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUpdatedByUserApiToken(string $apiToken, PermissionRepository $permissionRepository, PermissionServiceResponse $permissionServiceResponse): PermissionServiceResponse
    {
        $permission = app()->call([$permissionRepository, 'getByUpdatedByUserApiToken'], compact('apiToken'));
        return $this->formatResult($permission, $permissionServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUpdatedByUserApiTokenList(string $apiToken, PermissionRepository $permissionRepository, PermissionServiceResponseList $permissionServiceResponseList, string $q = null,  int $length = 12): PermissionServiceResponseList
    {
        $permission = app()->call([$permissionRepository, 'getByUpdatedByUserApiTokenList'], compact('apiToken', 'length', 'q'));
        return $this->formatResultList($permission, $permissionServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUpdatedByUserEmail(string $email, PermissionRepository $permissionRepository, PermissionServiceResponse $permissionServiceResponse): PermissionServiceResponse
    {
        $permission = app()->call([$permissionRepository, 'getByUpdatedByUserEmail'], compact('email'));
        return $this->formatResult($permission, $permissionServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUpdatedByUserEmailList(string $email, PermissionRepository $permissionRepository, PermissionServiceResponseList $permissionServiceResponseList, string $q = null,  int $length = 12): PermissionServiceResponseList
    {
        $permission = app()->call([$permissionRepository, 'getByUpdatedByUserEmailList'], compact('email', 'length', 'q'));
        return $this->formatResultList($permission, $permissionServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUpdatedByUserId(int $id, PermissionRepository $permissionRepository, PermissionServiceResponse $permissionServiceResponse): PermissionServiceResponse
    {
        $permission = app()->call([$permissionRepository, 'getByUpdatedByUserId'], compact('id'));
        return $this->formatResult($permission, $permissionServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUpdatedByUserIdList(int $id, PermissionRepository $permissionRepository, PermissionServiceResponseList $permissionServiceResponseList, string $q = null,  int $length = 12): PermissionServiceResponseList
    {
        $permission = app()->call([$permissionRepository, 'getByUpdatedByUserIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($permission, $permissionServiceResponseList);
    }

}
