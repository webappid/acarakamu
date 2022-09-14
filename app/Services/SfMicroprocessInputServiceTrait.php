<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\SfMicroprocessInput;
use App\Repositories\Requests\SfMicroprocessInputRepositoryRequest;
use App\Repositories\SfMicroprocessInputRepository;
use App\Services\Requests\SfMicroprocessInputServiceRequest;
use App\Services\Responses\SfMicroprocessInputServiceResponse;
use App\Services\Responses\SfMicroprocessInputServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:35
 * Time: 2022/09/14
 * Class SfMicroprocessInputServiceTrait
 * @package App\Services
 */
trait SfMicroprocessInputServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(SfMicroprocessInputServiceRequest $sfMicroprocessInputServiceRequest, SfMicroprocessInputRepositoryRequest $sfMicroprocessInputRepositoryRequest, SfMicroprocessInputRepository $sfMicroprocessInputRepository, SfMicroprocessInputServiceResponse $sfMicroprocessInputServiceResponse): SfMicroprocessInputServiceResponse
    {
        $sfMicroprocessInputRepositoryRequest = Lazy::transform($sfMicroprocessInputServiceRequest, $sfMicroprocessInputRepositoryRequest);

        $result = app()->call([$sfMicroprocessInputRepository, 'store'], ['sfMicroprocessInputRepositoryRequest' => $sfMicroprocessInputRepositoryRequest]);
        if ($result != null) {
            $sfMicroprocessInputServiceResponse->status = true;
            $sfMicroprocessInputServiceResponse->message = 'Store Data Success';
            $sfMicroprocessInputServiceResponse->sfMicroprocessInput = $result;
        } else {
            $sfMicroprocessInputServiceResponse->status = false;
            $sfMicroprocessInputServiceResponse->message = 'Store Data Failed';
        }

        return $sfMicroprocessInputServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $microprocessInputId, SfMicroprocessInputServiceRequest $sfMicroprocessInputServiceRequest, SfMicroprocessInputRepositoryRequest $sfMicroprocessInputRepositoryRequest, SfMicroprocessInputRepository $sfMicroprocessInputRepository, SfMicroprocessInputServiceResponse $sfMicroprocessInputServiceResponse): SfMicroprocessInputServiceResponse
    {
        $sfMicroprocessInputRepositoryRequest = Lazy::transform($sfMicroprocessInputServiceRequest, $sfMicroprocessInputRepositoryRequest);

        $result = app()->call([$sfMicroprocessInputRepository, 'update'], ['microprocessInputId' => $microprocessInputId, 'sfMicroprocessInputRepositoryRequest' => $sfMicroprocessInputRepositoryRequest]);
        if ($result != null) {
            $sfMicroprocessInputServiceResponse->status = true;
            $sfMicroprocessInputServiceResponse->message = 'Update Data Success';
            $sfMicroprocessInputServiceResponse->sfMicroprocessInput = $result;
        } else {
            $sfMicroprocessInputServiceResponse->status = false;
            $sfMicroprocessInputServiceResponse->message = 'Update Data Failed';
        }

        return $sfMicroprocessInputServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $microprocessInputId, SfMicroprocessInputRepository $sfMicroprocessInputRepository, SfMicroprocessInputServiceResponse $sfMicroprocessInputServiceResponse): SfMicroprocessInputServiceResponse
    {
        $status = app()->call([$sfMicroprocessInputRepository, 'delete'], compact('microprocessInputId'));
        $sfMicroprocessInputServiceResponse->status = $status;
        if($status){
            $sfMicroprocessInputServiceResponse->message = "Delete Success";
        }else{
            $sfMicroprocessInputServiceResponse->message = "Delete Failed";
        }

        return $sfMicroprocessInputServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param SfMicroprocessInputServiceResponseList $sfMicroprocessInputServiceResponseList
     * @return SfMicroprocessInputServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, SfMicroprocessInputServiceResponseList $sfMicroprocessInputServiceResponseList): SfMicroprocessInputServiceResponseList{
        if (count($result) > 0) {
            $sfMicroprocessInputServiceResponseList->status = true;
            $sfMicroprocessInputServiceResponseList->message = 'Data Found';
            $sfMicroprocessInputServiceResponseList->sfMicroprocessInputList = $result;
            $sfMicroprocessInputServiceResponseList->count = $result->total();
            $sfMicroprocessInputServiceResponseList->countFiltered = $result->count();
        } else {
            $sfMicroprocessInputServiceResponseList->status = false;
            $sfMicroprocessInputServiceResponseList->message = 'Data Not Found';
        }
        return $sfMicroprocessInputServiceResponseList;
    }

    /**
     * @param SfMicroprocessInput|null $sfMicroprocessInput
     * @param SfMicroprocessInputServiceResponse $sfMicroprocessInputServiceResponse
     * @return SfMicroprocessInputServiceResponse
     */
    private function formatResult(?SfMicroprocessInput $sfMicroprocessInput, SfMicroprocessInputServiceResponse $sfMicroprocessInputServiceResponse): SfMicroprocessInputServiceResponse{
        if($sfMicroprocessInput == null){
            $sfMicroprocessInputServiceResponse->status = false;
            $sfMicroprocessInputServiceResponse->message = "Data Not Found";
        }else{
            $sfMicroprocessInputServiceResponse->status = true;
            $sfMicroprocessInputServiceResponse->message = "Data Found";
            $sfMicroprocessInputServiceResponse->sfMicroprocessInput = $sfMicroprocessInput;
        }

        return $sfMicroprocessInputServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(SfMicroprocessInputRepository $sfMicroprocessInputRepository, SfMicroprocessInputServiceResponseList $sfMicroprocessInputServiceResponseList, int $length = 12, string $q = null): SfMicroprocessInputServiceResponseList
    {
        $result = app()->call([$sfMicroprocessInputRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $sfMicroprocessInputServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(SfMicroprocessInputRepository $sfMicroprocessInputRepository, string $q = null): int
    {
        return app()->call([$sfMicroprocessInputRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByMicroprocessInputProcessIdMicroprocessInputParamIdMicroprocessInputParamOrderMicroprocessInputParamParentId(int $microprocessInputProcessId, int $microprocessInputParamId, int $microprocessInputParamOrder, int $microprocessInputParamParentId, SfMicroprocessInputRepository $sfMicroprocessInputRepository, SfMicroprocessInputServiceResponse $sfMicroprocessInputServiceResponse): SfMicroprocessInputServiceResponse
    {
        $sfMicroprocessInput = app()->call([$sfMicroprocessInputRepository, 'getByMicroprocessInputProcessIdMicroprocessInputParamIdMicroprocessInputParamOrderMicroprocessInputParamParentId'], compact('microprocessInputProcessId', 'microprocessInputParamId', 'microprocessInputParamOrder', 'microprocessInputParamParentId'));
        return $this->formatResult($sfMicroprocessInput, $sfMicroprocessInputServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessInputProcessIdMicroprocessInputParamIdMicroprocessInputParamOrderMicroprocessInputParamParentIdList(int $microprocessInputProcessId, int $microprocessInputParamId, int $microprocessInputParamOrder, int $microprocessInputParamParentId, SfMicroprocessInputRepository $sfMicroprocessInputRepository, SfMicroprocessInputServiceResponseList $sfMicroprocessInputServiceResponseList, string $q = null,  int $length = 12): SfMicroprocessInputServiceResponseList
    {
        $sfMicroprocessInput = app()->call([$sfMicroprocessInputRepository, 'getByMicroprocessInputProcessIdMicroprocessInputParamIdMicroprocessInputParamOrderMicroprocessInputParamParentIdList'], compact('microprocessInputProcessId', 'microprocessInputParamId', 'microprocessInputParamOrder', 'microprocessInputParamParentId', 'length', 'q'));
        return $this->formatResultList($sfMicroprocessInput, $sfMicroprocessInputServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessInputId(int $microprocessInputId, SfMicroprocessInputRepository $sfMicroprocessInputRepository, SfMicroprocessInputServiceResponse $sfMicroprocessInputServiceResponse): SfMicroprocessInputServiceResponse
    {
        $sfMicroprocessInput = app()->call([$sfMicroprocessInputRepository, 'getByMicroprocessInputId'], compact('microprocessInputId'));
        return $this->formatResult($sfMicroprocessInput, $sfMicroprocessInputServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessInputIdList(int $microprocessInputId, SfMicroprocessInputRepository $sfMicroprocessInputRepository, SfMicroprocessInputServiceResponseList $sfMicroprocessInputServiceResponseList, string $q = null,  int $length = 12): SfMicroprocessInputServiceResponseList
    {
        $sfMicroprocessInput = app()->call([$sfMicroprocessInputRepository, 'getByMicroprocessInputIdList'], compact('microprocessInputId', 'length', 'q'));
        return $this->formatResultList($sfMicroprocessInput, $sfMicroprocessInputServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefParamParamName(string $paramName, SfMicroprocessInputRepository $sfMicroprocessInputRepository, SfMicroprocessInputServiceResponse $sfMicroprocessInputServiceResponse): SfMicroprocessInputServiceResponse
    {
        $sfMicroprocessInput = app()->call([$sfMicroprocessInputRepository, 'getBySfMicroprocessRefParamParamName'], compact('paramName'));
        return $this->formatResult($sfMicroprocessInput, $sfMicroprocessInputServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefParamParamNameList(string $paramName, SfMicroprocessInputRepository $sfMicroprocessInputRepository, SfMicroprocessInputServiceResponseList $sfMicroprocessInputServiceResponseList, string $q = null,  int $length = 12): SfMicroprocessInputServiceResponseList
    {
        $sfMicroprocessInput = app()->call([$sfMicroprocessInputRepository, 'getBySfMicroprocessRefParamParamNameList'], compact('paramName', 'length', 'q'));
        return $this->formatResultList($sfMicroprocessInput, $sfMicroprocessInputServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefParamParamId(int $paramId, SfMicroprocessInputRepository $sfMicroprocessInputRepository, SfMicroprocessInputServiceResponse $sfMicroprocessInputServiceResponse): SfMicroprocessInputServiceResponse
    {
        $sfMicroprocessInput = app()->call([$sfMicroprocessInputRepository, 'getBySfMicroprocessRefParamParamId'], compact('paramId'));
        return $this->formatResult($sfMicroprocessInput, $sfMicroprocessInputServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefParamParamIdList(int $paramId, SfMicroprocessInputRepository $sfMicroprocessInputRepository, SfMicroprocessInputServiceResponseList $sfMicroprocessInputServiceResponseList, string $q = null,  int $length = 12): SfMicroprocessInputServiceResponseList
    {
        $sfMicroprocessInput = app()->call([$sfMicroprocessInputRepository, 'getBySfMicroprocessRefParamParamIdList'], compact('paramId', 'length', 'q'));
        return $this->formatResultList($sfMicroprocessInput, $sfMicroprocessInputServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefProcessProcessCode(string $processCode, SfMicroprocessInputRepository $sfMicroprocessInputRepository, SfMicroprocessInputServiceResponse $sfMicroprocessInputServiceResponse): SfMicroprocessInputServiceResponse
    {
        $sfMicroprocessInput = app()->call([$sfMicroprocessInputRepository, 'getBySfMicroprocessRefProcessProcessCode'], compact('processCode'));
        return $this->formatResult($sfMicroprocessInput, $sfMicroprocessInputServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefProcessProcessCodeList(string $processCode, SfMicroprocessInputRepository $sfMicroprocessInputRepository, SfMicroprocessInputServiceResponseList $sfMicroprocessInputServiceResponseList, string $q = null,  int $length = 12): SfMicroprocessInputServiceResponseList
    {
        $sfMicroprocessInput = app()->call([$sfMicroprocessInputRepository, 'getBySfMicroprocessRefProcessProcessCodeList'], compact('processCode', 'length', 'q'));
        return $this->formatResultList($sfMicroprocessInput, $sfMicroprocessInputServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefProcessProcessId(int $processId, SfMicroprocessInputRepository $sfMicroprocessInputRepository, SfMicroprocessInputServiceResponse $sfMicroprocessInputServiceResponse): SfMicroprocessInputServiceResponse
    {
        $sfMicroprocessInput = app()->call([$sfMicroprocessInputRepository, 'getBySfMicroprocessRefProcessProcessId'], compact('processId'));
        return $this->formatResult($sfMicroprocessInput, $sfMicroprocessInputServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefProcessProcessIdList(int $processId, SfMicroprocessInputRepository $sfMicroprocessInputRepository, SfMicroprocessInputServiceResponseList $sfMicroprocessInputServiceResponseList, string $q = null,  int $length = 12): SfMicroprocessInputServiceResponseList
    {
        $sfMicroprocessInput = app()->call([$sfMicroprocessInputRepository, 'getBySfMicroprocessRefProcessProcessIdList'], compact('processId', 'length', 'q'));
        return $this->formatResultList($sfMicroprocessInput, $sfMicroprocessInputServiceResponseList);
    }

}
