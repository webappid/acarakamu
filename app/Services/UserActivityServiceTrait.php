<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\UserActivity;
use App\Repositories\Requests\UserActivityRepositoryRequest;
use App\Repositories\UserActivityRepository;
use App\Services\Requests\UserActivityServiceRequest;
use App\Services\Responses\UserActivityServiceResponse;
use App\Services\Responses\UserActivityServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 14:04:58
 * Time: 2021/11/06
 * Class UserActivityServiceTrait
 * @package App\Services
 */
trait UserActivityServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(UserActivityServiceRequest $userActivityServiceRequest, UserActivityRepositoryRequest $userActivityRepositoryRequest, UserActivityRepository $userActivityRepository, UserActivityServiceResponse $userActivityServiceResponse): UserActivityServiceResponse
    {
        $userActivityRepositoryRequest = Lazy::transform($userActivityServiceRequest, $userActivityRepositoryRequest);

        $result = app()->call([$userActivityRepository, 'store'], ['userActivityRepositoryRequest' => $userActivityRepositoryRequest]);
        if ($result != null) {
            $userActivityServiceResponse->status = true;
            $userActivityServiceResponse->message = 'Store Data Success';
            $userActivityServiceResponse->userActivity = $result;
        } else {
            $userActivityServiceResponse->status = false;
            $userActivityServiceResponse->message = 'Store Data Failed';
        }

        return $userActivityServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, UserActivityServiceRequest $userActivityServiceRequest, UserActivityRepositoryRequest $userActivityRepositoryRequest, UserActivityRepository $userActivityRepository, UserActivityServiceResponse $userActivityServiceResponse): UserActivityServiceResponse
    {
        $userActivityRepositoryRequest = Lazy::transform($userActivityServiceRequest, $userActivityRepositoryRequest);

        $result = app()->call([$userActivityRepository, 'update'], ['id' => $id, 'userActivityRepositoryRequest' => $userActivityRepositoryRequest]);
        if ($result != null) {
            $userActivityServiceResponse->status = true;
            $userActivityServiceResponse->message = 'Update Data Success';
            $userActivityServiceResponse->userActivity = $result;
        } else {
            $userActivityServiceResponse->status = false;
            $userActivityServiceResponse->message = 'Update Data Failed';
        }

        return $userActivityServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, UserActivityRepository $userActivityRepository, UserActivityServiceResponse $userActivityServiceResponse): UserActivityServiceResponse
    {
        $status = app()->call([$userActivityRepository, 'delete'], compact('id'));
        $userActivityServiceResponse->status = $status;
        if($status){
            $userActivityServiceResponse->message = "Delete Success";
        }else{
            $userActivityServiceResponse->message = "Delete Failed";
        }

        return $userActivityServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param UserActivityServiceResponseList $userActivityServiceResponseList
     * @return UserActivityServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, UserActivityServiceResponseList $userActivityServiceResponseList): UserActivityServiceResponseList{
        if (count($result) > 0) {
            $userActivityServiceResponseList->status = true;
            $userActivityServiceResponseList->message = 'Data Found';
            $userActivityServiceResponseList->userActivityList = $result;
            $userActivityServiceResponseList->count = $result->total();
            $userActivityServiceResponseList->countFiltered = $result->count();
        } else {
            $userActivityServiceResponseList->status = false;
            $userActivityServiceResponseList->message = 'Data Not Found';
        }
        return $userActivityServiceResponseList;
    }

    /**
     * @param UserActivity|null $userActivity
     * @param UserActivityServiceResponse $userActivityServiceResponse
     * @return UserActivityServiceResponse
     */
    private function formatResult(?UserActivity $userActivity, UserActivityServiceResponse $userActivityServiceResponse): UserActivityServiceResponse{
        if($userActivity == null){
            $userActivityServiceResponse->status = false;
            $userActivityServiceResponse->message = "Data Not Found";
        }else{
            $userActivityServiceResponse->status = true;
            $userActivityServiceResponse->message = "Data Found";
            $userActivityServiceResponse->userActivity = $userActivity;
        }

        return $userActivityServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(UserActivityRepository $userActivityRepository, UserActivityServiceResponseList $userActivityServiceResponseList, int $length = 12, string $q = null): UserActivityServiceResponseList
    {
        $result = app()->call([$userActivityRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $userActivityServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(UserActivityRepository $userActivityRepository, string $q = null): int
    {
        return app()->call([$userActivityRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getById(int $id, UserActivityRepository $userActivityRepository, UserActivityServiceResponse $userActivityServiceResponse): UserActivityServiceResponse
    {
        $userActivity = app()->call([$userActivityRepository, 'getById'], compact('id'));
        return $this->formatResult($userActivity, $userActivityServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, UserActivityRepository $userActivityRepository, UserActivityServiceResponseList $userActivityServiceResponseList, string $q = null,  int $length = 12): UserActivityServiceResponseList
    {
        $userActivity = app()->call([$userActivityRepository, 'getByIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($userActivity, $userActivityServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserApiToken(string $apiToken, UserActivityRepository $userActivityRepository, UserActivityServiceResponse $userActivityServiceResponse): UserActivityServiceResponse
    {
        $userActivity = app()->call([$userActivityRepository, 'getByUserApiToken'], compact('apiToken'));
        return $this->formatResult($userActivity, $userActivityServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserApiTokenList(string $apiToken, UserActivityRepository $userActivityRepository, UserActivityServiceResponseList $userActivityServiceResponseList, string $q = null,  int $length = 12): UserActivityServiceResponseList
    {
        $userActivity = app()->call([$userActivityRepository, 'getByUserApiTokenList'], compact('apiToken', 'length', 'q'));
        return $this->formatResultList($userActivity, $userActivityServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserEmail(string $email, UserActivityRepository $userActivityRepository, UserActivityServiceResponse $userActivityServiceResponse): UserActivityServiceResponse
    {
        $userActivity = app()->call([$userActivityRepository, 'getByUserEmail'], compact('email'));
        return $this->formatResult($userActivity, $userActivityServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserEmailList(string $email, UserActivityRepository $userActivityRepository, UserActivityServiceResponseList $userActivityServiceResponseList, string $q = null,  int $length = 12): UserActivityServiceResponseList
    {
        $userActivity = app()->call([$userActivityRepository, 'getByUserEmailList'], compact('email', 'length', 'q'));
        return $this->formatResultList($userActivity, $userActivityServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserId(int $id, UserActivityRepository $userActivityRepository, UserActivityServiceResponse $userActivityServiceResponse): UserActivityServiceResponse
    {
        $userActivity = app()->call([$userActivityRepository, 'getByUserId'], compact('id'));
        return $this->formatResult($userActivity, $userActivityServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserIdList(int $id, UserActivityRepository $userActivityRepository, UserActivityServiceResponseList $userActivityServiceResponseList, string $q = null,  int $length = 12): UserActivityServiceResponseList
    {
        $userActivity = app()->call([$userActivityRepository, 'getByUserIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($userActivity, $userActivityServiceResponseList);
    }

}
