<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\SfConfig;
use App\Repositories\Requests\SfConfigRepositoryRequest;
use App\Repositories\SfConfigRepository;
use App\Services\Requests\SfConfigServiceRequest;
use App\Services\Responses\SfConfigServiceResponse;
use App\Services\Responses\SfConfigServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:24
 * Time: 2022/09/14
 * Class SfConfigServiceTrait
 * @package App\Services
 */
trait SfConfigServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(SfConfigServiceRequest $sfConfigServiceRequest, SfConfigRepositoryRequest $sfConfigRepositoryRequest, SfConfigRepository $sfConfigRepository, SfConfigServiceResponse $sfConfigServiceResponse): SfConfigServiceResponse
    {
        $sfConfigRepositoryRequest = Lazy::transform($sfConfigServiceRequest, $sfConfigRepositoryRequest);

        $result = app()->call([$sfConfigRepository, 'store'], ['sfConfigRepositoryRequest' => $sfConfigRepositoryRequest]);
        if ($result != null) {
            $sfConfigServiceResponse->status = true;
            $sfConfigServiceResponse->message = 'Store Data Success';
            $sfConfigServiceResponse->sfConfig = $result;
        } else {
            $sfConfigServiceResponse->status = false;
            $sfConfigServiceResponse->message = 'Store Data Failed';
        }

        return $sfConfigServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(string $configCode, SfConfigServiceRequest $sfConfigServiceRequest, SfConfigRepositoryRequest $sfConfigRepositoryRequest, SfConfigRepository $sfConfigRepository, SfConfigServiceResponse $sfConfigServiceResponse): SfConfigServiceResponse
    {
        $sfConfigRepositoryRequest = Lazy::transform($sfConfigServiceRequest, $sfConfigRepositoryRequest);

        $result = app()->call([$sfConfigRepository, 'update'], ['configCode' => $configCode, 'sfConfigRepositoryRequest' => $sfConfigRepositoryRequest]);
        if ($result != null) {
            $sfConfigServiceResponse->status = true;
            $sfConfigServiceResponse->message = 'Update Data Success';
            $sfConfigServiceResponse->sfConfig = $result;
        } else {
            $sfConfigServiceResponse->status = false;
            $sfConfigServiceResponse->message = 'Update Data Failed';
        }

        return $sfConfigServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $configCode, SfConfigRepository $sfConfigRepository, SfConfigServiceResponse $sfConfigServiceResponse): SfConfigServiceResponse
    {
        $status = app()->call([$sfConfigRepository, 'delete'], compact('configCode'));
        $sfConfigServiceResponse->status = $status;
        if($status){
            $sfConfigServiceResponse->message = "Delete Success";
        }else{
            $sfConfigServiceResponse->message = "Delete Failed";
        }

        return $sfConfigServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param SfConfigServiceResponseList $sfConfigServiceResponseList
     * @return SfConfigServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, SfConfigServiceResponseList $sfConfigServiceResponseList): SfConfigServiceResponseList{
        if (count($result) > 0) {
            $sfConfigServiceResponseList->status = true;
            $sfConfigServiceResponseList->message = 'Data Found';
            $sfConfigServiceResponseList->sfConfigList = $result;
            $sfConfigServiceResponseList->count = $result->total();
            $sfConfigServiceResponseList->countFiltered = $result->count();
        } else {
            $sfConfigServiceResponseList->status = false;
            $sfConfigServiceResponseList->message = 'Data Not Found';
        }
        return $sfConfigServiceResponseList;
    }

    /**
     * @param SfConfig|null $sfConfig
     * @param SfConfigServiceResponse $sfConfigServiceResponse
     * @return SfConfigServiceResponse
     */
    private function formatResult(?SfConfig $sfConfig, SfConfigServiceResponse $sfConfigServiceResponse): SfConfigServiceResponse{
        if($sfConfig == null){
            $sfConfigServiceResponse->status = false;
            $sfConfigServiceResponse->message = "Data Not Found";
        }else{
            $sfConfigServiceResponse->status = true;
            $sfConfigServiceResponse->message = "Data Found";
            $sfConfigServiceResponse->sfConfig = $sfConfig;
        }

        return $sfConfigServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(SfConfigRepository $sfConfigRepository, SfConfigServiceResponseList $sfConfigServiceResponseList, int $length = 12, string $q = null): SfConfigServiceResponseList
    {
        $result = app()->call([$sfConfigRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $sfConfigServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(SfConfigRepository $sfConfigRepository, string $q = null): int
    {
        return app()->call([$sfConfigRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByConfigCode(string $configCode, SfConfigRepository $sfConfigRepository, SfConfigServiceResponse $sfConfigServiceResponse): SfConfigServiceResponse
    {
        $sfConfig = app()->call([$sfConfigRepository, 'getByConfigCode'], compact('configCode'));
        return $this->formatResult($sfConfig, $sfConfigServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByConfigCodeList(string $configCode, SfConfigRepository $sfConfigRepository, SfConfigServiceResponseList $sfConfigServiceResponseList, string $q = null,  int $length = 12): SfConfigServiceResponseList
    {
        $sfConfig = app()->call([$sfConfigRepository, 'getByConfigCodeList'], compact('configCode', 'length', 'q'));
        return $this->formatResultList($sfConfig, $sfConfigServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByConfigId(int $configId, SfConfigRepository $sfConfigRepository, SfConfigServiceResponse $sfConfigServiceResponse): SfConfigServiceResponse
    {
        $sfConfig = app()->call([$sfConfigRepository, 'getByConfigId'], compact('configId'));
        return $this->formatResult($sfConfig, $sfConfigServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByConfigIdList(int $configId, SfConfigRepository $sfConfigRepository, SfConfigServiceResponseList $sfConfigServiceResponseList, string $q = null,  int $length = 12): SfConfigServiceResponseList
    {
        $sfConfig = app()->call([$sfConfigRepository, 'getByConfigIdList'], compact('configId', 'length', 'q'));
        return $this->formatResultList($sfConfig, $sfConfigServiceResponseList);
    }

}
