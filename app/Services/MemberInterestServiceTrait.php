<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\MemberInterest;
use App\Repositories\MemberInterestRepository;
use App\Repositories\Requests\MemberInterestRepositoryRequest;
use App\Services\Requests\MemberInterestServiceRequest;
use App\Services\Responses\MemberInterestServiceResponse;
use App\Services\Responses\MemberInterestServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:11
 * Time: 2022/09/14
 * Class MemberInterestServiceTrait
 * @package App\Services
 */
trait MemberInterestServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(MemberInterestServiceRequest $memberInterestServiceRequest, MemberInterestRepositoryRequest $memberInterestRepositoryRequest, MemberInterestRepository $memberInterestRepository, MemberInterestServiceResponse $memberInterestServiceResponse): MemberInterestServiceResponse
    {
        $memberInterestRepositoryRequest = Lazy::transform($memberInterestServiceRequest, $memberInterestRepositoryRequest);

        $result = app()->call([$memberInterestRepository, 'store'], ['memberInterestRepositoryRequest' => $memberInterestRepositoryRequest]);
        if ($result != null) {
            $memberInterestServiceResponse->status = true;
            $memberInterestServiceResponse->message = 'Store Data Success';
            $memberInterestServiceResponse->memberInterest = $result;
        } else {
            $memberInterestServiceResponse->status = false;
            $memberInterestServiceResponse->message = 'Store Data Failed';
        }

        return $memberInterestServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $memberInterestId, MemberInterestServiceRequest $memberInterestServiceRequest, MemberInterestRepositoryRequest $memberInterestRepositoryRequest, MemberInterestRepository $memberInterestRepository, MemberInterestServiceResponse $memberInterestServiceResponse): MemberInterestServiceResponse
    {
        $memberInterestRepositoryRequest = Lazy::transform($memberInterestServiceRequest, $memberInterestRepositoryRequest);

        $result = app()->call([$memberInterestRepository, 'update'], ['memberInterestId' => $memberInterestId, 'memberInterestRepositoryRequest' => $memberInterestRepositoryRequest]);
        if ($result != null) {
            $memberInterestServiceResponse->status = true;
            $memberInterestServiceResponse->message = 'Update Data Success';
            $memberInterestServiceResponse->memberInterest = $result;
        } else {
            $memberInterestServiceResponse->status = false;
            $memberInterestServiceResponse->message = 'Update Data Failed';
        }

        return $memberInterestServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $memberInterestId, MemberInterestRepository $memberInterestRepository, MemberInterestServiceResponse $memberInterestServiceResponse): MemberInterestServiceResponse
    {
        $status = app()->call([$memberInterestRepository, 'delete'], compact('memberInterestId'));
        $memberInterestServiceResponse->status = $status;
        if($status){
            $memberInterestServiceResponse->message = "Delete Success";
        }else{
            $memberInterestServiceResponse->message = "Delete Failed";
        }

        return $memberInterestServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param MemberInterestServiceResponseList $memberInterestServiceResponseList
     * @return MemberInterestServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, MemberInterestServiceResponseList $memberInterestServiceResponseList): MemberInterestServiceResponseList{
        if (count($result) > 0) {
            $memberInterestServiceResponseList->status = true;
            $memberInterestServiceResponseList->message = 'Data Found';
            $memberInterestServiceResponseList->memberInterestList = $result;
            $memberInterestServiceResponseList->count = $result->total();
            $memberInterestServiceResponseList->countFiltered = $result->count();
        } else {
            $memberInterestServiceResponseList->status = false;
            $memberInterestServiceResponseList->message = 'Data Not Found';
        }
        return $memberInterestServiceResponseList;
    }

    /**
     * @param MemberInterest|null $memberInterest
     * @param MemberInterestServiceResponse $memberInterestServiceResponse
     * @return MemberInterestServiceResponse
     */
    private function formatResult(?MemberInterest $memberInterest, MemberInterestServiceResponse $memberInterestServiceResponse): MemberInterestServiceResponse{
        if($memberInterest == null){
            $memberInterestServiceResponse->status = false;
            $memberInterestServiceResponse->message = "Data Not Found";
        }else{
            $memberInterestServiceResponse->status = true;
            $memberInterestServiceResponse->message = "Data Found";
            $memberInterestServiceResponse->memberInterest = $memberInterest;
        }

        return $memberInterestServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(MemberInterestRepository $memberInterestRepository, MemberInterestServiceResponseList $memberInterestServiceResponseList, int $length = 12, string $q = null): MemberInterestServiceResponseList
    {
        $result = app()->call([$memberInterestRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $memberInterestServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(MemberInterestRepository $memberInterestRepository, string $q = null): int
    {
        return app()->call([$memberInterestRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByMemberInterestId(int $memberInterestId, MemberInterestRepository $memberInterestRepository, MemberInterestServiceResponse $memberInterestServiceResponse): MemberInterestServiceResponse
    {
        $memberInterest = app()->call([$memberInterestRepository, 'getByMemberInterestId'], compact('memberInterestId'));
        return $this->formatResult($memberInterest, $memberInterestServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByMemberInterestIdList(int $memberInterestId, MemberInterestRepository $memberInterestRepository, MemberInterestServiceResponseList $memberInterestServiceResponseList, string $q = null,  int $length = 12): MemberInterestServiceResponseList
    {
        $memberInterest = app()->call([$memberInterestRepository, 'getByMemberInterestIdList'], compact('memberInterestId', 'length', 'q'));
        return $this->formatResultList($memberInterest, $memberInterestServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByCategoryRefCategoryId(int $categoryId, MemberInterestRepository $memberInterestRepository, MemberInterestServiceResponse $memberInterestServiceResponse): MemberInterestServiceResponse
    {
        $memberInterest = app()->call([$memberInterestRepository, 'getByCategoryRefCategoryId'], compact('categoryId'));
        return $this->formatResult($memberInterest, $memberInterestServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByCategoryRefCategoryIdList(int $categoryId, MemberInterestRepository $memberInterestRepository, MemberInterestServiceResponseList $memberInterestServiceResponseList, string $q = null,  int $length = 12): MemberInterestServiceResponseList
    {
        $memberInterest = app()->call([$memberInterestRepository, 'getByCategoryRefCategoryIdList'], compact('categoryId', 'length', 'q'));
        return $this->formatResultList($memberInterest, $memberInterestServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByMemberMemberId(int $memberId, MemberInterestRepository $memberInterestRepository, MemberInterestServiceResponse $memberInterestServiceResponse): MemberInterestServiceResponse
    {
        $memberInterest = app()->call([$memberInterestRepository, 'getByMemberMemberId'], compact('memberId'));
        return $this->formatResult($memberInterest, $memberInterestServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByMemberMemberIdList(int $memberId, MemberInterestRepository $memberInterestRepository, MemberInterestServiceResponseList $memberInterestServiceResponseList, string $q = null,  int $length = 12): MemberInterestServiceResponseList
    {
        $memberInterest = app()->call([$memberInterestRepository, 'getByMemberMemberIdList'], compact('memberId', 'length', 'q'));
        return $this->formatResultList($memberInterest, $memberInterestServiceResponseList);
    }

}
