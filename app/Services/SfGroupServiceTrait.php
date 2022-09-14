<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\SfGroup;
use App\Repositories\Requests\SfGroupRepositoryRequest;
use App\Repositories\SfGroupRepository;
use App\Services\Requests\SfGroupServiceRequest;
use App\Services\Responses\SfGroupServiceResponse;
use App\Services\Responses\SfGroupServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:25
 * Time: 2022/09/14
 * Class SfGroupServiceTrait
 * @package App\Services
 */
trait SfGroupServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(SfGroupServiceRequest $sfGroupServiceRequest, SfGroupRepositoryRequest $sfGroupRepositoryRequest, SfGroupRepository $sfGroupRepository, SfGroupServiceResponse $sfGroupServiceResponse): SfGroupServiceResponse
    {
        $sfGroupRepositoryRequest = Lazy::transform($sfGroupServiceRequest, $sfGroupRepositoryRequest);

        $result = app()->call([$sfGroupRepository, 'store'], ['sfGroupRepositoryRequest' => $sfGroupRepositoryRequest]);
        if ($result != null) {
            $sfGroupServiceResponse->status = true;
            $sfGroupServiceResponse->message = 'Store Data Success';
            $sfGroupServiceResponse->sfGroup = $result;
        } else {
            $sfGroupServiceResponse->status = false;
            $sfGroupServiceResponse->message = 'Store Data Failed';
        }

        return $sfGroupServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $groupId, SfGroupServiceRequest $sfGroupServiceRequest, SfGroupRepositoryRequest $sfGroupRepositoryRequest, SfGroupRepository $sfGroupRepository, SfGroupServiceResponse $sfGroupServiceResponse): SfGroupServiceResponse
    {
        $sfGroupRepositoryRequest = Lazy::transform($sfGroupServiceRequest, $sfGroupRepositoryRequest);

        $result = app()->call([$sfGroupRepository, 'update'], ['groupId' => $groupId, 'sfGroupRepositoryRequest' => $sfGroupRepositoryRequest]);
        if ($result != null) {
            $sfGroupServiceResponse->status = true;
            $sfGroupServiceResponse->message = 'Update Data Success';
            $sfGroupServiceResponse->sfGroup = $result;
        } else {
            $sfGroupServiceResponse->status = false;
            $sfGroupServiceResponse->message = 'Update Data Failed';
        }

        return $sfGroupServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $groupId, SfGroupRepository $sfGroupRepository, SfGroupServiceResponse $sfGroupServiceResponse): SfGroupServiceResponse
    {
        $status = app()->call([$sfGroupRepository, 'delete'], compact('groupId'));
        $sfGroupServiceResponse->status = $status;
        if($status){
            $sfGroupServiceResponse->message = "Delete Success";
        }else{
            $sfGroupServiceResponse->message = "Delete Failed";
        }

        return $sfGroupServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param SfGroupServiceResponseList $sfGroupServiceResponseList
     * @return SfGroupServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, SfGroupServiceResponseList $sfGroupServiceResponseList): SfGroupServiceResponseList{
        if (count($result) > 0) {
            $sfGroupServiceResponseList->status = true;
            $sfGroupServiceResponseList->message = 'Data Found';
            $sfGroupServiceResponseList->sfGroupList = $result;
            $sfGroupServiceResponseList->count = $result->total();
            $sfGroupServiceResponseList->countFiltered = $result->count();
        } else {
            $sfGroupServiceResponseList->status = false;
            $sfGroupServiceResponseList->message = 'Data Not Found';
        }
        return $sfGroupServiceResponseList;
    }

    /**
     * @param SfGroup|null $sfGroup
     * @param SfGroupServiceResponse $sfGroupServiceResponse
     * @return SfGroupServiceResponse
     */
    private function formatResult(?SfGroup $sfGroup, SfGroupServiceResponse $sfGroupServiceResponse): SfGroupServiceResponse{
        if($sfGroup == null){
            $sfGroupServiceResponse->status = false;
            $sfGroupServiceResponse->message = "Data Not Found";
        }else{
            $sfGroupServiceResponse->status = true;
            $sfGroupServiceResponse->message = "Data Found";
            $sfGroupServiceResponse->sfGroup = $sfGroup;
        }

        return $sfGroupServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(SfGroupRepository $sfGroupRepository, SfGroupServiceResponseList $sfGroupServiceResponseList, int $length = 12, string $q = null): SfGroupServiceResponseList
    {
        $result = app()->call([$sfGroupRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $sfGroupServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(SfGroupRepository $sfGroupRepository, string $q = null): int
    {
        return app()->call([$sfGroupRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByGroupId(int $groupId, SfGroupRepository $sfGroupRepository, SfGroupServiceResponse $sfGroupServiceResponse): SfGroupServiceResponse
    {
        $sfGroup = app()->call([$sfGroupRepository, 'getByGroupId'], compact('groupId'));
        return $this->formatResult($sfGroup, $sfGroupServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByGroupIdList(int $groupId, SfGroupRepository $sfGroupRepository, SfGroupServiceResponseList $sfGroupServiceResponseList, string $q = null,  int $length = 12): SfGroupServiceResponseList
    {
        $sfGroup = app()->call([$sfGroupRepository, 'getByGroupIdList'], compact('groupId', 'length', 'q'));
        return $this->formatResultList($sfGroup, $sfGroupServiceResponseList);
    }

}
