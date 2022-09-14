<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\SfMicroprocessRefProcess;
use App\Repositories\Requests\SfMicroprocessRefProcessRepositoryRequest;
use App\Repositories\SfMicroprocessRefProcessRepository;
use App\Services\Requests\SfMicroprocessRefProcessServiceRequest;
use App\Services\Responses\SfMicroprocessRefProcessServiceResponse;
use App\Services\Responses\SfMicroprocessRefProcessServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:38
 * Time: 2022/09/14
 * Class SfMicroprocessRefProcessServiceTrait
 * @package App\Services
 */
trait SfMicroprocessRefProcessServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(SfMicroprocessRefProcessServiceRequest $sfMicroprocessRefProcessServiceRequest, SfMicroprocessRefProcessRepositoryRequest $sfMicroprocessRefProcessRepositoryRequest, SfMicroprocessRefProcessRepository $sfMicroprocessRefProcessRepository, SfMicroprocessRefProcessServiceResponse $sfMicroprocessRefProcessServiceResponse): SfMicroprocessRefProcessServiceResponse
    {
        $sfMicroprocessRefProcessRepositoryRequest = Lazy::transform($sfMicroprocessRefProcessServiceRequest, $sfMicroprocessRefProcessRepositoryRequest);

        $result = app()->call([$sfMicroprocessRefProcessRepository, 'store'], ['sfMicroprocessRefProcessRepositoryRequest' => $sfMicroprocessRefProcessRepositoryRequest]);
        if ($result != null) {
            $sfMicroprocessRefProcessServiceResponse->status = true;
            $sfMicroprocessRefProcessServiceResponse->message = 'Store Data Success';
            $sfMicroprocessRefProcessServiceResponse->sfMicroprocessRefProcess = $result;
        } else {
            $sfMicroprocessRefProcessServiceResponse->status = false;
            $sfMicroprocessRefProcessServiceResponse->message = 'Store Data Failed';
        }

        return $sfMicroprocessRefProcessServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(string $processCode, SfMicroprocessRefProcessServiceRequest $sfMicroprocessRefProcessServiceRequest, SfMicroprocessRefProcessRepositoryRequest $sfMicroprocessRefProcessRepositoryRequest, SfMicroprocessRefProcessRepository $sfMicroprocessRefProcessRepository, SfMicroprocessRefProcessServiceResponse $sfMicroprocessRefProcessServiceResponse): SfMicroprocessRefProcessServiceResponse
    {
        $sfMicroprocessRefProcessRepositoryRequest = Lazy::transform($sfMicroprocessRefProcessServiceRequest, $sfMicroprocessRefProcessRepositoryRequest);

        $result = app()->call([$sfMicroprocessRefProcessRepository, 'update'], ['processCode' => $processCode, 'sfMicroprocessRefProcessRepositoryRequest' => $sfMicroprocessRefProcessRepositoryRequest]);
        if ($result != null) {
            $sfMicroprocessRefProcessServiceResponse->status = true;
            $sfMicroprocessRefProcessServiceResponse->message = 'Update Data Success';
            $sfMicroprocessRefProcessServiceResponse->sfMicroprocessRefProcess = $result;
        } else {
            $sfMicroprocessRefProcessServiceResponse->status = false;
            $sfMicroprocessRefProcessServiceResponse->message = 'Update Data Failed';
        }

        return $sfMicroprocessRefProcessServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $processCode, SfMicroprocessRefProcessRepository $sfMicroprocessRefProcessRepository, SfMicroprocessRefProcessServiceResponse $sfMicroprocessRefProcessServiceResponse): SfMicroprocessRefProcessServiceResponse
    {
        $status = app()->call([$sfMicroprocessRefProcessRepository, 'delete'], compact('processCode'));
        $sfMicroprocessRefProcessServiceResponse->status = $status;
        if($status){
            $sfMicroprocessRefProcessServiceResponse->message = "Delete Success";
        }else{
            $sfMicroprocessRefProcessServiceResponse->message = "Delete Failed";
        }

        return $sfMicroprocessRefProcessServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param SfMicroprocessRefProcessServiceResponseList $sfMicroprocessRefProcessServiceResponseList
     * @return SfMicroprocessRefProcessServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, SfMicroprocessRefProcessServiceResponseList $sfMicroprocessRefProcessServiceResponseList): SfMicroprocessRefProcessServiceResponseList{
        if (count($result) > 0) {
            $sfMicroprocessRefProcessServiceResponseList->status = true;
            $sfMicroprocessRefProcessServiceResponseList->message = 'Data Found';
            $sfMicroprocessRefProcessServiceResponseList->sfMicroprocessRefProcessList = $result;
            $sfMicroprocessRefProcessServiceResponseList->count = $result->total();
            $sfMicroprocessRefProcessServiceResponseList->countFiltered = $result->count();
        } else {
            $sfMicroprocessRefProcessServiceResponseList->status = false;
            $sfMicroprocessRefProcessServiceResponseList->message = 'Data Not Found';
        }
        return $sfMicroprocessRefProcessServiceResponseList;
    }

    /**
     * @param SfMicroprocessRefProcess|null $sfMicroprocessRefProcess
     * @param SfMicroprocessRefProcessServiceResponse $sfMicroprocessRefProcessServiceResponse
     * @return SfMicroprocessRefProcessServiceResponse
     */
    private function formatResult(?SfMicroprocessRefProcess $sfMicroprocessRefProcess, SfMicroprocessRefProcessServiceResponse $sfMicroprocessRefProcessServiceResponse): SfMicroprocessRefProcessServiceResponse{
        if($sfMicroprocessRefProcess == null){
            $sfMicroprocessRefProcessServiceResponse->status = false;
            $sfMicroprocessRefProcessServiceResponse->message = "Data Not Found";
        }else{
            $sfMicroprocessRefProcessServiceResponse->status = true;
            $sfMicroprocessRefProcessServiceResponse->message = "Data Found";
            $sfMicroprocessRefProcessServiceResponse->sfMicroprocessRefProcess = $sfMicroprocessRefProcess;
        }

        return $sfMicroprocessRefProcessServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(SfMicroprocessRefProcessRepository $sfMicroprocessRefProcessRepository, SfMicroprocessRefProcessServiceResponseList $sfMicroprocessRefProcessServiceResponseList, int $length = 12, string $q = null): SfMicroprocessRefProcessServiceResponseList
    {
        $result = app()->call([$sfMicroprocessRefProcessRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $sfMicroprocessRefProcessServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(SfMicroprocessRefProcessRepository $sfMicroprocessRefProcessRepository, string $q = null): int
    {
        return app()->call([$sfMicroprocessRefProcessRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByProcessCode(string $processCode, SfMicroprocessRefProcessRepository $sfMicroprocessRefProcessRepository, SfMicroprocessRefProcessServiceResponse $sfMicroprocessRefProcessServiceResponse): SfMicroprocessRefProcessServiceResponse
    {
        $sfMicroprocessRefProcess = app()->call([$sfMicroprocessRefProcessRepository, 'getByProcessCode'], compact('processCode'));
        return $this->formatResult($sfMicroprocessRefProcess, $sfMicroprocessRefProcessServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByProcessCodeList(string $processCode, SfMicroprocessRefProcessRepository $sfMicroprocessRefProcessRepository, SfMicroprocessRefProcessServiceResponseList $sfMicroprocessRefProcessServiceResponseList, string $q = null,  int $length = 12): SfMicroprocessRefProcessServiceResponseList
    {
        $sfMicroprocessRefProcess = app()->call([$sfMicroprocessRefProcessRepository, 'getByProcessCodeList'], compact('processCode', 'length', 'q'));
        return $this->formatResultList($sfMicroprocessRefProcess, $sfMicroprocessRefProcessServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByProcessId(int $processId, SfMicroprocessRefProcessRepository $sfMicroprocessRefProcessRepository, SfMicroprocessRefProcessServiceResponse $sfMicroprocessRefProcessServiceResponse): SfMicroprocessRefProcessServiceResponse
    {
        $sfMicroprocessRefProcess = app()->call([$sfMicroprocessRefProcessRepository, 'getByProcessId'], compact('processId'));
        return $this->formatResult($sfMicroprocessRefProcess, $sfMicroprocessRefProcessServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByProcessIdList(int $processId, SfMicroprocessRefProcessRepository $sfMicroprocessRefProcessRepository, SfMicroprocessRefProcessServiceResponseList $sfMicroprocessRefProcessServiceResponseList, string $q = null,  int $length = 12): SfMicroprocessRefProcessServiceResponseList
    {
        $sfMicroprocessRefProcess = app()->call([$sfMicroprocessRefProcessRepository, 'getByProcessIdList'], compact('processId', 'length', 'q'));
        return $this->formatResultList($sfMicroprocessRefProcess, $sfMicroprocessRefProcessServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefParamParamName(string $paramName, SfMicroprocessRefProcessRepository $sfMicroprocessRefProcessRepository, SfMicroprocessRefProcessServiceResponse $sfMicroprocessRefProcessServiceResponse): SfMicroprocessRefProcessServiceResponse
    {
        $sfMicroprocessRefProcess = app()->call([$sfMicroprocessRefProcessRepository, 'getBySfMicroprocessRefParamParamName'], compact('paramName'));
        return $this->formatResult($sfMicroprocessRefProcess, $sfMicroprocessRefProcessServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefParamParamNameList(string $paramName, SfMicroprocessRefProcessRepository $sfMicroprocessRefProcessRepository, SfMicroprocessRefProcessServiceResponseList $sfMicroprocessRefProcessServiceResponseList, string $q = null,  int $length = 12): SfMicroprocessRefProcessServiceResponseList
    {
        $sfMicroprocessRefProcess = app()->call([$sfMicroprocessRefProcessRepository, 'getBySfMicroprocessRefParamParamNameList'], compact('paramName', 'length', 'q'));
        return $this->formatResultList($sfMicroprocessRefProcess, $sfMicroprocessRefProcessServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefParamParamId(int $paramId, SfMicroprocessRefProcessRepository $sfMicroprocessRefProcessRepository, SfMicroprocessRefProcessServiceResponse $sfMicroprocessRefProcessServiceResponse): SfMicroprocessRefProcessServiceResponse
    {
        $sfMicroprocessRefProcess = app()->call([$sfMicroprocessRefProcessRepository, 'getBySfMicroprocessRefParamParamId'], compact('paramId'));
        return $this->formatResult($sfMicroprocessRefProcess, $sfMicroprocessRefProcessServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefParamParamIdList(int $paramId, SfMicroprocessRefProcessRepository $sfMicroprocessRefProcessRepository, SfMicroprocessRefProcessServiceResponseList $sfMicroprocessRefProcessServiceResponseList, string $q = null,  int $length = 12): SfMicroprocessRefProcessServiceResponseList
    {
        $sfMicroprocessRefProcess = app()->call([$sfMicroprocessRefProcessRepository, 'getBySfMicroprocessRefParamParamIdList'], compact('paramId', 'length', 'q'));
        return $this->formatResultList($sfMicroprocessRefProcess, $sfMicroprocessRefProcessServiceResponseList);
    }

}
