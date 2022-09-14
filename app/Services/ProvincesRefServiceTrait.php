<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\ProvincesRef;
use App\Repositories\ProvincesRefRepository;
use App\Repositories\Requests\ProvincesRefRepositoryRequest;
use App\Services\Requests\ProvincesRefServiceRequest;
use App\Services\Responses\ProvincesRefServiceResponse;
use App\Services\Responses\ProvincesRefServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:19
 * Time: 2022/09/14
 * Class ProvincesRefServiceTrait
 * @package App\Services
 */
trait ProvincesRefServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(ProvincesRefServiceRequest $provincesRefServiceRequest, ProvincesRefRepositoryRequest $provincesRefRepositoryRequest, ProvincesRefRepository $provincesRefRepository, ProvincesRefServiceResponse $provincesRefServiceResponse): ProvincesRefServiceResponse
    {
        $provincesRefRepositoryRequest = Lazy::transform($provincesRefServiceRequest, $provincesRefRepositoryRequest);

        $result = app()->call([$provincesRefRepository, 'store'], ['provincesRefRepositoryRequest' => $provincesRefRepositoryRequest]);
        if ($result != null) {
            $provincesRefServiceResponse->status = true;
            $provincesRefServiceResponse->message = 'Store Data Success';
            $provincesRefServiceResponse->provincesRef = $result;
        } else {
            $provincesRefServiceResponse->status = false;
            $provincesRefServiceResponse->message = 'Store Data Failed';
        }

        return $provincesRefServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $provincesRefId, ProvincesRefServiceRequest $provincesRefServiceRequest, ProvincesRefRepositoryRequest $provincesRefRepositoryRequest, ProvincesRefRepository $provincesRefRepository, ProvincesRefServiceResponse $provincesRefServiceResponse): ProvincesRefServiceResponse
    {
        $provincesRefRepositoryRequest = Lazy::transform($provincesRefServiceRequest, $provincesRefRepositoryRequest);

        $result = app()->call([$provincesRefRepository, 'update'], ['provincesRefId' => $provincesRefId, 'provincesRefRepositoryRequest' => $provincesRefRepositoryRequest]);
        if ($result != null) {
            $provincesRefServiceResponse->status = true;
            $provincesRefServiceResponse->message = 'Update Data Success';
            $provincesRefServiceResponse->provincesRef = $result;
        } else {
            $provincesRefServiceResponse->status = false;
            $provincesRefServiceResponse->message = 'Update Data Failed';
        }

        return $provincesRefServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $provincesRefId, ProvincesRefRepository $provincesRefRepository, ProvincesRefServiceResponse $provincesRefServiceResponse): ProvincesRefServiceResponse
    {
        $status = app()->call([$provincesRefRepository, 'delete'], compact('provincesRefId'));
        $provincesRefServiceResponse->status = $status;
        if($status){
            $provincesRefServiceResponse->message = "Delete Success";
        }else{
            $provincesRefServiceResponse->message = "Delete Failed";
        }

        return $provincesRefServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param ProvincesRefServiceResponseList $provincesRefServiceResponseList
     * @return ProvincesRefServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, ProvincesRefServiceResponseList $provincesRefServiceResponseList): ProvincesRefServiceResponseList{
        if (count($result) > 0) {
            $provincesRefServiceResponseList->status = true;
            $provincesRefServiceResponseList->message = 'Data Found';
            $provincesRefServiceResponseList->provincesRefList = $result;
            $provincesRefServiceResponseList->count = $result->total();
            $provincesRefServiceResponseList->countFiltered = $result->count();
        } else {
            $provincesRefServiceResponseList->status = false;
            $provincesRefServiceResponseList->message = 'Data Not Found';
        }
        return $provincesRefServiceResponseList;
    }

    /**
     * @param ProvincesRef|null $provincesRef
     * @param ProvincesRefServiceResponse $provincesRefServiceResponse
     * @return ProvincesRefServiceResponse
     */
    private function formatResult(?ProvincesRef $provincesRef, ProvincesRefServiceResponse $provincesRefServiceResponse): ProvincesRefServiceResponse{
        if($provincesRef == null){
            $provincesRefServiceResponse->status = false;
            $provincesRefServiceResponse->message = "Data Not Found";
        }else{
            $provincesRefServiceResponse->status = true;
            $provincesRefServiceResponse->message = "Data Found";
            $provincesRefServiceResponse->provincesRef = $provincesRef;
        }

        return $provincesRefServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(ProvincesRefRepository $provincesRefRepository, ProvincesRefServiceResponseList $provincesRefServiceResponseList, int $length = 12, string $q = null): ProvincesRefServiceResponseList
    {
        $result = app()->call([$provincesRefRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $provincesRefServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(ProvincesRefRepository $provincesRefRepository, string $q = null): int
    {
        return app()->call([$provincesRefRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByProvincesRefId(int $provincesRefId, ProvincesRefRepository $provincesRefRepository, ProvincesRefServiceResponse $provincesRefServiceResponse): ProvincesRefServiceResponse
    {
        $provincesRef = app()->call([$provincesRefRepository, 'getByProvincesRefId'], compact('provincesRefId'));
        return $this->formatResult($provincesRef, $provincesRefServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByProvincesRefIdList(int $provincesRefId, ProvincesRefRepository $provincesRefRepository, ProvincesRefServiceResponseList $provincesRefServiceResponseList, string $q = null,  int $length = 12): ProvincesRefServiceResponseList
    {
        $provincesRef = app()->call([$provincesRefRepository, 'getByProvincesRefIdList'], compact('provincesRefId', 'length', 'q'));
        return $this->formatResultList($provincesRef, $provincesRefServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserName(string $userName, ProvincesRefRepository $provincesRefRepository, ProvincesRefServiceResponse $provincesRefServiceResponse): ProvincesRefServiceResponse
    {
        $provincesRef = app()->call([$provincesRefRepository, 'getBySfUserUserName'], compact('userName'));
        return $this->formatResult($provincesRef, $provincesRefServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserNameList(string $userName, ProvincesRefRepository $provincesRefRepository, ProvincesRefServiceResponseList $provincesRefServiceResponseList, string $q = null,  int $length = 12): ProvincesRefServiceResponseList
    {
        $provincesRef = app()->call([$provincesRefRepository, 'getBySfUserUserNameList'], compact('userName', 'length', 'q'));
        return $this->formatResultList($provincesRef, $provincesRefServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserId(int $userId, ProvincesRefRepository $provincesRefRepository, ProvincesRefServiceResponse $provincesRefServiceResponse): ProvincesRefServiceResponse
    {
        $provincesRef = app()->call([$provincesRefRepository, 'getBySfUserUserId'], compact('userId'));
        return $this->formatResult($provincesRef, $provincesRefServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserIdList(int $userId, ProvincesRefRepository $provincesRefRepository, ProvincesRefServiceResponseList $provincesRefServiceResponseList, string $q = null,  int $length = 12): ProvincesRefServiceResponseList
    {
        $provincesRef = app()->call([$provincesRefRepository, 'getBySfUserUserIdList'], compact('userId', 'length', 'q'));
        return $this->formatResultList($provincesRef, $provincesRefServiceResponseList);
    }

}
