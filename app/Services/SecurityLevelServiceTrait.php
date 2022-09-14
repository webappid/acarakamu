<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\SecurityLevel;
use App\Repositories\Requests\SecurityLevelRepositoryRequest;
use App\Repositories\SecurityLevelRepository;
use App\Services\Requests\SecurityLevelServiceRequest;
use App\Services\Responses\SecurityLevelServiceResponse;
use App\Services\Responses\SecurityLevelServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:03:54
 * Time: 2022/09/14
 * Class SecurityLevelServiceTrait
 * @package App\Services
 */
trait SecurityLevelServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(SecurityLevelServiceRequest $securityLevelServiceRequest, SecurityLevelRepositoryRequest $securityLevelRepositoryRequest, SecurityLevelRepository $securityLevelRepository, SecurityLevelServiceResponse $securityLevelServiceResponse): SecurityLevelServiceResponse
    {
        $securityLevelRepositoryRequest = Lazy::transform($securityLevelServiceRequest, $securityLevelRepositoryRequest);

        $result = app()->call([$securityLevelRepository, 'store'], ['securityLevelRepositoryRequest' => $securityLevelRepositoryRequest]);
        if ($result != null) {
            $securityLevelServiceResponse->status = true;
            $securityLevelServiceResponse->message = 'Store Data Success';
            $securityLevelServiceResponse->securityLevel = $result;
        } else {
            $securityLevelServiceResponse->status = false;
            $securityLevelServiceResponse->message = 'Store Data Failed';
        }

        return $securityLevelServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $Id, SecurityLevelServiceRequest $securityLevelServiceRequest, SecurityLevelRepositoryRequest $securityLevelRepositoryRequest, SecurityLevelRepository $securityLevelRepository, SecurityLevelServiceResponse $securityLevelServiceResponse): SecurityLevelServiceResponse
    {
        $securityLevelRepositoryRequest = Lazy::transform($securityLevelServiceRequest, $securityLevelRepositoryRequest);

        $result = app()->call([$securityLevelRepository, 'update'], ['Id' => $Id, 'securityLevelRepositoryRequest' => $securityLevelRepositoryRequest]);
        if ($result != null) {
            $securityLevelServiceResponse->status = true;
            $securityLevelServiceResponse->message = 'Update Data Success';
            $securityLevelServiceResponse->securityLevel = $result;
        } else {
            $securityLevelServiceResponse->status = false;
            $securityLevelServiceResponse->message = 'Update Data Failed';
        }

        return $securityLevelServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $Id, SecurityLevelRepository $securityLevelRepository, SecurityLevelServiceResponse $securityLevelServiceResponse): SecurityLevelServiceResponse
    {
        $status = app()->call([$securityLevelRepository, 'delete'], compact('Id'));
        $securityLevelServiceResponse->status = $status;
        if($status){
            $securityLevelServiceResponse->message = "Delete Success";
        }else{
            $securityLevelServiceResponse->message = "Delete Failed";
        }

        return $securityLevelServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param SecurityLevelServiceResponseList $securityLevelServiceResponseList
     * @return SecurityLevelServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, SecurityLevelServiceResponseList $securityLevelServiceResponseList): SecurityLevelServiceResponseList{
        if (count($result) > 0) {
            $securityLevelServiceResponseList->status = true;
            $securityLevelServiceResponseList->message = 'Data Found';
            $securityLevelServiceResponseList->securityLevelList = $result;
            $securityLevelServiceResponseList->count = $result->total();
            $securityLevelServiceResponseList->countFiltered = $result->count();
        } else {
            $securityLevelServiceResponseList->status = false;
            $securityLevelServiceResponseList->message = 'Data Not Found';
        }
        return $securityLevelServiceResponseList;
    }

    /**
     * @param SecurityLevel|null $securityLevel
     * @param SecurityLevelServiceResponse $securityLevelServiceResponse
     * @return SecurityLevelServiceResponse
     */
    private function formatResult(?SecurityLevel $securityLevel, SecurityLevelServiceResponse $securityLevelServiceResponse): SecurityLevelServiceResponse{
        if($securityLevel == null){
            $securityLevelServiceResponse->status = false;
            $securityLevelServiceResponse->message = "Data Not Found";
        }else{
            $securityLevelServiceResponse->status = true;
            $securityLevelServiceResponse->message = "Data Found";
            $securityLevelServiceResponse->securityLevel = $securityLevel;
        }

        return $securityLevelServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(SecurityLevelRepository $securityLevelRepository, SecurityLevelServiceResponseList $securityLevelServiceResponseList, int $length = 12, string $q = null): SecurityLevelServiceResponseList
    {
        $result = app()->call([$securityLevelRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $securityLevelServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(SecurityLevelRepository $securityLevelRepository, string $q = null): int
    {
        return app()->call([$securityLevelRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getById(int $id, SecurityLevelRepository $securityLevelRepository, SecurityLevelServiceResponse $securityLevelServiceResponse): SecurityLevelServiceResponse
    {
        $securityLevel = app()->call([$securityLevelRepository, 'getById'], compact('id'));
        return $this->formatResult($securityLevel, $securityLevelServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, SecurityLevelRepository $securityLevelRepository, SecurityLevelServiceResponseList $securityLevelServiceResponseList, string $q = null,  int $length = 12): SecurityLevelServiceResponseList
    {
        $securityLevel = app()->call([$securityLevelRepository, 'getByIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($securityLevel, $securityLevelServiceResponseList);
    }

}
