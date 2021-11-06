<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\AppSetting;
use App\Repositories\AppSettingRepository;
use App\Repositories\Requests\AppSettingRepositoryRequest;
use App\Services\Requests\AppSettingServiceRequest;
use App\Services\Responses\AppSettingServiceResponse;
use App\Services\Responses\AppSettingServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 14:04:03
 * Time: 2021/11/06
 * Class AppSettingServiceTrait
 * @package App\Services
 */
trait AppSettingServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(AppSettingServiceRequest $appSettingServiceRequest, AppSettingRepositoryRequest $appSettingRepositoryRequest, AppSettingRepository $appSettingRepository, AppSettingServiceResponse $appSettingServiceResponse): AppSettingServiceResponse
    {
        $appSettingRepositoryRequest = Lazy::transform($appSettingServiceRequest, $appSettingRepositoryRequest);

        $result = app()->call([$appSettingRepository, 'store'], ['appSettingRepositoryRequest' => $appSettingRepositoryRequest]);
        if ($result != null) {
            $appSettingServiceResponse->status = true;
            $appSettingServiceResponse->message = 'Store Data Success';
            $appSettingServiceResponse->appSetting = $result;
        } else {
            $appSettingServiceResponse->status = false;
            $appSettingServiceResponse->message = 'Store Data Failed';
        }

        return $appSettingServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, AppSettingServiceRequest $appSettingServiceRequest, AppSettingRepositoryRequest $appSettingRepositoryRequest, AppSettingRepository $appSettingRepository, AppSettingServiceResponse $appSettingServiceResponse): AppSettingServiceResponse
    {
        $appSettingRepositoryRequest = Lazy::transform($appSettingServiceRequest, $appSettingRepositoryRequest);

        $result = app()->call([$appSettingRepository, 'update'], ['id' => $id, 'appSettingRepositoryRequest' => $appSettingRepositoryRequest]);
        if ($result != null) {
            $appSettingServiceResponse->status = true;
            $appSettingServiceResponse->message = 'Update Data Success';
            $appSettingServiceResponse->appSetting = $result;
        } else {
            $appSettingServiceResponse->status = false;
            $appSettingServiceResponse->message = 'Update Data Failed';
        }

        return $appSettingServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, AppSettingRepository $appSettingRepository, AppSettingServiceResponse $appSettingServiceResponse): AppSettingServiceResponse
    {
        $status = app()->call([$appSettingRepository, 'delete'], compact('id'));
        $appSettingServiceResponse->status = $status;
        if($status){
            $appSettingServiceResponse->message = "Delete Success";
        }else{
            $appSettingServiceResponse->message = "Delete Failed";
        }

        return $appSettingServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param AppSettingServiceResponseList $appSettingServiceResponseList
     * @return AppSettingServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, AppSettingServiceResponseList $appSettingServiceResponseList): AppSettingServiceResponseList{
        if (count($result) > 0) {
            $appSettingServiceResponseList->status = true;
            $appSettingServiceResponseList->message = 'Data Found';
            $appSettingServiceResponseList->appSettingList = $result;
            $appSettingServiceResponseList->count = $result->total();
            $appSettingServiceResponseList->countFiltered = $result->count();
        } else {
            $appSettingServiceResponseList->status = false;
            $appSettingServiceResponseList->message = 'Data Not Found';
        }
        return $appSettingServiceResponseList;
    }

    /**
     * @param AppSetting|null $appSetting
     * @param AppSettingServiceResponse $appSettingServiceResponse
     * @return AppSettingServiceResponse
     */
    private function formatResult(?AppSetting $appSetting, AppSettingServiceResponse $appSettingServiceResponse): AppSettingServiceResponse{
        if($appSetting == null){
            $appSettingServiceResponse->status = false;
            $appSettingServiceResponse->message = "Data Not Found";
        }else{
            $appSettingServiceResponse->status = true;
            $appSettingServiceResponse->message = "Data Found";
            $appSettingServiceResponse->appSetting = $appSetting;
        }

        return $appSettingServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(AppSettingRepository $appSettingRepository, AppSettingServiceResponseList $appSettingServiceResponseList, int $length = 12, string $q = null): AppSettingServiceResponseList
    {
        $result = app()->call([$appSettingRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $appSettingServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(AppSettingRepository $appSettingRepository, string $q = null): int
    {
        return app()->call([$appSettingRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getById(int $id, AppSettingRepository $appSettingRepository, AppSettingServiceResponse $appSettingServiceResponse): AppSettingServiceResponse
    {
        $appSetting = app()->call([$appSettingRepository, 'getById'], compact('id'));
        return $this->formatResult($appSetting, $appSettingServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, AppSettingRepository $appSettingRepository, AppSettingServiceResponseList $appSettingServiceResponseList, string $q = null,  int $length = 12): AppSettingServiceResponseList
    {
        $appSetting = app()->call([$appSettingRepository, 'getByIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($appSetting, $appSettingServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserApiToken(string $apiToken, AppSettingRepository $appSettingRepository, AppSettingServiceResponse $appSettingServiceResponse): AppSettingServiceResponse
    {
        $appSetting = app()->call([$appSettingRepository, 'getByUserApiToken'], compact('apiToken'));
        return $this->formatResult($appSetting, $appSettingServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserApiTokenList(string $apiToken, AppSettingRepository $appSettingRepository, AppSettingServiceResponseList $appSettingServiceResponseList, string $q = null,  int $length = 12): AppSettingServiceResponseList
    {
        $appSetting = app()->call([$appSettingRepository, 'getByUserApiTokenList'], compact('apiToken', 'length', 'q'));
        return $this->formatResultList($appSetting, $appSettingServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserEmail(string $email, AppSettingRepository $appSettingRepository, AppSettingServiceResponse $appSettingServiceResponse): AppSettingServiceResponse
    {
        $appSetting = app()->call([$appSettingRepository, 'getByUserEmail'], compact('email'));
        return $this->formatResult($appSetting, $appSettingServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserEmailList(string $email, AppSettingRepository $appSettingRepository, AppSettingServiceResponseList $appSettingServiceResponseList, string $q = null,  int $length = 12): AppSettingServiceResponseList
    {
        $appSetting = app()->call([$appSettingRepository, 'getByUserEmailList'], compact('email', 'length', 'q'));
        return $this->formatResultList($appSetting, $appSettingServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserId(int $id, AppSettingRepository $appSettingRepository, AppSettingServiceResponse $appSettingServiceResponse): AppSettingServiceResponse
    {
        $appSetting = app()->call([$appSettingRepository, 'getByUserId'], compact('id'));
        return $this->formatResult($appSetting, $appSettingServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserIdList(int $id, AppSettingRepository $appSettingRepository, AppSettingServiceResponseList $appSettingServiceResponseList, string $q = null,  int $length = 12): AppSettingServiceResponseList
    {
        $appSetting = app()->call([$appSettingRepository, 'getByUserIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($appSetting, $appSettingServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByOwnerUserApiToken(string $apiToken, AppSettingRepository $appSettingRepository, AppSettingServiceResponse $appSettingServiceResponse): AppSettingServiceResponse
    {
        $appSetting = app()->call([$appSettingRepository, 'getByOwnerUserApiToken'], compact('apiToken'));
        return $this->formatResult($appSetting, $appSettingServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByOwnerUserApiTokenList(string $apiToken, AppSettingRepository $appSettingRepository, AppSettingServiceResponseList $appSettingServiceResponseList, string $q = null,  int $length = 12): AppSettingServiceResponseList
    {
        $appSetting = app()->call([$appSettingRepository, 'getByOwnerUserApiTokenList'], compact('apiToken', 'length', 'q'));
        return $this->formatResultList($appSetting, $appSettingServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByOwnerUserEmail(string $email, AppSettingRepository $appSettingRepository, AppSettingServiceResponse $appSettingServiceResponse): AppSettingServiceResponse
    {
        $appSetting = app()->call([$appSettingRepository, 'getByOwnerUserEmail'], compact('email'));
        return $this->formatResult($appSetting, $appSettingServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByOwnerUserEmailList(string $email, AppSettingRepository $appSettingRepository, AppSettingServiceResponseList $appSettingServiceResponseList, string $q = null,  int $length = 12): AppSettingServiceResponseList
    {
        $appSetting = app()->call([$appSettingRepository, 'getByOwnerUserEmailList'], compact('email', 'length', 'q'));
        return $this->formatResultList($appSetting, $appSettingServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByOwnerUserId(int $id, AppSettingRepository $appSettingRepository, AppSettingServiceResponse $appSettingServiceResponse): AppSettingServiceResponse
    {
        $appSetting = app()->call([$appSettingRepository, 'getByOwnerUserId'], compact('id'));
        return $this->formatResult($appSetting, $appSettingServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByOwnerUserIdList(int $id, AppSettingRepository $appSettingRepository, AppSettingServiceResponseList $appSettingServiceResponseList, string $q = null,  int $length = 12): AppSettingServiceResponseList
    {
        $appSetting = app()->call([$appSettingRepository, 'getByOwnerUserIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($appSetting, $appSettingServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserApiToken(string $apiToken, AppSettingRepository $appSettingRepository, AppSettingServiceResponse $appSettingServiceResponse): AppSettingServiceResponse
    {
        $appSetting = app()->call([$appSettingRepository, 'getByUserUserApiToken'], compact('apiToken'));
        return $this->formatResult($appSetting, $appSettingServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserApiTokenList(string $apiToken, AppSettingRepository $appSettingRepository, AppSettingServiceResponseList $appSettingServiceResponseList, string $q = null,  int $length = 12): AppSettingServiceResponseList
    {
        $appSetting = app()->call([$appSettingRepository, 'getByUserUserApiTokenList'], compact('apiToken', 'length', 'q'));
        return $this->formatResultList($appSetting, $appSettingServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserEmail(string $email, AppSettingRepository $appSettingRepository, AppSettingServiceResponse $appSettingServiceResponse): AppSettingServiceResponse
    {
        $appSetting = app()->call([$appSettingRepository, 'getByUserUserEmail'], compact('email'));
        return $this->formatResult($appSetting, $appSettingServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserEmailList(string $email, AppSettingRepository $appSettingRepository, AppSettingServiceResponseList $appSettingServiceResponseList, string $q = null,  int $length = 12): AppSettingServiceResponseList
    {
        $appSetting = app()->call([$appSettingRepository, 'getByUserUserEmailList'], compact('email', 'length', 'q'));
        return $this->formatResultList($appSetting, $appSettingServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserId(int $id, AppSettingRepository $appSettingRepository, AppSettingServiceResponse $appSettingServiceResponse): AppSettingServiceResponse
    {
        $appSetting = app()->call([$appSettingRepository, 'getByUserUserId'], compact('id'));
        return $this->formatResult($appSetting, $appSettingServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserIdList(int $id, AppSettingRepository $appSettingRepository, AppSettingServiceResponseList $appSettingServiceResponseList, string $q = null,  int $length = 12): AppSettingServiceResponseList
    {
        $appSetting = app()->call([$appSettingRepository, 'getByUserUserIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($appSetting, $appSettingServiceResponseList);
    }

}
