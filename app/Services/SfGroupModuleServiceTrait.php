<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\SfGroupModule;
use App\Repositories\Requests\SfGroupModuleRepositoryRequest;
use App\Repositories\SfGroupModuleRepository;
use App\Services\Requests\SfGroupModuleServiceRequest;
use App\Services\Responses\SfGroupModuleServiceResponse;
use App\Services\Responses\SfGroupModuleServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:27
 * Time: 2022/09/14
 * Class SfGroupModuleServiceTrait
 * @package App\Services
 */
trait SfGroupModuleServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(SfGroupModuleServiceRequest $sfGroupModuleServiceRequest, SfGroupModuleRepositoryRequest $sfGroupModuleRepositoryRequest, SfGroupModuleRepository $sfGroupModuleRepository, SfGroupModuleServiceResponse $sfGroupModuleServiceResponse): SfGroupModuleServiceResponse
    {
        $sfGroupModuleRepositoryRequest = Lazy::transform($sfGroupModuleServiceRequest, $sfGroupModuleRepositoryRequest);

        $result = app()->call([$sfGroupModuleRepository, 'store'], ['sfGroupModuleRepositoryRequest' => $sfGroupModuleRepositoryRequest]);
        if ($result != null) {
            $sfGroupModuleServiceResponse->status = true;
            $sfGroupModuleServiceResponse->message = 'Store Data Success';
            $sfGroupModuleServiceResponse->sfGroupModule = $result;
        } else {
            $sfGroupModuleServiceResponse->status = false;
            $sfGroupModuleServiceResponse->message = 'Store Data Failed';
        }

        return $sfGroupModuleServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $groupModId, SfGroupModuleServiceRequest $sfGroupModuleServiceRequest, SfGroupModuleRepositoryRequest $sfGroupModuleRepositoryRequest, SfGroupModuleRepository $sfGroupModuleRepository, SfGroupModuleServiceResponse $sfGroupModuleServiceResponse): SfGroupModuleServiceResponse
    {
        $sfGroupModuleRepositoryRequest = Lazy::transform($sfGroupModuleServiceRequest, $sfGroupModuleRepositoryRequest);

        $result = app()->call([$sfGroupModuleRepository, 'update'], ['groupModId' => $groupModId, 'sfGroupModuleRepositoryRequest' => $sfGroupModuleRepositoryRequest]);
        if ($result != null) {
            $sfGroupModuleServiceResponse->status = true;
            $sfGroupModuleServiceResponse->message = 'Update Data Success';
            $sfGroupModuleServiceResponse->sfGroupModule = $result;
        } else {
            $sfGroupModuleServiceResponse->status = false;
            $sfGroupModuleServiceResponse->message = 'Update Data Failed';
        }

        return $sfGroupModuleServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $groupModId, SfGroupModuleRepository $sfGroupModuleRepository, SfGroupModuleServiceResponse $sfGroupModuleServiceResponse): SfGroupModuleServiceResponse
    {
        $status = app()->call([$sfGroupModuleRepository, 'delete'], compact('groupModId'));
        $sfGroupModuleServiceResponse->status = $status;
        if($status){
            $sfGroupModuleServiceResponse->message = "Delete Success";
        }else{
            $sfGroupModuleServiceResponse->message = "Delete Failed";
        }

        return $sfGroupModuleServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param SfGroupModuleServiceResponseList $sfGroupModuleServiceResponseList
     * @return SfGroupModuleServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, SfGroupModuleServiceResponseList $sfGroupModuleServiceResponseList): SfGroupModuleServiceResponseList{
        if (count($result) > 0) {
            $sfGroupModuleServiceResponseList->status = true;
            $sfGroupModuleServiceResponseList->message = 'Data Found';
            $sfGroupModuleServiceResponseList->sfGroupModuleList = $result;
            $sfGroupModuleServiceResponseList->count = $result->total();
            $sfGroupModuleServiceResponseList->countFiltered = $result->count();
        } else {
            $sfGroupModuleServiceResponseList->status = false;
            $sfGroupModuleServiceResponseList->message = 'Data Not Found';
        }
        return $sfGroupModuleServiceResponseList;
    }

    /**
     * @param SfGroupModule|null $sfGroupModule
     * @param SfGroupModuleServiceResponse $sfGroupModuleServiceResponse
     * @return SfGroupModuleServiceResponse
     */
    private function formatResult(?SfGroupModule $sfGroupModule, SfGroupModuleServiceResponse $sfGroupModuleServiceResponse): SfGroupModuleServiceResponse{
        if($sfGroupModule == null){
            $sfGroupModuleServiceResponse->status = false;
            $sfGroupModuleServiceResponse->message = "Data Not Found";
        }else{
            $sfGroupModuleServiceResponse->status = true;
            $sfGroupModuleServiceResponse->message = "Data Found";
            $sfGroupModuleServiceResponse->sfGroupModule = $sfGroupModule;
        }

        return $sfGroupModuleServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(SfGroupModuleRepository $sfGroupModuleRepository, SfGroupModuleServiceResponseList $sfGroupModuleServiceResponseList, int $length = 12, string $q = null): SfGroupModuleServiceResponseList
    {
        $result = app()->call([$sfGroupModuleRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $sfGroupModuleServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(SfGroupModuleRepository $sfGroupModuleRepository, string $q = null): int
    {
        return app()->call([$sfGroupModuleRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByGroupModId(int $groupModId, SfGroupModuleRepository $sfGroupModuleRepository, SfGroupModuleServiceResponse $sfGroupModuleServiceResponse): SfGroupModuleServiceResponse
    {
        $sfGroupModule = app()->call([$sfGroupModuleRepository, 'getByGroupModId'], compact('groupModId'));
        return $this->formatResult($sfGroupModule, $sfGroupModuleServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByGroupModIdList(int $groupModId, SfGroupModuleRepository $sfGroupModuleRepository, SfGroupModuleServiceResponseList $sfGroupModuleServiceResponseList, string $q = null,  int $length = 12): SfGroupModuleServiceResponseList
    {
        $sfGroupModule = app()->call([$sfGroupModuleRepository, 'getByGroupModIdList'], compact('groupModId', 'length', 'q'));
        return $this->formatResultList($sfGroupModule, $sfGroupModuleServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfGroupGroupId(int $groupId, SfGroupModuleRepository $sfGroupModuleRepository, SfGroupModuleServiceResponse $sfGroupModuleServiceResponse): SfGroupModuleServiceResponse
    {
        $sfGroupModule = app()->call([$sfGroupModuleRepository, 'getBySfGroupGroupId'], compact('groupId'));
        return $this->formatResult($sfGroupModule, $sfGroupModuleServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfGroupGroupIdList(int $groupId, SfGroupModuleRepository $sfGroupModuleRepository, SfGroupModuleServiceResponseList $sfGroupModuleServiceResponseList, string $q = null,  int $length = 12): SfGroupModuleServiceResponseList
    {
        $sfGroupModule = app()->call([$sfGroupModuleRepository, 'getBySfGroupGroupIdList'], compact('groupId', 'length', 'q'));
        return $this->formatResultList($sfGroupModule, $sfGroupModuleServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfModuleModuleCode(string $moduleCode, SfGroupModuleRepository $sfGroupModuleRepository, SfGroupModuleServiceResponse $sfGroupModuleServiceResponse): SfGroupModuleServiceResponse
    {
        $sfGroupModule = app()->call([$sfGroupModuleRepository, 'getBySfModuleModuleCode'], compact('moduleCode'));
        return $this->formatResult($sfGroupModule, $sfGroupModuleServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfModuleModuleCodeList(string $moduleCode, SfGroupModuleRepository $sfGroupModuleRepository, SfGroupModuleServiceResponseList $sfGroupModuleServiceResponseList, string $q = null,  int $length = 12): SfGroupModuleServiceResponseList
    {
        $sfGroupModule = app()->call([$sfGroupModuleRepository, 'getBySfModuleModuleCodeList'], compact('moduleCode', 'length', 'q'));
        return $this->formatResultList($sfGroupModule, $sfGroupModuleServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfModuleModuleId(int $moduleId, SfGroupModuleRepository $sfGroupModuleRepository, SfGroupModuleServiceResponse $sfGroupModuleServiceResponse): SfGroupModuleServiceResponse
    {
        $sfGroupModule = app()->call([$sfGroupModuleRepository, 'getBySfModuleModuleId'], compact('moduleId'));
        return $this->formatResult($sfGroupModule, $sfGroupModuleServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfModuleModuleIdList(int $moduleId, SfGroupModuleRepository $sfGroupModuleRepository, SfGroupModuleServiceResponseList $sfGroupModuleServiceResponseList, string $q = null,  int $length = 12): SfGroupModuleServiceResponseList
    {
        $sfGroupModule = app()->call([$sfGroupModuleRepository, 'getBySfModuleModuleIdList'], compact('moduleId', 'length', 'q'));
        return $this->formatResultList($sfGroupModule, $sfGroupModuleServiceResponseList);
    }

}
