<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\FailedJob;
use App\Repositories\FailedJobRepository;
use App\Repositories\Requests\FailedJobRepositoryRequest;
use App\Services\Requests\FailedJobServiceRequest;
use App\Services\Responses\FailedJobServiceResponse;
use App\Services\Responses\FailedJobServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:07
 * Time: 2022/09/14
 * Class FailedJobServiceTrait
 * @package App\Services
 */
trait FailedJobServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(FailedJobServiceRequest $failedJobServiceRequest, FailedJobRepositoryRequest $failedJobRepositoryRequest, FailedJobRepository $failedJobRepository, FailedJobServiceResponse $failedJobServiceResponse): FailedJobServiceResponse
    {
        $failedJobRepositoryRequest = Lazy::transform($failedJobServiceRequest, $failedJobRepositoryRequest);

        $result = app()->call([$failedJobRepository, 'store'], ['failedJobRepositoryRequest' => $failedJobRepositoryRequest]);
        if ($result != null) {
            $failedJobServiceResponse->status = true;
            $failedJobServiceResponse->message = 'Store Data Success';
            $failedJobServiceResponse->failedJob = $result;
        } else {
            $failedJobServiceResponse->status = false;
            $failedJobServiceResponse->message = 'Store Data Failed';
        }

        return $failedJobServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(string $uuid, FailedJobServiceRequest $failedJobServiceRequest, FailedJobRepositoryRequest $failedJobRepositoryRequest, FailedJobRepository $failedJobRepository, FailedJobServiceResponse $failedJobServiceResponse): FailedJobServiceResponse
    {
        $failedJobRepositoryRequest = Lazy::transform($failedJobServiceRequest, $failedJobRepositoryRequest);

        $result = app()->call([$failedJobRepository, 'update'], ['uuid' => $uuid, 'failedJobRepositoryRequest' => $failedJobRepositoryRequest]);
        if ($result != null) {
            $failedJobServiceResponse->status = true;
            $failedJobServiceResponse->message = 'Update Data Success';
            $failedJobServiceResponse->failedJob = $result;
        } else {
            $failedJobServiceResponse->status = false;
            $failedJobServiceResponse->message = 'Update Data Failed';
        }

        return $failedJobServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $uuid, FailedJobRepository $failedJobRepository, FailedJobServiceResponse $failedJobServiceResponse): FailedJobServiceResponse
    {
        $status = app()->call([$failedJobRepository, 'delete'], compact('uuid'));
        $failedJobServiceResponse->status = $status;
        if($status){
            $failedJobServiceResponse->message = "Delete Success";
        }else{
            $failedJobServiceResponse->message = "Delete Failed";
        }

        return $failedJobServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param FailedJobServiceResponseList $failedJobServiceResponseList
     * @return FailedJobServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, FailedJobServiceResponseList $failedJobServiceResponseList): FailedJobServiceResponseList{
        if (count($result) > 0) {
            $failedJobServiceResponseList->status = true;
            $failedJobServiceResponseList->message = 'Data Found';
            $failedJobServiceResponseList->failedJobList = $result;
            $failedJobServiceResponseList->count = $result->total();
            $failedJobServiceResponseList->countFiltered = $result->count();
        } else {
            $failedJobServiceResponseList->status = false;
            $failedJobServiceResponseList->message = 'Data Not Found';
        }
        return $failedJobServiceResponseList;
    }

    /**
     * @param FailedJob|null $failedJob
     * @param FailedJobServiceResponse $failedJobServiceResponse
     * @return FailedJobServiceResponse
     */
    private function formatResult(?FailedJob $failedJob, FailedJobServiceResponse $failedJobServiceResponse): FailedJobServiceResponse{
        if($failedJob == null){
            $failedJobServiceResponse->status = false;
            $failedJobServiceResponse->message = "Data Not Found";
        }else{
            $failedJobServiceResponse->status = true;
            $failedJobServiceResponse->message = "Data Found";
            $failedJobServiceResponse->failedJob = $failedJob;
        }

        return $failedJobServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(FailedJobRepository $failedJobRepository, FailedJobServiceResponseList $failedJobServiceResponseList, int $length = 12, string $q = null): FailedJobServiceResponseList
    {
        $result = app()->call([$failedJobRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $failedJobServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(FailedJobRepository $failedJobRepository, string $q = null): int
    {
        return app()->call([$failedJobRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByUuid(string $uuid, FailedJobRepository $failedJobRepository, FailedJobServiceResponse $failedJobServiceResponse): FailedJobServiceResponse
    {
        $failedJob = app()->call([$failedJobRepository, 'getByUuid'], compact('uuid'));
        return $this->formatResult($failedJob, $failedJobServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUuidList(string $uuid, FailedJobRepository $failedJobRepository, FailedJobServiceResponseList $failedJobServiceResponseList, string $q = null,  int $length = 12): FailedJobServiceResponseList
    {
        $failedJob = app()->call([$failedJobRepository, 'getByUuidList'], compact('uuid', 'length', 'q'));
        return $this->formatResultList($failedJob, $failedJobServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id, FailedJobRepository $failedJobRepository, FailedJobServiceResponse $failedJobServiceResponse): FailedJobServiceResponse
    {
        $failedJob = app()->call([$failedJobRepository, 'getById'], compact('id'));
        return $this->formatResult($failedJob, $failedJobServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, FailedJobRepository $failedJobRepository, FailedJobServiceResponseList $failedJobServiceResponseList, string $q = null,  int $length = 12): FailedJobServiceResponseList
    {
        $failedJob = app()->call([$failedJobRepository, 'getByIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($failedJob, $failedJobServiceResponseList);
    }

}
