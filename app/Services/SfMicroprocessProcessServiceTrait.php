<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\SfMicroprocessProcess;
use App\Repositories\Requests\SfMicroprocessProcessRepositoryRequest;
use App\Repositories\SfMicroprocessProcessRepository;
use App\Services\Requests\SfMicroprocessProcessServiceRequest;
use App\Services\Responses\SfMicroprocessProcessServiceResponse;
use App\Services\Responses\SfMicroprocessProcessServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:36
 * Time: 2022/09/14
 * Class SfMicroprocessProcessServiceTrait
 * @package App\Services
 */
trait SfMicroprocessProcessServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(SfMicroprocessProcessServiceRequest $sfMicroprocessProcessServiceRequest, SfMicroprocessProcessRepositoryRequest $sfMicroprocessProcessRepositoryRequest, SfMicroprocessProcessRepository $sfMicroprocessProcessRepository, SfMicroprocessProcessServiceResponse $sfMicroprocessProcessServiceResponse): SfMicroprocessProcessServiceResponse
    {
        $sfMicroprocessProcessRepositoryRequest = Lazy::transform($sfMicroprocessProcessServiceRequest, $sfMicroprocessProcessRepositoryRequest);

        $result = app()->call([$sfMicroprocessProcessRepository, 'store'], ['sfMicroprocessProcessRepositoryRequest' => $sfMicroprocessProcessRepositoryRequest]);
        if ($result != null) {
            $sfMicroprocessProcessServiceResponse->status = true;
            $sfMicroprocessProcessServiceResponse->message = 'Store Data Success';
            $sfMicroprocessProcessServiceResponse->sfMicroprocessProcess = $result;
        } else {
            $sfMicroprocessProcessServiceResponse->status = false;
            $sfMicroprocessProcessServiceResponse->message = 'Store Data Failed';
        }

        return $sfMicroprocessProcessServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $microprocessProcessId, SfMicroprocessProcessServiceRequest $sfMicroprocessProcessServiceRequest, SfMicroprocessProcessRepositoryRequest $sfMicroprocessProcessRepositoryRequest, SfMicroprocessProcessRepository $sfMicroprocessProcessRepository, SfMicroprocessProcessServiceResponse $sfMicroprocessProcessServiceResponse): SfMicroprocessProcessServiceResponse
    {
        $sfMicroprocessProcessRepositoryRequest = Lazy::transform($sfMicroprocessProcessServiceRequest, $sfMicroprocessProcessRepositoryRequest);

        $result = app()->call([$sfMicroprocessProcessRepository, 'update'], ['microprocessProcessId' => $microprocessProcessId, 'sfMicroprocessProcessRepositoryRequest' => $sfMicroprocessProcessRepositoryRequest]);
        if ($result != null) {
            $sfMicroprocessProcessServiceResponse->status = true;
            $sfMicroprocessProcessServiceResponse->message = 'Update Data Success';
            $sfMicroprocessProcessServiceResponse->sfMicroprocessProcess = $result;
        } else {
            $sfMicroprocessProcessServiceResponse->status = false;
            $sfMicroprocessProcessServiceResponse->message = 'Update Data Failed';
        }

        return $sfMicroprocessProcessServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $microprocessProcessId, SfMicroprocessProcessRepository $sfMicroprocessProcessRepository, SfMicroprocessProcessServiceResponse $sfMicroprocessProcessServiceResponse): SfMicroprocessProcessServiceResponse
    {
        $status = app()->call([$sfMicroprocessProcessRepository, 'delete'], compact('microprocessProcessId'));
        $sfMicroprocessProcessServiceResponse->status = $status;
        if($status){
            $sfMicroprocessProcessServiceResponse->message = "Delete Success";
        }else{
            $sfMicroprocessProcessServiceResponse->message = "Delete Failed";
        }

        return $sfMicroprocessProcessServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param SfMicroprocessProcessServiceResponseList $sfMicroprocessProcessServiceResponseList
     * @return SfMicroprocessProcessServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, SfMicroprocessProcessServiceResponseList $sfMicroprocessProcessServiceResponseList): SfMicroprocessProcessServiceResponseList{
        if (count($result) > 0) {
            $sfMicroprocessProcessServiceResponseList->status = true;
            $sfMicroprocessProcessServiceResponseList->message = 'Data Found';
            $sfMicroprocessProcessServiceResponseList->sfMicroprocessProcessList = $result;
            $sfMicroprocessProcessServiceResponseList->count = $result->total();
            $sfMicroprocessProcessServiceResponseList->countFiltered = $result->count();
        } else {
            $sfMicroprocessProcessServiceResponseList->status = false;
            $sfMicroprocessProcessServiceResponseList->message = 'Data Not Found';
        }
        return $sfMicroprocessProcessServiceResponseList;
    }

    /**
     * @param SfMicroprocessProcess|null $sfMicroprocessProcess
     * @param SfMicroprocessProcessServiceResponse $sfMicroprocessProcessServiceResponse
     * @return SfMicroprocessProcessServiceResponse
     */
    private function formatResult(?SfMicroprocessProcess $sfMicroprocessProcess, SfMicroprocessProcessServiceResponse $sfMicroprocessProcessServiceResponse): SfMicroprocessProcessServiceResponse{
        if($sfMicroprocessProcess == null){
            $sfMicroprocessProcessServiceResponse->status = false;
            $sfMicroprocessProcessServiceResponse->message = "Data Not Found";
        }else{
            $sfMicroprocessProcessServiceResponse->status = true;
            $sfMicroprocessProcessServiceResponse->message = "Data Found";
            $sfMicroprocessProcessServiceResponse->sfMicroprocessProcess = $sfMicroprocessProcess;
        }

        return $sfMicroprocessProcessServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(SfMicroprocessProcessRepository $sfMicroprocessProcessRepository, SfMicroprocessProcessServiceResponseList $sfMicroprocessProcessServiceResponseList, int $length = 12, string $q = null): SfMicroprocessProcessServiceResponseList
    {
        $result = app()->call([$sfMicroprocessProcessRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $sfMicroprocessProcessServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(SfMicroprocessProcessRepository $sfMicroprocessProcessRepository, string $q = null): int
    {
        return app()->call([$sfMicroprocessProcessRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByMicroprocessProcessId(int $microprocessProcessId, SfMicroprocessProcessRepository $sfMicroprocessProcessRepository, SfMicroprocessProcessServiceResponse $sfMicroprocessProcessServiceResponse): SfMicroprocessProcessServiceResponse
    {
        $sfMicroprocessProcess = app()->call([$sfMicroprocessProcessRepository, 'getByMicroprocessProcessId'], compact('microprocessProcessId'));
        return $this->formatResult($sfMicroprocessProcess, $sfMicroprocessProcessServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessProcessIdList(int $microprocessProcessId, SfMicroprocessProcessRepository $sfMicroprocessProcessRepository, SfMicroprocessProcessServiceResponseList $sfMicroprocessProcessServiceResponseList, string $q = null,  int $length = 12): SfMicroprocessProcessServiceResponseList
    {
        $sfMicroprocessProcess = app()->call([$sfMicroprocessProcessRepository, 'getByMicroprocessProcessIdList'], compact('microprocessProcessId', 'length', 'q'));
        return $this->formatResultList($sfMicroprocessProcess, $sfMicroprocessProcessServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefProcessProcessCode(string $processCode, SfMicroprocessProcessRepository $sfMicroprocessProcessRepository, SfMicroprocessProcessServiceResponse $sfMicroprocessProcessServiceResponse): SfMicroprocessProcessServiceResponse
    {
        $sfMicroprocessProcess = app()->call([$sfMicroprocessProcessRepository, 'getBySfMicroprocessRefProcessProcessCode'], compact('processCode'));
        return $this->formatResult($sfMicroprocessProcess, $sfMicroprocessProcessServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefProcessProcessCodeList(string $processCode, SfMicroprocessProcessRepository $sfMicroprocessProcessRepository, SfMicroprocessProcessServiceResponseList $sfMicroprocessProcessServiceResponseList, string $q = null,  int $length = 12): SfMicroprocessProcessServiceResponseList
    {
        $sfMicroprocessProcess = app()->call([$sfMicroprocessProcessRepository, 'getBySfMicroprocessRefProcessProcessCodeList'], compact('processCode', 'length', 'q'));
        return $this->formatResultList($sfMicroprocessProcess, $sfMicroprocessProcessServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefProcessProcessId(int $processId, SfMicroprocessProcessRepository $sfMicroprocessProcessRepository, SfMicroprocessProcessServiceResponse $sfMicroprocessProcessServiceResponse): SfMicroprocessProcessServiceResponse
    {
        $sfMicroprocessProcess = app()->call([$sfMicroprocessProcessRepository, 'getBySfMicroprocessRefProcessProcessId'], compact('processId'));
        return $this->formatResult($sfMicroprocessProcess, $sfMicroprocessProcessServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefProcessProcessIdList(int $processId, SfMicroprocessProcessRepository $sfMicroprocessProcessRepository, SfMicroprocessProcessServiceResponseList $sfMicroprocessProcessServiceResponseList, string $q = null,  int $length = 12): SfMicroprocessProcessServiceResponseList
    {
        $sfMicroprocessProcess = app()->call([$sfMicroprocessProcessRepository, 'getBySfMicroprocessRefProcessProcessIdList'], compact('processId', 'length', 'q'));
        return $this->formatResultList($sfMicroprocessProcess, $sfMicroprocessProcessServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessMicroprocessCode(string $microprocessCode, SfMicroprocessProcessRepository $sfMicroprocessProcessRepository, SfMicroprocessProcessServiceResponse $sfMicroprocessProcessServiceResponse): SfMicroprocessProcessServiceResponse
    {
        $sfMicroprocessProcess = app()->call([$sfMicroprocessProcessRepository, 'getBySfMicroprocessMicroprocessCode'], compact('microprocessCode'));
        return $this->formatResult($sfMicroprocessProcess, $sfMicroprocessProcessServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessMicroprocessCodeList(string $microprocessCode, SfMicroprocessProcessRepository $sfMicroprocessProcessRepository, SfMicroprocessProcessServiceResponseList $sfMicroprocessProcessServiceResponseList, string $q = null,  int $length = 12): SfMicroprocessProcessServiceResponseList
    {
        $sfMicroprocessProcess = app()->call([$sfMicroprocessProcessRepository, 'getBySfMicroprocessMicroprocessCodeList'], compact('microprocessCode', 'length', 'q'));
        return $this->formatResultList($sfMicroprocessProcess, $sfMicroprocessProcessServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessMicroprocessId(int $microprocessId, SfMicroprocessProcessRepository $sfMicroprocessProcessRepository, SfMicroprocessProcessServiceResponse $sfMicroprocessProcessServiceResponse): SfMicroprocessProcessServiceResponse
    {
        $sfMicroprocessProcess = app()->call([$sfMicroprocessProcessRepository, 'getBySfMicroprocessMicroprocessId'], compact('microprocessId'));
        return $this->formatResult($sfMicroprocessProcess, $sfMicroprocessProcessServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessMicroprocessIdList(int $microprocessId, SfMicroprocessProcessRepository $sfMicroprocessProcessRepository, SfMicroprocessProcessServiceResponseList $sfMicroprocessProcessServiceResponseList, string $q = null,  int $length = 12): SfMicroprocessProcessServiceResponseList
    {
        $sfMicroprocessProcess = app()->call([$sfMicroprocessProcessRepository, 'getBySfMicroprocessMicroprocessIdList'], compact('microprocessId', 'length', 'q'));
        return $this->formatResultList($sfMicroprocessProcess, $sfMicroprocessProcessServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessProcessLinkIdSfMicroprocessRefProcessProcessCode(string $processCode, SfMicroprocessProcessRepository $sfMicroprocessProcessRepository, SfMicroprocessProcessServiceResponse $sfMicroprocessProcessServiceResponse): SfMicroprocessProcessServiceResponse
    {
        $sfMicroprocessProcess = app()->call([$sfMicroprocessProcessRepository, 'getByMicroprocessProcessLinkIdSfMicroprocessRefProcessProcessCode'], compact('processCode'));
        return $this->formatResult($sfMicroprocessProcess, $sfMicroprocessProcessServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessProcessLinkIdSfMicroprocessRefProcessProcessCodeList(string $processCode, SfMicroprocessProcessRepository $sfMicroprocessProcessRepository, SfMicroprocessProcessServiceResponseList $sfMicroprocessProcessServiceResponseList, string $q = null,  int $length = 12): SfMicroprocessProcessServiceResponseList
    {
        $sfMicroprocessProcess = app()->call([$sfMicroprocessProcessRepository, 'getByMicroprocessProcessLinkIdSfMicroprocessRefProcessProcessCodeList'], compact('processCode', 'length', 'q'));
        return $this->formatResultList($sfMicroprocessProcess, $sfMicroprocessProcessServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessProcessLinkIdSfMicroprocessRefProcessProcessId(int $processId, SfMicroprocessProcessRepository $sfMicroprocessProcessRepository, SfMicroprocessProcessServiceResponse $sfMicroprocessProcessServiceResponse): SfMicroprocessProcessServiceResponse
    {
        $sfMicroprocessProcess = app()->call([$sfMicroprocessProcessRepository, 'getByMicroprocessProcessLinkIdSfMicroprocessRefProcessProcessId'], compact('processId'));
        return $this->formatResult($sfMicroprocessProcess, $sfMicroprocessProcessServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessProcessLinkIdSfMicroprocessRefProcessProcessIdList(int $processId, SfMicroprocessProcessRepository $sfMicroprocessProcessRepository, SfMicroprocessProcessServiceResponseList $sfMicroprocessProcessServiceResponseList, string $q = null,  int $length = 12): SfMicroprocessProcessServiceResponseList
    {
        $sfMicroprocessProcess = app()->call([$sfMicroprocessProcessRepository, 'getByMicroprocessProcessLinkIdSfMicroprocessRefProcessProcessIdList'], compact('processId', 'length', 'q'));
        return $this->formatResultList($sfMicroprocessProcess, $sfMicroprocessProcessServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefParamParamName(string $paramName, SfMicroprocessProcessRepository $sfMicroprocessProcessRepository, SfMicroprocessProcessServiceResponse $sfMicroprocessProcessServiceResponse): SfMicroprocessProcessServiceResponse
    {
        $sfMicroprocessProcess = app()->call([$sfMicroprocessProcessRepository, 'getBySfMicroprocessRefParamParamName'], compact('paramName'));
        return $this->formatResult($sfMicroprocessProcess, $sfMicroprocessProcessServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefParamParamNameList(string $paramName, SfMicroprocessProcessRepository $sfMicroprocessProcessRepository, SfMicroprocessProcessServiceResponseList $sfMicroprocessProcessServiceResponseList, string $q = null,  int $length = 12): SfMicroprocessProcessServiceResponseList
    {
        $sfMicroprocessProcess = app()->call([$sfMicroprocessProcessRepository, 'getBySfMicroprocessRefParamParamNameList'], compact('paramName', 'length', 'q'));
        return $this->formatResultList($sfMicroprocessProcess, $sfMicroprocessProcessServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefParamParamId(int $paramId, SfMicroprocessProcessRepository $sfMicroprocessProcessRepository, SfMicroprocessProcessServiceResponse $sfMicroprocessProcessServiceResponse): SfMicroprocessProcessServiceResponse
    {
        $sfMicroprocessProcess = app()->call([$sfMicroprocessProcessRepository, 'getBySfMicroprocessRefParamParamId'], compact('paramId'));
        return $this->formatResult($sfMicroprocessProcess, $sfMicroprocessProcessServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefParamParamIdList(int $paramId, SfMicroprocessProcessRepository $sfMicroprocessProcessRepository, SfMicroprocessProcessServiceResponseList $sfMicroprocessProcessServiceResponseList, string $q = null,  int $length = 12): SfMicroprocessProcessServiceResponseList
    {
        $sfMicroprocessProcess = app()->call([$sfMicroprocessProcessRepository, 'getBySfMicroprocessRefParamParamIdList'], compact('paramId', 'length', 'q'));
        return $this->formatResultList($sfMicroprocessProcess, $sfMicroprocessProcessServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessProcessForeignIdSfMicroprocessRefParamParamName(string $paramName, SfMicroprocessProcessRepository $sfMicroprocessProcessRepository, SfMicroprocessProcessServiceResponse $sfMicroprocessProcessServiceResponse): SfMicroprocessProcessServiceResponse
    {
        $sfMicroprocessProcess = app()->call([$sfMicroprocessProcessRepository, 'getByMicroprocessProcessForeignIdSfMicroprocessRefParamParamName'], compact('paramName'));
        return $this->formatResult($sfMicroprocessProcess, $sfMicroprocessProcessServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessProcessForeignIdSfMicroprocessRefParamParamNameList(string $paramName, SfMicroprocessProcessRepository $sfMicroprocessProcessRepository, SfMicroprocessProcessServiceResponseList $sfMicroprocessProcessServiceResponseList, string $q = null,  int $length = 12): SfMicroprocessProcessServiceResponseList
    {
        $sfMicroprocessProcess = app()->call([$sfMicroprocessProcessRepository, 'getByMicroprocessProcessForeignIdSfMicroprocessRefParamParamNameList'], compact('paramName', 'length', 'q'));
        return $this->formatResultList($sfMicroprocessProcess, $sfMicroprocessProcessServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessProcessForeignIdSfMicroprocessRefParamParamId(int $paramId, SfMicroprocessProcessRepository $sfMicroprocessProcessRepository, SfMicroprocessProcessServiceResponse $sfMicroprocessProcessServiceResponse): SfMicroprocessProcessServiceResponse
    {
        $sfMicroprocessProcess = app()->call([$sfMicroprocessProcessRepository, 'getByMicroprocessProcessForeignIdSfMicroprocessRefParamParamId'], compact('paramId'));
        return $this->formatResult($sfMicroprocessProcess, $sfMicroprocessProcessServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessProcessForeignIdSfMicroprocessRefParamParamIdList(int $paramId, SfMicroprocessProcessRepository $sfMicroprocessProcessRepository, SfMicroprocessProcessServiceResponseList $sfMicroprocessProcessServiceResponseList, string $q = null,  int $length = 12): SfMicroprocessProcessServiceResponseList
    {
        $sfMicroprocessProcess = app()->call([$sfMicroprocessProcessRepository, 'getByMicroprocessProcessForeignIdSfMicroprocessRefParamParamIdList'], compact('paramId', 'length', 'q'));
        return $this->formatResultList($sfMicroprocessProcess, $sfMicroprocessProcessServiceResponseList);
    }

}
