<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\Member;
use App\Repositories\MemberRepository;
use App\Repositories\Requests\MemberRepositoryRequest;
use App\Services\Requests\MemberServiceRequest;
use App\Services\Responses\MemberServiceResponse;
use App\Services\Responses\MemberServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:09
 * Time: 2022/09/14
 * Class MemberServiceTrait
 * @package App\Services
 */
trait MemberServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(MemberServiceRequest $memberServiceRequest, MemberRepositoryRequest $memberRepositoryRequest, MemberRepository $memberRepository, MemberServiceResponse $memberServiceResponse): MemberServiceResponse
    {
        $memberRepositoryRequest = Lazy::transform($memberServiceRequest, $memberRepositoryRequest);

        $result = app()->call([$memberRepository, 'store'], ['memberRepositoryRequest' => $memberRepositoryRequest]);
        if ($result != null) {
            $memberServiceResponse->status = true;
            $memberServiceResponse->message = 'Store Data Success';
            $memberServiceResponse->member = $result;
        } else {
            $memberServiceResponse->status = false;
            $memberServiceResponse->message = 'Store Data Failed';
        }

        return $memberServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $memberId, MemberServiceRequest $memberServiceRequest, MemberRepositoryRequest $memberRepositoryRequest, MemberRepository $memberRepository, MemberServiceResponse $memberServiceResponse): MemberServiceResponse
    {
        $memberRepositoryRequest = Lazy::transform($memberServiceRequest, $memberRepositoryRequest);

        $result = app()->call([$memberRepository, 'update'], ['memberId' => $memberId, 'memberRepositoryRequest' => $memberRepositoryRequest]);
        if ($result != null) {
            $memberServiceResponse->status = true;
            $memberServiceResponse->message = 'Update Data Success';
            $memberServiceResponse->member = $result;
        } else {
            $memberServiceResponse->status = false;
            $memberServiceResponse->message = 'Update Data Failed';
        }

        return $memberServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $memberId, MemberRepository $memberRepository, MemberServiceResponse $memberServiceResponse): MemberServiceResponse
    {
        $status = app()->call([$memberRepository, 'delete'], compact('memberId'));
        $memberServiceResponse->status = $status;
        if($status){
            $memberServiceResponse->message = "Delete Success";
        }else{
            $memberServiceResponse->message = "Delete Failed";
        }

        return $memberServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param MemberServiceResponseList $memberServiceResponseList
     * @return MemberServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, MemberServiceResponseList $memberServiceResponseList): MemberServiceResponseList{
        if (count($result) > 0) {
            $memberServiceResponseList->status = true;
            $memberServiceResponseList->message = 'Data Found';
            $memberServiceResponseList->memberList = $result;
            $memberServiceResponseList->count = $result->total();
            $memberServiceResponseList->countFiltered = $result->count();
        } else {
            $memberServiceResponseList->status = false;
            $memberServiceResponseList->message = 'Data Not Found';
        }
        return $memberServiceResponseList;
    }

    /**
     * @param Member|null $member
     * @param MemberServiceResponse $memberServiceResponse
     * @return MemberServiceResponse
     */
    private function formatResult(?Member $member, MemberServiceResponse $memberServiceResponse): MemberServiceResponse{
        if($member == null){
            $memberServiceResponse->status = false;
            $memberServiceResponse->message = "Data Not Found";
        }else{
            $memberServiceResponse->status = true;
            $memberServiceResponse->message = "Data Found";
            $memberServiceResponse->member = $member;
        }

        return $memberServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(MemberRepository $memberRepository, MemberServiceResponseList $memberServiceResponseList, int $length = 12, string $q = null): MemberServiceResponseList
    {
        $result = app()->call([$memberRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $memberServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(MemberRepository $memberRepository, string $q = null): int
    {
        return app()->call([$memberRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByMemberId(int $memberId, MemberRepository $memberRepository, MemberServiceResponse $memberServiceResponse): MemberServiceResponse
    {
        $member = app()->call([$memberRepository, 'getByMemberId'], compact('memberId'));
        return $this->formatResult($member, $memberServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByMemberIdList(int $memberId, MemberRepository $memberRepository, MemberServiceResponseList $memberServiceResponseList, string $q = null,  int $length = 12): MemberServiceResponseList
    {
        $member = app()->call([$memberRepository, 'getByMemberIdList'], compact('memberId', 'length', 'q'));
        return $this->formatResultList($member, $memberServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByImageImageId(int $imageId, MemberRepository $memberRepository, MemberServiceResponse $memberServiceResponse): MemberServiceResponse
    {
        $member = app()->call([$memberRepository, 'getByImageImageId'], compact('imageId'));
        return $this->formatResult($member, $memberServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByImageImageIdList(int $imageId, MemberRepository $memberRepository, MemberServiceResponseList $memberServiceResponseList, string $q = null,  int $length = 12): MemberServiceResponseList
    {
        $member = app()->call([$memberRepository, 'getByImageImageIdList'], compact('imageId', 'length', 'q'));
        return $this->formatResultList($member, $memberServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserName(string $userName, MemberRepository $memberRepository, MemberServiceResponse $memberServiceResponse): MemberServiceResponse
    {
        $member = app()->call([$memberRepository, 'getBySfUserUserName'], compact('userName'));
        return $this->formatResult($member, $memberServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserNameList(string $userName, MemberRepository $memberRepository, MemberServiceResponseList $memberServiceResponseList, string $q = null,  int $length = 12): MemberServiceResponseList
    {
        $member = app()->call([$memberRepository, 'getBySfUserUserNameList'], compact('userName', 'length', 'q'));
        return $this->formatResultList($member, $memberServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserId(int $userId, MemberRepository $memberRepository, MemberServiceResponse $memberServiceResponse): MemberServiceResponse
    {
        $member = app()->call([$memberRepository, 'getBySfUserUserId'], compact('userId'));
        return $this->formatResult($member, $memberServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserIdList(int $userId, MemberRepository $memberRepository, MemberServiceResponseList $memberServiceResponseList, string $q = null,  int $length = 12): MemberServiceResponseList
    {
        $member = app()->call([$memberRepository, 'getBySfUserUserIdList'], compact('userId', 'length', 'q'));
        return $this->formatResultList($member, $memberServiceResponseList);
    }

}
