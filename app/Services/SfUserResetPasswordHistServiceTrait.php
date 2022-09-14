<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\SfUserResetPasswordHist;
use App\Repositories\Requests\SfUserResetPasswordHistRepositoryRequest;
use App\Repositories\SfUserResetPasswordHistRepository;
use App\Services\Requests\SfUserResetPasswordHistServiceRequest;
use App\Services\Responses\SfUserResetPasswordHistServiceResponse;
use App\Services\Responses\SfUserResetPasswordHistServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:43
 * Time: 2022/09/14
 * Class SfUserResetPasswordHistServiceTrait
 * @package App\Services
 */
trait SfUserResetPasswordHistServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(SfUserResetPasswordHistServiceRequest $sfUserResetPasswordHistServiceRequest, SfUserResetPasswordHistRepositoryRequest $sfUserResetPasswordHistRepositoryRequest, SfUserResetPasswordHistRepository $sfUserResetPasswordHistRepository, SfUserResetPasswordHistServiceResponse $sfUserResetPasswordHistServiceResponse): SfUserResetPasswordHistServiceResponse
    {
        $sfUserResetPasswordHistRepositoryRequest = Lazy::transform($sfUserResetPasswordHistServiceRequest, $sfUserResetPasswordHistRepositoryRequest);

        $result = app()->call([$sfUserResetPasswordHistRepository, 'store'], ['sfUserResetPasswordHistRepositoryRequest' => $sfUserResetPasswordHistRepositoryRequest]);
        if ($result != null) {
            $sfUserResetPasswordHistServiceResponse->status = true;
            $sfUserResetPasswordHistServiceResponse->message = 'Store Data Success';
            $sfUserResetPasswordHistServiceResponse->sfUserResetPasswordHist = $result;
        } else {
            $sfUserResetPasswordHistServiceResponse->status = false;
            $sfUserResetPasswordHistServiceResponse->message = 'Store Data Failed';
        }

        return $sfUserResetPasswordHistServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $userResetPasswordHistId, SfUserResetPasswordHistServiceRequest $sfUserResetPasswordHistServiceRequest, SfUserResetPasswordHistRepositoryRequest $sfUserResetPasswordHistRepositoryRequest, SfUserResetPasswordHistRepository $sfUserResetPasswordHistRepository, SfUserResetPasswordHistServiceResponse $sfUserResetPasswordHistServiceResponse): SfUserResetPasswordHistServiceResponse
    {
        $sfUserResetPasswordHistRepositoryRequest = Lazy::transform($sfUserResetPasswordHistServiceRequest, $sfUserResetPasswordHistRepositoryRequest);

        $result = app()->call([$sfUserResetPasswordHistRepository, 'update'], ['userResetPasswordHistId' => $userResetPasswordHistId, 'sfUserResetPasswordHistRepositoryRequest' => $sfUserResetPasswordHistRepositoryRequest]);
        if ($result != null) {
            $sfUserResetPasswordHistServiceResponse->status = true;
            $sfUserResetPasswordHistServiceResponse->message = 'Update Data Success';
            $sfUserResetPasswordHistServiceResponse->sfUserResetPasswordHist = $result;
        } else {
            $sfUserResetPasswordHistServiceResponse->status = false;
            $sfUserResetPasswordHistServiceResponse->message = 'Update Data Failed';
        }

        return $sfUserResetPasswordHistServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $userResetPasswordHistId, SfUserResetPasswordHistRepository $sfUserResetPasswordHistRepository, SfUserResetPasswordHistServiceResponse $sfUserResetPasswordHistServiceResponse): SfUserResetPasswordHistServiceResponse
    {
        $status = app()->call([$sfUserResetPasswordHistRepository, 'delete'], compact('userResetPasswordHistId'));
        $sfUserResetPasswordHistServiceResponse->status = $status;
        if($status){
            $sfUserResetPasswordHistServiceResponse->message = "Delete Success";
        }else{
            $sfUserResetPasswordHistServiceResponse->message = "Delete Failed";
        }

        return $sfUserResetPasswordHistServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param SfUserResetPasswordHistServiceResponseList $sfUserResetPasswordHistServiceResponseList
     * @return SfUserResetPasswordHistServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, SfUserResetPasswordHistServiceResponseList $sfUserResetPasswordHistServiceResponseList): SfUserResetPasswordHistServiceResponseList{
        if (count($result) > 0) {
            $sfUserResetPasswordHistServiceResponseList->status = true;
            $sfUserResetPasswordHistServiceResponseList->message = 'Data Found';
            $sfUserResetPasswordHistServiceResponseList->sfUserResetPasswordHistList = $result;
            $sfUserResetPasswordHistServiceResponseList->count = $result->total();
            $sfUserResetPasswordHistServiceResponseList->countFiltered = $result->count();
        } else {
            $sfUserResetPasswordHistServiceResponseList->status = false;
            $sfUserResetPasswordHistServiceResponseList->message = 'Data Not Found';
        }
        return $sfUserResetPasswordHistServiceResponseList;
    }

    /**
     * @param SfUserResetPasswordHist|null $sfUserResetPasswordHist
     * @param SfUserResetPasswordHistServiceResponse $sfUserResetPasswordHistServiceResponse
     * @return SfUserResetPasswordHistServiceResponse
     */
    private function formatResult(?SfUserResetPasswordHist $sfUserResetPasswordHist, SfUserResetPasswordHistServiceResponse $sfUserResetPasswordHistServiceResponse): SfUserResetPasswordHistServiceResponse{
        if($sfUserResetPasswordHist == null){
            $sfUserResetPasswordHistServiceResponse->status = false;
            $sfUserResetPasswordHistServiceResponse->message = "Data Not Found";
        }else{
            $sfUserResetPasswordHistServiceResponse->status = true;
            $sfUserResetPasswordHistServiceResponse->message = "Data Found";
            $sfUserResetPasswordHistServiceResponse->sfUserResetPasswordHist = $sfUserResetPasswordHist;
        }

        return $sfUserResetPasswordHistServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(SfUserResetPasswordHistRepository $sfUserResetPasswordHistRepository, SfUserResetPasswordHistServiceResponseList $sfUserResetPasswordHistServiceResponseList, int $length = 12, string $q = null): SfUserResetPasswordHistServiceResponseList
    {
        $result = app()->call([$sfUserResetPasswordHistRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $sfUserResetPasswordHistServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(SfUserResetPasswordHistRepository $sfUserResetPasswordHistRepository, string $q = null): int
    {
        return app()->call([$sfUserResetPasswordHistRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByUserResetPasswordHistId(int $userResetPasswordHistId, SfUserResetPasswordHistRepository $sfUserResetPasswordHistRepository, SfUserResetPasswordHistServiceResponse $sfUserResetPasswordHistServiceResponse): SfUserResetPasswordHistServiceResponse
    {
        $sfUserResetPasswordHist = app()->call([$sfUserResetPasswordHistRepository, 'getByUserResetPasswordHistId'], compact('userResetPasswordHistId'));
        return $this->formatResult($sfUserResetPasswordHist, $sfUserResetPasswordHistServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserResetPasswordHistIdList(int $userResetPasswordHistId, SfUserResetPasswordHistRepository $sfUserResetPasswordHistRepository, SfUserResetPasswordHistServiceResponseList $sfUserResetPasswordHistServiceResponseList, string $q = null,  int $length = 12): SfUserResetPasswordHistServiceResponseList
    {
        $sfUserResetPasswordHist = app()->call([$sfUserResetPasswordHistRepository, 'getByUserResetPasswordHistIdList'], compact('userResetPasswordHistId', 'length', 'q'));
        return $this->formatResultList($sfUserResetPasswordHist, $sfUserResetPasswordHistServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserName(string $userName, SfUserResetPasswordHistRepository $sfUserResetPasswordHistRepository, SfUserResetPasswordHistServiceResponse $sfUserResetPasswordHistServiceResponse): SfUserResetPasswordHistServiceResponse
    {
        $sfUserResetPasswordHist = app()->call([$sfUserResetPasswordHistRepository, 'getBySfUserUserName'], compact('userName'));
        return $this->formatResult($sfUserResetPasswordHist, $sfUserResetPasswordHistServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserNameList(string $userName, SfUserResetPasswordHistRepository $sfUserResetPasswordHistRepository, SfUserResetPasswordHistServiceResponseList $sfUserResetPasswordHistServiceResponseList, string $q = null,  int $length = 12): SfUserResetPasswordHistServiceResponseList
    {
        $sfUserResetPasswordHist = app()->call([$sfUserResetPasswordHistRepository, 'getBySfUserUserNameList'], compact('userName', 'length', 'q'));
        return $this->formatResultList($sfUserResetPasswordHist, $sfUserResetPasswordHistServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserId(int $userId, SfUserResetPasswordHistRepository $sfUserResetPasswordHistRepository, SfUserResetPasswordHistServiceResponse $sfUserResetPasswordHistServiceResponse): SfUserResetPasswordHistServiceResponse
    {
        $sfUserResetPasswordHist = app()->call([$sfUserResetPasswordHistRepository, 'getBySfUserUserId'], compact('userId'));
        return $this->formatResult($sfUserResetPasswordHist, $sfUserResetPasswordHistServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserIdList(int $userId, SfUserResetPasswordHistRepository $sfUserResetPasswordHistRepository, SfUserResetPasswordHistServiceResponseList $sfUserResetPasswordHistServiceResponseList, string $q = null,  int $length = 12): SfUserResetPasswordHistServiceResponseList
    {
        $sfUserResetPasswordHist = app()->call([$sfUserResetPasswordHistRepository, 'getBySfUserUserIdList'], compact('userId', 'length', 'q'));
        return $this->formatResultList($sfUserResetPasswordHist, $sfUserResetPasswordHistServiceResponseList);
    }

}
