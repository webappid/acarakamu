<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\SystemLog;
use App\Repositories\Requests\SystemLogRepositoryRequest;
use App\Repositories\SystemLogRepository;
use App\Services\Requests\SystemLogServiceRequest;
use App\Services\Responses\SystemLogServiceResponse;
use App\Services\Responses\SystemLogServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:44
 * Time: 2022/09/14
 * Class SystemLogServiceTrait
 * @package App\Services
 */
trait SystemLogServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(SystemLogServiceRequest $systemLogServiceRequest, SystemLogRepositoryRequest $systemLogRepositoryRequest, SystemLogRepository $systemLogRepository, SystemLogServiceResponse $systemLogServiceResponse): SystemLogServiceResponse
    {
        $systemLogRepositoryRequest = Lazy::transform($systemLogServiceRequest, $systemLogRepositoryRequest);

        $result = app()->call([$systemLogRepository, 'store'], ['systemLogRepositoryRequest' => $systemLogRepositoryRequest]);
        if ($result != null) {
            $systemLogServiceResponse->status = true;
            $systemLogServiceResponse->message = 'Store Data Success';
            $systemLogServiceResponse->systemLog = $result;
        } else {
            $systemLogServiceResponse->status = false;
            $systemLogServiceResponse->message = 'Store Data Failed';
        }

        return $systemLogServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $logId, SystemLogServiceRequest $systemLogServiceRequest, SystemLogRepositoryRequest $systemLogRepositoryRequest, SystemLogRepository $systemLogRepository, SystemLogServiceResponse $systemLogServiceResponse): SystemLogServiceResponse
    {
        $systemLogRepositoryRequest = Lazy::transform($systemLogServiceRequest, $systemLogRepositoryRequest);

        $result = app()->call([$systemLogRepository, 'update'], ['logId' => $logId, 'systemLogRepositoryRequest' => $systemLogRepositoryRequest]);
        if ($result != null) {
            $systemLogServiceResponse->status = true;
            $systemLogServiceResponse->message = 'Update Data Success';
            $systemLogServiceResponse->systemLog = $result;
        } else {
            $systemLogServiceResponse->status = false;
            $systemLogServiceResponse->message = 'Update Data Failed';
        }

        return $systemLogServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $logId, SystemLogRepository $systemLogRepository, SystemLogServiceResponse $systemLogServiceResponse): SystemLogServiceResponse
    {
        $status = app()->call([$systemLogRepository, 'delete'], compact('logId'));
        $systemLogServiceResponse->status = $status;
        if($status){
            $systemLogServiceResponse->message = "Delete Success";
        }else{
            $systemLogServiceResponse->message = "Delete Failed";
        }

        return $systemLogServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param SystemLogServiceResponseList $systemLogServiceResponseList
     * @return SystemLogServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, SystemLogServiceResponseList $systemLogServiceResponseList): SystemLogServiceResponseList{
        if (count($result) > 0) {
            $systemLogServiceResponseList->status = true;
            $systemLogServiceResponseList->message = 'Data Found';
            $systemLogServiceResponseList->systemLogList = $result;
            $systemLogServiceResponseList->count = $result->total();
            $systemLogServiceResponseList->countFiltered = $result->count();
        } else {
            $systemLogServiceResponseList->status = false;
            $systemLogServiceResponseList->message = 'Data Not Found';
        }
        return $systemLogServiceResponseList;
    }

    /**
     * @param SystemLog|null $systemLog
     * @param SystemLogServiceResponse $systemLogServiceResponse
     * @return SystemLogServiceResponse
     */
    private function formatResult(?SystemLog $systemLog, SystemLogServiceResponse $systemLogServiceResponse): SystemLogServiceResponse{
        if($systemLog == null){
            $systemLogServiceResponse->status = false;
            $systemLogServiceResponse->message = "Data Not Found";
        }else{
            $systemLogServiceResponse->status = true;
            $systemLogServiceResponse->message = "Data Found";
            $systemLogServiceResponse->systemLog = $systemLog;
        }

        return $systemLogServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(SystemLogRepository $systemLogRepository, SystemLogServiceResponseList $systemLogServiceResponseList, int $length = 12, string $q = null): SystemLogServiceResponseList
    {
        $result = app()->call([$systemLogRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $systemLogServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(SystemLogRepository $systemLogRepository, string $q = null): int
    {
        return app()->call([$systemLogRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByLogId(int $logId, SystemLogRepository $systemLogRepository, SystemLogServiceResponse $systemLogServiceResponse): SystemLogServiceResponse
    {
        $systemLog = app()->call([$systemLogRepository, 'getByLogId'], compact('logId'));
        return $this->formatResult($systemLog, $systemLogServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByLogIdList(int $logId, SystemLogRepository $systemLogRepository, SystemLogServiceResponseList $systemLogServiceResponseList, string $q = null,  int $length = 12): SystemLogServiceResponseList
    {
        $systemLog = app()->call([$systemLogRepository, 'getByLogIdList'], compact('logId', 'length', 'q'));
        return $this->formatResultList($systemLog, $systemLogServiceResponseList);
    }

}
