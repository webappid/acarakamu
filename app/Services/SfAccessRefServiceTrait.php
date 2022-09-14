<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\SfAccessRef;
use App\Repositories\Requests\SfAccessRefRepositoryRequest;
use App\Repositories\SfAccessRefRepository;
use App\Services\Requests\SfAccessRefServiceRequest;
use App\Services\Responses\SfAccessRefServiceResponse;
use App\Services\Responses\SfAccessRefServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:23
 * Time: 2022/09/14
 * Class SfAccessRefServiceTrait
 * @package App\Services
 */
trait SfAccessRefServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(SfAccessRefServiceRequest $sfAccessRefServiceRequest, SfAccessRefRepositoryRequest $sfAccessRefRepositoryRequest, SfAccessRefRepository $sfAccessRefRepository, SfAccessRefServiceResponse $sfAccessRefServiceResponse): SfAccessRefServiceResponse
    {
        $sfAccessRefRepositoryRequest = Lazy::transform($sfAccessRefServiceRequest, $sfAccessRefRepositoryRequest);

        $result = app()->call([$sfAccessRefRepository, 'store'], ['sfAccessRefRepositoryRequest' => $sfAccessRefRepositoryRequest]);
        if ($result != null) {
            $sfAccessRefServiceResponse->status = true;
            $sfAccessRefServiceResponse->message = 'Store Data Success';
            $sfAccessRefServiceResponse->sfAccessRef = $result;
        } else {
            $sfAccessRefServiceResponse->status = false;
            $sfAccessRefServiceResponse->message = 'Store Data Failed';
        }

        return $sfAccessRefServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $accessId, SfAccessRefServiceRequest $sfAccessRefServiceRequest, SfAccessRefRepositoryRequest $sfAccessRefRepositoryRequest, SfAccessRefRepository $sfAccessRefRepository, SfAccessRefServiceResponse $sfAccessRefServiceResponse): SfAccessRefServiceResponse
    {
        $sfAccessRefRepositoryRequest = Lazy::transform($sfAccessRefServiceRequest, $sfAccessRefRepositoryRequest);

        $result = app()->call([$sfAccessRefRepository, 'update'], ['accessId' => $accessId, 'sfAccessRefRepositoryRequest' => $sfAccessRefRepositoryRequest]);
        if ($result != null) {
            $sfAccessRefServiceResponse->status = true;
            $sfAccessRefServiceResponse->message = 'Update Data Success';
            $sfAccessRefServiceResponse->sfAccessRef = $result;
        } else {
            $sfAccessRefServiceResponse->status = false;
            $sfAccessRefServiceResponse->message = 'Update Data Failed';
        }

        return $sfAccessRefServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $accessId, SfAccessRefRepository $sfAccessRefRepository, SfAccessRefServiceResponse $sfAccessRefServiceResponse): SfAccessRefServiceResponse
    {
        $status = app()->call([$sfAccessRefRepository, 'delete'], compact('accessId'));
        $sfAccessRefServiceResponse->status = $status;
        if($status){
            $sfAccessRefServiceResponse->message = "Delete Success";
        }else{
            $sfAccessRefServiceResponse->message = "Delete Failed";
        }

        return $sfAccessRefServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param SfAccessRefServiceResponseList $sfAccessRefServiceResponseList
     * @return SfAccessRefServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, SfAccessRefServiceResponseList $sfAccessRefServiceResponseList): SfAccessRefServiceResponseList{
        if (count($result) > 0) {
            $sfAccessRefServiceResponseList->status = true;
            $sfAccessRefServiceResponseList->message = 'Data Found';
            $sfAccessRefServiceResponseList->sfAccessRefList = $result;
            $sfAccessRefServiceResponseList->count = $result->total();
            $sfAccessRefServiceResponseList->countFiltered = $result->count();
        } else {
            $sfAccessRefServiceResponseList->status = false;
            $sfAccessRefServiceResponseList->message = 'Data Not Found';
        }
        return $sfAccessRefServiceResponseList;
    }

    /**
     * @param SfAccessRef|null $sfAccessRef
     * @param SfAccessRefServiceResponse $sfAccessRefServiceResponse
     * @return SfAccessRefServiceResponse
     */
    private function formatResult(?SfAccessRef $sfAccessRef, SfAccessRefServiceResponse $sfAccessRefServiceResponse): SfAccessRefServiceResponse{
        if($sfAccessRef == null){
            $sfAccessRefServiceResponse->status = false;
            $sfAccessRefServiceResponse->message = "Data Not Found";
        }else{
            $sfAccessRefServiceResponse->status = true;
            $sfAccessRefServiceResponse->message = "Data Found";
            $sfAccessRefServiceResponse->sfAccessRef = $sfAccessRef;
        }

        return $sfAccessRefServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(SfAccessRefRepository $sfAccessRefRepository, SfAccessRefServiceResponseList $sfAccessRefServiceResponseList, int $length = 12, string $q = null): SfAccessRefServiceResponseList
    {
        $result = app()->call([$sfAccessRefRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $sfAccessRefServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(SfAccessRefRepository $sfAccessRefRepository, string $q = null): int
    {
        return app()->call([$sfAccessRefRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByAccessId(int $accessId, SfAccessRefRepository $sfAccessRefRepository, SfAccessRefServiceResponse $sfAccessRefServiceResponse): SfAccessRefServiceResponse
    {
        $sfAccessRef = app()->call([$sfAccessRefRepository, 'getByAccessId'], compact('accessId'));
        return $this->formatResult($sfAccessRef, $sfAccessRefServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByAccessIdList(int $accessId, SfAccessRefRepository $sfAccessRefRepository, SfAccessRefServiceResponseList $sfAccessRefServiceResponseList, string $q = null,  int $length = 12): SfAccessRefServiceResponseList
    {
        $sfAccessRef = app()->call([$sfAccessRefRepository, 'getByAccessIdList'], compact('accessId', 'length', 'q'));
        return $this->formatResultList($sfAccessRef, $sfAccessRefServiceResponseList);
    }

}
