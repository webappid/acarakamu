<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\CityRef;
use App\Repositories\CityRefRepository;
use App\Repositories\Requests\CityRefRepositoryRequest;
use App\Services\Requests\CityRefServiceRequest;
use App\Services\Responses\CityRefServiceResponse;
use App\Services\Responses\CityRefServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:03:59
 * Time: 2022/09/14
 * Class CityRefServiceTrait
 * @package App\Services
 */
trait CityRefServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(CityRefServiceRequest $cityRefServiceRequest, CityRefRepositoryRequest $cityRefRepositoryRequest, CityRefRepository $cityRefRepository, CityRefServiceResponse $cityRefServiceResponse): CityRefServiceResponse
    {
        $cityRefRepositoryRequest = Lazy::transform($cityRefServiceRequest, $cityRefRepositoryRequest);

        $result = app()->call([$cityRefRepository, 'store'], ['cityRefRepositoryRequest' => $cityRefRepositoryRequest]);
        if ($result != null) {
            $cityRefServiceResponse->status = true;
            $cityRefServiceResponse->message = 'Store Data Success';
            $cityRefServiceResponse->cityRef = $result;
        } else {
            $cityRefServiceResponse->status = false;
            $cityRefServiceResponse->message = 'Store Data Failed';
        }

        return $cityRefServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $cityId, CityRefServiceRequest $cityRefServiceRequest, CityRefRepositoryRequest $cityRefRepositoryRequest, CityRefRepository $cityRefRepository, CityRefServiceResponse $cityRefServiceResponse): CityRefServiceResponse
    {
        $cityRefRepositoryRequest = Lazy::transform($cityRefServiceRequest, $cityRefRepositoryRequest);

        $result = app()->call([$cityRefRepository, 'update'], ['cityId' => $cityId, 'cityRefRepositoryRequest' => $cityRefRepositoryRequest]);
        if ($result != null) {
            $cityRefServiceResponse->status = true;
            $cityRefServiceResponse->message = 'Update Data Success';
            $cityRefServiceResponse->cityRef = $result;
        } else {
            $cityRefServiceResponse->status = false;
            $cityRefServiceResponse->message = 'Update Data Failed';
        }

        return $cityRefServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $cityId, CityRefRepository $cityRefRepository, CityRefServiceResponse $cityRefServiceResponse): CityRefServiceResponse
    {
        $status = app()->call([$cityRefRepository, 'delete'], compact('cityId'));
        $cityRefServiceResponse->status = $status;
        if($status){
            $cityRefServiceResponse->message = "Delete Success";
        }else{
            $cityRefServiceResponse->message = "Delete Failed";
        }

        return $cityRefServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param CityRefServiceResponseList $cityRefServiceResponseList
     * @return CityRefServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, CityRefServiceResponseList $cityRefServiceResponseList): CityRefServiceResponseList{
        if (count($result) > 0) {
            $cityRefServiceResponseList->status = true;
            $cityRefServiceResponseList->message = 'Data Found';
            $cityRefServiceResponseList->cityRefList = $result;
            $cityRefServiceResponseList->count = $result->total();
            $cityRefServiceResponseList->countFiltered = $result->count();
        } else {
            $cityRefServiceResponseList->status = false;
            $cityRefServiceResponseList->message = 'Data Not Found';
        }
        return $cityRefServiceResponseList;
    }

    /**
     * @param CityRef|null $cityRef
     * @param CityRefServiceResponse $cityRefServiceResponse
     * @return CityRefServiceResponse
     */
    private function formatResult(?CityRef $cityRef, CityRefServiceResponse $cityRefServiceResponse): CityRefServiceResponse{
        if($cityRef == null){
            $cityRefServiceResponse->status = false;
            $cityRefServiceResponse->message = "Data Not Found";
        }else{
            $cityRefServiceResponse->status = true;
            $cityRefServiceResponse->message = "Data Found";
            $cityRefServiceResponse->cityRef = $cityRef;
        }

        return $cityRefServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(CityRefRepository $cityRefRepository, CityRefServiceResponseList $cityRefServiceResponseList, int $length = 12, string $q = null): CityRefServiceResponseList
    {
        $result = app()->call([$cityRefRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $cityRefServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(CityRefRepository $cityRefRepository, string $q = null): int
    {
        return app()->call([$cityRefRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByCityId(int $cityId, CityRefRepository $cityRefRepository, CityRefServiceResponse $cityRefServiceResponse): CityRefServiceResponse
    {
        $cityRef = app()->call([$cityRefRepository, 'getByCityId'], compact('cityId'));
        return $this->formatResult($cityRef, $cityRefServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByCityIdList(int $cityId, CityRefRepository $cityRefRepository, CityRefServiceResponseList $cityRefServiceResponseList, string $q = null,  int $length = 12): CityRefServiceResponseList
    {
        $cityRef = app()->call([$cityRefRepository, 'getByCityIdList'], compact('cityId', 'length', 'q'));
        return $this->formatResultList($cityRef, $cityRefServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserName(string $userName, CityRefRepository $cityRefRepository, CityRefServiceResponse $cityRefServiceResponse): CityRefServiceResponse
    {
        $cityRef = app()->call([$cityRefRepository, 'getBySfUserUserName'], compact('userName'));
        return $this->formatResult($cityRef, $cityRefServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserNameList(string $userName, CityRefRepository $cityRefRepository, CityRefServiceResponseList $cityRefServiceResponseList, string $q = null,  int $length = 12): CityRefServiceResponseList
    {
        $cityRef = app()->call([$cityRefRepository, 'getBySfUserUserNameList'], compact('userName', 'length', 'q'));
        return $this->formatResultList($cityRef, $cityRefServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserId(int $userId, CityRefRepository $cityRefRepository, CityRefServiceResponse $cityRefServiceResponse): CityRefServiceResponse
    {
        $cityRef = app()->call([$cityRefRepository, 'getBySfUserUserId'], compact('userId'));
        return $this->formatResult($cityRef, $cityRefServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserIdList(int $userId, CityRefRepository $cityRefRepository, CityRefServiceResponseList $cityRefServiceResponseList, string $q = null,  int $length = 12): CityRefServiceResponseList
    {
        $cityRef = app()->call([$cityRefRepository, 'getBySfUserUserIdList'], compact('userId', 'length', 'q'));
        return $this->formatResultList($cityRef, $cityRefServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByProvincesRefProvincesRefId(int $provincesRefId, CityRefRepository $cityRefRepository, CityRefServiceResponse $cityRefServiceResponse): CityRefServiceResponse
    {
        $cityRef = app()->call([$cityRefRepository, 'getByProvincesRefProvincesRefId'], compact('provincesRefId'));
        return $this->formatResult($cityRef, $cityRefServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByProvincesRefProvincesRefIdList(int $provincesRefId, CityRefRepository $cityRefRepository, CityRefServiceResponseList $cityRefServiceResponseList, string $q = null,  int $length = 12): CityRefServiceResponseList
    {
        $cityRef = app()->call([$cityRefRepository, 'getByProvincesRefProvincesRefIdList'], compact('provincesRefId', 'length', 'q'));
        return $this->formatResultList($cityRef, $cityRefServiceResponseList);
    }

}
