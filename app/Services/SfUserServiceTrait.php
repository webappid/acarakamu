<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\SfUser;
use App\Repositories\Requests\SfUserRepositoryRequest;
use App\Repositories\SfUserRepository;
use App\Services\Requests\SfUserServiceRequest;
use App\Services\Responses\SfUserServiceResponse;
use App\Services\Responses\SfUserServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:41
 * Time: 2022/09/14
 * Class SfUserServiceTrait
 * @package App\Services
 */
trait SfUserServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(SfUserServiceRequest $sfUserServiceRequest, SfUserRepositoryRequest $sfUserRepositoryRequest, SfUserRepository $sfUserRepository, SfUserServiceResponse $sfUserServiceResponse): SfUserServiceResponse
    {
        $sfUserRepositoryRequest = Lazy::transform($sfUserServiceRequest, $sfUserRepositoryRequest);

        $result = app()->call([$sfUserRepository, 'store'], ['sfUserRepositoryRequest' => $sfUserRepositoryRequest]);
        if ($result != null) {
            $sfUserServiceResponse->status = true;
            $sfUserServiceResponse->message = 'Store Data Success';
            $sfUserServiceResponse->sfUser = $result;
        } else {
            $sfUserServiceResponse->status = false;
            $sfUserServiceResponse->message = 'Store Data Failed';
        }

        return $sfUserServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(string $userName, SfUserServiceRequest $sfUserServiceRequest, SfUserRepositoryRequest $sfUserRepositoryRequest, SfUserRepository $sfUserRepository, SfUserServiceResponse $sfUserServiceResponse): SfUserServiceResponse
    {
        $sfUserRepositoryRequest = Lazy::transform($sfUserServiceRequest, $sfUserRepositoryRequest);

        $result = app()->call([$sfUserRepository, 'update'], ['userName' => $userName, 'sfUserRepositoryRequest' => $sfUserRepositoryRequest]);
        if ($result != null) {
            $sfUserServiceResponse->status = true;
            $sfUserServiceResponse->message = 'Update Data Success';
            $sfUserServiceResponse->sfUser = $result;
        } else {
            $sfUserServiceResponse->status = false;
            $sfUserServiceResponse->message = 'Update Data Failed';
        }

        return $sfUserServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $userName, SfUserRepository $sfUserRepository, SfUserServiceResponse $sfUserServiceResponse): SfUserServiceResponse
    {
        $status = app()->call([$sfUserRepository, 'delete'], compact('userName'));
        $sfUserServiceResponse->status = $status;
        if($status){
            $sfUserServiceResponse->message = "Delete Success";
        }else{
            $sfUserServiceResponse->message = "Delete Failed";
        }

        return $sfUserServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param SfUserServiceResponseList $sfUserServiceResponseList
     * @return SfUserServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, SfUserServiceResponseList $sfUserServiceResponseList): SfUserServiceResponseList{
        if (count($result) > 0) {
            $sfUserServiceResponseList->status = true;
            $sfUserServiceResponseList->message = 'Data Found';
            $sfUserServiceResponseList->sfUserList = $result;
            $sfUserServiceResponseList->count = $result->total();
            $sfUserServiceResponseList->countFiltered = $result->count();
        } else {
            $sfUserServiceResponseList->status = false;
            $sfUserServiceResponseList->message = 'Data Not Found';
        }
        return $sfUserServiceResponseList;
    }

    /**
     * @param SfUser|null $sfUser
     * @param SfUserServiceResponse $sfUserServiceResponse
     * @return SfUserServiceResponse
     */
    private function formatResult(?SfUser $sfUser, SfUserServiceResponse $sfUserServiceResponse): SfUserServiceResponse{
        if($sfUser == null){
            $sfUserServiceResponse->status = false;
            $sfUserServiceResponse->message = "Data Not Found";
        }else{
            $sfUserServiceResponse->status = true;
            $sfUserServiceResponse->message = "Data Found";
            $sfUserServiceResponse->sfUser = $sfUser;
        }

        return $sfUserServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(SfUserRepository $sfUserRepository, SfUserServiceResponseList $sfUserServiceResponseList, int $length = 12, string $q = null): SfUserServiceResponseList
    {
        $result = app()->call([$sfUserRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $sfUserServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(SfUserRepository $sfUserRepository, string $q = null): int
    {
        return app()->call([$sfUserRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByUserName(string $userName, SfUserRepository $sfUserRepository, SfUserServiceResponse $sfUserServiceResponse): SfUserServiceResponse
    {
        $sfUser = app()->call([$sfUserRepository, 'getByUserName'], compact('userName'));
        return $this->formatResult($sfUser, $sfUserServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserNameList(string $userName, SfUserRepository $sfUserRepository, SfUserServiceResponseList $sfUserServiceResponseList, string $q = null,  int $length = 12): SfUserServiceResponseList
    {
        $sfUser = app()->call([$sfUserRepository, 'getByUserNameList'], compact('userName', 'length', 'q'));
        return $this->formatResultList($sfUser, $sfUserServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserId(int $userId, SfUserRepository $sfUserRepository, SfUserServiceResponse $sfUserServiceResponse): SfUserServiceResponse
    {
        $sfUser = app()->call([$sfUserRepository, 'getByUserId'], compact('userId'));
        return $this->formatResult($sfUser, $sfUserServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserIdList(int $userId, SfUserRepository $sfUserRepository, SfUserServiceResponseList $sfUserServiceResponseList, string $q = null,  int $length = 12): SfUserServiceResponseList
    {
        $sfUser = app()->call([$sfUserRepository, 'getByUserIdList'], compact('userId', 'length', 'q'));
        return $this->formatResultList($sfUser, $sfUserServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfGroupGroupId(int $groupId, SfUserRepository $sfUserRepository, SfUserServiceResponse $sfUserServiceResponse): SfUserServiceResponse
    {
        $sfUser = app()->call([$sfUserRepository, 'getBySfGroupGroupId'], compact('groupId'));
        return $this->formatResult($sfUser, $sfUserServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfGroupGroupIdList(int $groupId, SfUserRepository $sfUserRepository, SfUserServiceResponseList $sfUserServiceResponseList, string $q = null,  int $length = 12): SfUserServiceResponseList
    {
        $sfUser = app()->call([$sfUserRepository, 'getBySfGroupGroupIdList'], compact('groupId', 'length', 'q'));
        return $this->formatResultList($sfUser, $sfUserServiceResponseList);
    }

}
