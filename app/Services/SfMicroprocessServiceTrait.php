<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\SfMicroprocess;
use App\Repositories\Requests\SfMicroprocessRepositoryRequest;
use App\Repositories\SfMicroprocessRepository;
use App\Services\Requests\SfMicroprocessServiceRequest;
use App\Services\Responses\SfMicroprocessServiceResponse;
use App\Services\Responses\SfMicroprocessServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:33
 * Time: 2022/09/14
 * Class SfMicroprocessServiceTrait
 * @package App\Services
 */
trait SfMicroprocessServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(SfMicroprocessServiceRequest $sfMicroprocessServiceRequest, SfMicroprocessRepositoryRequest $sfMicroprocessRepositoryRequest, SfMicroprocessRepository $sfMicroprocessRepository, SfMicroprocessServiceResponse $sfMicroprocessServiceResponse): SfMicroprocessServiceResponse
    {
        $sfMicroprocessRepositoryRequest = Lazy::transform($sfMicroprocessServiceRequest, $sfMicroprocessRepositoryRequest);

        $result = app()->call([$sfMicroprocessRepository, 'store'], ['sfMicroprocessRepositoryRequest' => $sfMicroprocessRepositoryRequest]);
        if ($result != null) {
            $sfMicroprocessServiceResponse->status = true;
            $sfMicroprocessServiceResponse->message = 'Store Data Success';
            $sfMicroprocessServiceResponse->sfMicroprocess = $result;
        } else {
            $sfMicroprocessServiceResponse->status = false;
            $sfMicroprocessServiceResponse->message = 'Store Data Failed';
        }

        return $sfMicroprocessServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(string $microprocessCode, SfMicroprocessServiceRequest $sfMicroprocessServiceRequest, SfMicroprocessRepositoryRequest $sfMicroprocessRepositoryRequest, SfMicroprocessRepository $sfMicroprocessRepository, SfMicroprocessServiceResponse $sfMicroprocessServiceResponse): SfMicroprocessServiceResponse
    {
        $sfMicroprocessRepositoryRequest = Lazy::transform($sfMicroprocessServiceRequest, $sfMicroprocessRepositoryRequest);

        $result = app()->call([$sfMicroprocessRepository, 'update'], ['microprocessCode' => $microprocessCode, 'sfMicroprocessRepositoryRequest' => $sfMicroprocessRepositoryRequest]);
        if ($result != null) {
            $sfMicroprocessServiceResponse->status = true;
            $sfMicroprocessServiceResponse->message = 'Update Data Success';
            $sfMicroprocessServiceResponse->sfMicroprocess = $result;
        } else {
            $sfMicroprocessServiceResponse->status = false;
            $sfMicroprocessServiceResponse->message = 'Update Data Failed';
        }

        return $sfMicroprocessServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $microprocessCode, SfMicroprocessRepository $sfMicroprocessRepository, SfMicroprocessServiceResponse $sfMicroprocessServiceResponse): SfMicroprocessServiceResponse
    {
        $status = app()->call([$sfMicroprocessRepository, 'delete'], compact('microprocessCode'));
        $sfMicroprocessServiceResponse->status = $status;
        if($status){
            $sfMicroprocessServiceResponse->message = "Delete Success";
        }else{
            $sfMicroprocessServiceResponse->message = "Delete Failed";
        }

        return $sfMicroprocessServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param SfMicroprocessServiceResponseList $sfMicroprocessServiceResponseList
     * @return SfMicroprocessServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, SfMicroprocessServiceResponseList $sfMicroprocessServiceResponseList): SfMicroprocessServiceResponseList{
        if (count($result) > 0) {
            $sfMicroprocessServiceResponseList->status = true;
            $sfMicroprocessServiceResponseList->message = 'Data Found';
            $sfMicroprocessServiceResponseList->sfMicroprocessList = $result;
            $sfMicroprocessServiceResponseList->count = $result->total();
            $sfMicroprocessServiceResponseList->countFiltered = $result->count();
        } else {
            $sfMicroprocessServiceResponseList->status = false;
            $sfMicroprocessServiceResponseList->message = 'Data Not Found';
        }
        return $sfMicroprocessServiceResponseList;
    }

    /**
     * @param SfMicroprocess|null $sfMicroprocess
     * @param SfMicroprocessServiceResponse $sfMicroprocessServiceResponse
     * @return SfMicroprocessServiceResponse
     */
    private function formatResult(?SfMicroprocess $sfMicroprocess, SfMicroprocessServiceResponse $sfMicroprocessServiceResponse): SfMicroprocessServiceResponse{
        if($sfMicroprocess == null){
            $sfMicroprocessServiceResponse->status = false;
            $sfMicroprocessServiceResponse->message = "Data Not Found";
        }else{
            $sfMicroprocessServiceResponse->status = true;
            $sfMicroprocessServiceResponse->message = "Data Found";
            $sfMicroprocessServiceResponse->sfMicroprocess = $sfMicroprocess;
        }

        return $sfMicroprocessServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(SfMicroprocessRepository $sfMicroprocessRepository, SfMicroprocessServiceResponseList $sfMicroprocessServiceResponseList, int $length = 12, string $q = null): SfMicroprocessServiceResponseList
    {
        $result = app()->call([$sfMicroprocessRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $sfMicroprocessServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(SfMicroprocessRepository $sfMicroprocessRepository, string $q = null): int
    {
        return app()->call([$sfMicroprocessRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByMicroprocessCode(string $microprocessCode, SfMicroprocessRepository $sfMicroprocessRepository, SfMicroprocessServiceResponse $sfMicroprocessServiceResponse): SfMicroprocessServiceResponse
    {
        $sfMicroprocess = app()->call([$sfMicroprocessRepository, 'getByMicroprocessCode'], compact('microprocessCode'));
        return $this->formatResult($sfMicroprocess, $sfMicroprocessServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessCodeList(string $microprocessCode, SfMicroprocessRepository $sfMicroprocessRepository, SfMicroprocessServiceResponseList $sfMicroprocessServiceResponseList, string $q = null,  int $length = 12): SfMicroprocessServiceResponseList
    {
        $sfMicroprocess = app()->call([$sfMicroprocessRepository, 'getByMicroprocessCodeList'], compact('microprocessCode', 'length', 'q'));
        return $this->formatResultList($sfMicroprocess, $sfMicroprocessServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessId(int $microprocessId, SfMicroprocessRepository $sfMicroprocessRepository, SfMicroprocessServiceResponse $sfMicroprocessServiceResponse): SfMicroprocessServiceResponse
    {
        $sfMicroprocess = app()->call([$sfMicroprocessRepository, 'getByMicroprocessId'], compact('microprocessId'));
        return $this->formatResult($sfMicroprocess, $sfMicroprocessServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessIdList(int $microprocessId, SfMicroprocessRepository $sfMicroprocessRepository, SfMicroprocessServiceResponseList $sfMicroprocessServiceResponseList, string $q = null,  int $length = 12): SfMicroprocessServiceResponseList
    {
        $sfMicroprocess = app()->call([$sfMicroprocessRepository, 'getByMicroprocessIdList'], compact('microprocessId', 'length', 'q'));
        return $this->formatResultList($sfMicroprocess, $sfMicroprocessServiceResponseList);
    }

}
