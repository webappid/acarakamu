<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\SfMicroprocessRefParam;
use App\Repositories\Requests\SfMicroprocessRefParamRepositoryRequest;
use App\Repositories\SfMicroprocessRefParamRepository;
use App\Services\Requests\SfMicroprocessRefParamServiceRequest;
use App\Services\Responses\SfMicroprocessRefParamServiceResponse;
use App\Services\Responses\SfMicroprocessRefParamServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:37
 * Time: 2022/09/14
 * Class SfMicroprocessRefParamServiceTrait
 * @package App\Services
 */
trait SfMicroprocessRefParamServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(SfMicroprocessRefParamServiceRequest $sfMicroprocessRefParamServiceRequest, SfMicroprocessRefParamRepositoryRequest $sfMicroprocessRefParamRepositoryRequest, SfMicroprocessRefParamRepository $sfMicroprocessRefParamRepository, SfMicroprocessRefParamServiceResponse $sfMicroprocessRefParamServiceResponse): SfMicroprocessRefParamServiceResponse
    {
        $sfMicroprocessRefParamRepositoryRequest = Lazy::transform($sfMicroprocessRefParamServiceRequest, $sfMicroprocessRefParamRepositoryRequest);

        $result = app()->call([$sfMicroprocessRefParamRepository, 'store'], ['sfMicroprocessRefParamRepositoryRequest' => $sfMicroprocessRefParamRepositoryRequest]);
        if ($result != null) {
            $sfMicroprocessRefParamServiceResponse->status = true;
            $sfMicroprocessRefParamServiceResponse->message = 'Store Data Success';
            $sfMicroprocessRefParamServiceResponse->sfMicroprocessRefParam = $result;
        } else {
            $sfMicroprocessRefParamServiceResponse->status = false;
            $sfMicroprocessRefParamServiceResponse->message = 'Store Data Failed';
        }

        return $sfMicroprocessRefParamServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(string $paramName, SfMicroprocessRefParamServiceRequest $sfMicroprocessRefParamServiceRequest, SfMicroprocessRefParamRepositoryRequest $sfMicroprocessRefParamRepositoryRequest, SfMicroprocessRefParamRepository $sfMicroprocessRefParamRepository, SfMicroprocessRefParamServiceResponse $sfMicroprocessRefParamServiceResponse): SfMicroprocessRefParamServiceResponse
    {
        $sfMicroprocessRefParamRepositoryRequest = Lazy::transform($sfMicroprocessRefParamServiceRequest, $sfMicroprocessRefParamRepositoryRequest);

        $result = app()->call([$sfMicroprocessRefParamRepository, 'update'], ['paramName' => $paramName, 'sfMicroprocessRefParamRepositoryRequest' => $sfMicroprocessRefParamRepositoryRequest]);
        if ($result != null) {
            $sfMicroprocessRefParamServiceResponse->status = true;
            $sfMicroprocessRefParamServiceResponse->message = 'Update Data Success';
            $sfMicroprocessRefParamServiceResponse->sfMicroprocessRefParam = $result;
        } else {
            $sfMicroprocessRefParamServiceResponse->status = false;
            $sfMicroprocessRefParamServiceResponse->message = 'Update Data Failed';
        }

        return $sfMicroprocessRefParamServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $paramName, SfMicroprocessRefParamRepository $sfMicroprocessRefParamRepository, SfMicroprocessRefParamServiceResponse $sfMicroprocessRefParamServiceResponse): SfMicroprocessRefParamServiceResponse
    {
        $status = app()->call([$sfMicroprocessRefParamRepository, 'delete'], compact('paramName'));
        $sfMicroprocessRefParamServiceResponse->status = $status;
        if($status){
            $sfMicroprocessRefParamServiceResponse->message = "Delete Success";
        }else{
            $sfMicroprocessRefParamServiceResponse->message = "Delete Failed";
        }

        return $sfMicroprocessRefParamServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param SfMicroprocessRefParamServiceResponseList $sfMicroprocessRefParamServiceResponseList
     * @return SfMicroprocessRefParamServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, SfMicroprocessRefParamServiceResponseList $sfMicroprocessRefParamServiceResponseList): SfMicroprocessRefParamServiceResponseList{
        if (count($result) > 0) {
            $sfMicroprocessRefParamServiceResponseList->status = true;
            $sfMicroprocessRefParamServiceResponseList->message = 'Data Found';
            $sfMicroprocessRefParamServiceResponseList->sfMicroprocessRefParamList = $result;
            $sfMicroprocessRefParamServiceResponseList->count = $result->total();
            $sfMicroprocessRefParamServiceResponseList->countFiltered = $result->count();
        } else {
            $sfMicroprocessRefParamServiceResponseList->status = false;
            $sfMicroprocessRefParamServiceResponseList->message = 'Data Not Found';
        }
        return $sfMicroprocessRefParamServiceResponseList;
    }

    /**
     * @param SfMicroprocessRefParam|null $sfMicroprocessRefParam
     * @param SfMicroprocessRefParamServiceResponse $sfMicroprocessRefParamServiceResponse
     * @return SfMicroprocessRefParamServiceResponse
     */
    private function formatResult(?SfMicroprocessRefParam $sfMicroprocessRefParam, SfMicroprocessRefParamServiceResponse $sfMicroprocessRefParamServiceResponse): SfMicroprocessRefParamServiceResponse{
        if($sfMicroprocessRefParam == null){
            $sfMicroprocessRefParamServiceResponse->status = false;
            $sfMicroprocessRefParamServiceResponse->message = "Data Not Found";
        }else{
            $sfMicroprocessRefParamServiceResponse->status = true;
            $sfMicroprocessRefParamServiceResponse->message = "Data Found";
            $sfMicroprocessRefParamServiceResponse->sfMicroprocessRefParam = $sfMicroprocessRefParam;
        }

        return $sfMicroprocessRefParamServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(SfMicroprocessRefParamRepository $sfMicroprocessRefParamRepository, SfMicroprocessRefParamServiceResponseList $sfMicroprocessRefParamServiceResponseList, int $length = 12, string $q = null): SfMicroprocessRefParamServiceResponseList
    {
        $result = app()->call([$sfMicroprocessRefParamRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $sfMicroprocessRefParamServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(SfMicroprocessRefParamRepository $sfMicroprocessRefParamRepository, string $q = null): int
    {
        return app()->call([$sfMicroprocessRefParamRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByParamName(string $paramName, SfMicroprocessRefParamRepository $sfMicroprocessRefParamRepository, SfMicroprocessRefParamServiceResponse $sfMicroprocessRefParamServiceResponse): SfMicroprocessRefParamServiceResponse
    {
        $sfMicroprocessRefParam = app()->call([$sfMicroprocessRefParamRepository, 'getByParamName'], compact('paramName'));
        return $this->formatResult($sfMicroprocessRefParam, $sfMicroprocessRefParamServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByParamNameList(string $paramName, SfMicroprocessRefParamRepository $sfMicroprocessRefParamRepository, SfMicroprocessRefParamServiceResponseList $sfMicroprocessRefParamServiceResponseList, string $q = null,  int $length = 12): SfMicroprocessRefParamServiceResponseList
    {
        $sfMicroprocessRefParam = app()->call([$sfMicroprocessRefParamRepository, 'getByParamNameList'], compact('paramName', 'length', 'q'));
        return $this->formatResultList($sfMicroprocessRefParam, $sfMicroprocessRefParamServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByParamId(int $paramId, SfMicroprocessRefParamRepository $sfMicroprocessRefParamRepository, SfMicroprocessRefParamServiceResponse $sfMicroprocessRefParamServiceResponse): SfMicroprocessRefParamServiceResponse
    {
        $sfMicroprocessRefParam = app()->call([$sfMicroprocessRefParamRepository, 'getByParamId'], compact('paramId'));
        return $this->formatResult($sfMicroprocessRefParam, $sfMicroprocessRefParamServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByParamIdList(int $paramId, SfMicroprocessRefParamRepository $sfMicroprocessRefParamRepository, SfMicroprocessRefParamServiceResponseList $sfMicroprocessRefParamServiceResponseList, string $q = null,  int $length = 12): SfMicroprocessRefParamServiceResponseList
    {
        $sfMicroprocessRefParam = app()->call([$sfMicroprocessRefParamRepository, 'getByParamIdList'], compact('paramId', 'length', 'q'));
        return $this->formatResultList($sfMicroprocessRefParam, $sfMicroprocessRefParamServiceResponseList);
    }

}
