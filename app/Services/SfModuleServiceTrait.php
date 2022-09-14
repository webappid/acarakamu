<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\SfModule;
use App\Repositories\Requests\SfModuleRepositoryRequest;
use App\Repositories\SfModuleRepository;
use App\Services\Requests\SfModuleServiceRequest;
use App\Services\Responses\SfModuleServiceResponse;
use App\Services\Responses\SfModuleServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:40
 * Time: 2022/09/14
 * Class SfModuleServiceTrait
 * @package App\Services
 */
trait SfModuleServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(SfModuleServiceRequest $sfModuleServiceRequest, SfModuleRepositoryRequest $sfModuleRepositoryRequest, SfModuleRepository $sfModuleRepository, SfModuleServiceResponse $sfModuleServiceResponse): SfModuleServiceResponse
    {
        $sfModuleRepositoryRequest = Lazy::transform($sfModuleServiceRequest, $sfModuleRepositoryRequest);

        $result = app()->call([$sfModuleRepository, 'store'], ['sfModuleRepositoryRequest' => $sfModuleRepositoryRequest]);
        if ($result != null) {
            $sfModuleServiceResponse->status = true;
            $sfModuleServiceResponse->message = 'Store Data Success';
            $sfModuleServiceResponse->sfModule = $result;
        } else {
            $sfModuleServiceResponse->status = false;
            $sfModuleServiceResponse->message = 'Store Data Failed';
        }

        return $sfModuleServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(string $moduleCode, SfModuleServiceRequest $sfModuleServiceRequest, SfModuleRepositoryRequest $sfModuleRepositoryRequest, SfModuleRepository $sfModuleRepository, SfModuleServiceResponse $sfModuleServiceResponse): SfModuleServiceResponse
    {
        $sfModuleRepositoryRequest = Lazy::transform($sfModuleServiceRequest, $sfModuleRepositoryRequest);

        $result = app()->call([$sfModuleRepository, 'update'], ['moduleCode' => $moduleCode, 'sfModuleRepositoryRequest' => $sfModuleRepositoryRequest]);
        if ($result != null) {
            $sfModuleServiceResponse->status = true;
            $sfModuleServiceResponse->message = 'Update Data Success';
            $sfModuleServiceResponse->sfModule = $result;
        } else {
            $sfModuleServiceResponse->status = false;
            $sfModuleServiceResponse->message = 'Update Data Failed';
        }

        return $sfModuleServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $moduleCode, SfModuleRepository $sfModuleRepository, SfModuleServiceResponse $sfModuleServiceResponse): SfModuleServiceResponse
    {
        $status = app()->call([$sfModuleRepository, 'delete'], compact('moduleCode'));
        $sfModuleServiceResponse->status = $status;
        if($status){
            $sfModuleServiceResponse->message = "Delete Success";
        }else{
            $sfModuleServiceResponse->message = "Delete Failed";
        }

        return $sfModuleServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param SfModuleServiceResponseList $sfModuleServiceResponseList
     * @return SfModuleServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, SfModuleServiceResponseList $sfModuleServiceResponseList): SfModuleServiceResponseList{
        if (count($result) > 0) {
            $sfModuleServiceResponseList->status = true;
            $sfModuleServiceResponseList->message = 'Data Found';
            $sfModuleServiceResponseList->sfModuleList = $result;
            $sfModuleServiceResponseList->count = $result->total();
            $sfModuleServiceResponseList->countFiltered = $result->count();
        } else {
            $sfModuleServiceResponseList->status = false;
            $sfModuleServiceResponseList->message = 'Data Not Found';
        }
        return $sfModuleServiceResponseList;
    }

    /**
     * @param SfModule|null $sfModule
     * @param SfModuleServiceResponse $sfModuleServiceResponse
     * @return SfModuleServiceResponse
     */
    private function formatResult(?SfModule $sfModule, SfModuleServiceResponse $sfModuleServiceResponse): SfModuleServiceResponse{
        if($sfModule == null){
            $sfModuleServiceResponse->status = false;
            $sfModuleServiceResponse->message = "Data Not Found";
        }else{
            $sfModuleServiceResponse->status = true;
            $sfModuleServiceResponse->message = "Data Found";
            $sfModuleServiceResponse->sfModule = $sfModule;
        }

        return $sfModuleServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(SfModuleRepository $sfModuleRepository, SfModuleServiceResponseList $sfModuleServiceResponseList, int $length = 12, string $q = null): SfModuleServiceResponseList
    {
        $result = app()->call([$sfModuleRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $sfModuleServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(SfModuleRepository $sfModuleRepository, string $q = null): int
    {
        return app()->call([$sfModuleRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByModuleCode(string $moduleCode, SfModuleRepository $sfModuleRepository, SfModuleServiceResponse $sfModuleServiceResponse): SfModuleServiceResponse
    {
        $sfModule = app()->call([$sfModuleRepository, 'getByModuleCode'], compact('moduleCode'));
        return $this->formatResult($sfModule, $sfModuleServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByModuleCodeList(string $moduleCode, SfModuleRepository $sfModuleRepository, SfModuleServiceResponseList $sfModuleServiceResponseList, string $q = null,  int $length = 12): SfModuleServiceResponseList
    {
        $sfModule = app()->call([$sfModuleRepository, 'getByModuleCodeList'], compact('moduleCode', 'length', 'q'));
        return $this->formatResultList($sfModule, $sfModuleServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByModuleId(int $moduleId, SfModuleRepository $sfModuleRepository, SfModuleServiceResponse $sfModuleServiceResponse): SfModuleServiceResponse
    {
        $sfModule = app()->call([$sfModuleRepository, 'getByModuleId'], compact('moduleId'));
        return $this->formatResult($sfModule, $sfModuleServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByModuleIdList(int $moduleId, SfModuleRepository $sfModuleRepository, SfModuleServiceResponseList $sfModuleServiceResponseList, string $q = null,  int $length = 12): SfModuleServiceResponseList
    {
        $sfModule = app()->call([$sfModuleRepository, 'getByModuleIdList'], compact('moduleId', 'length', 'q'));
        return $this->formatResultList($sfModule, $sfModuleServiceResponseList);
    }

}
