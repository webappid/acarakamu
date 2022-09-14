<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\Migration;
use App\Repositories\MigrationRepository;
use App\Repositories\Requests\MigrationRepositoryRequest;
use App\Services\Requests\MigrationServiceRequest;
use App\Services\Responses\MigrationServiceResponse;
use App\Services\Responses\MigrationServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:12
 * Time: 2022/09/14
 * Class MigrationServiceTrait
 * @package App\Services
 */
trait MigrationServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(MigrationServiceRequest $migrationServiceRequest, MigrationRepositoryRequest $migrationRepositoryRequest, MigrationRepository $migrationRepository, MigrationServiceResponse $migrationServiceResponse): MigrationServiceResponse
    {
        $migrationRepositoryRequest = Lazy::transform($migrationServiceRequest, $migrationRepositoryRequest);

        $result = app()->call([$migrationRepository, 'store'], ['migrationRepositoryRequest' => $migrationRepositoryRequest]);
        if ($result != null) {
            $migrationServiceResponse->status = true;
            $migrationServiceResponse->message = 'Store Data Success';
            $migrationServiceResponse->migration = $result;
        } else {
            $migrationServiceResponse->status = false;
            $migrationServiceResponse->message = 'Store Data Failed';
        }

        return $migrationServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, MigrationServiceRequest $migrationServiceRequest, MigrationRepositoryRequest $migrationRepositoryRequest, MigrationRepository $migrationRepository, MigrationServiceResponse $migrationServiceResponse): MigrationServiceResponse
    {
        $migrationRepositoryRequest = Lazy::transform($migrationServiceRequest, $migrationRepositoryRequest);

        $result = app()->call([$migrationRepository, 'update'], ['id' => $id, 'migrationRepositoryRequest' => $migrationRepositoryRequest]);
        if ($result != null) {
            $migrationServiceResponse->status = true;
            $migrationServiceResponse->message = 'Update Data Success';
            $migrationServiceResponse->migration = $result;
        } else {
            $migrationServiceResponse->status = false;
            $migrationServiceResponse->message = 'Update Data Failed';
        }

        return $migrationServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, MigrationRepository $migrationRepository, MigrationServiceResponse $migrationServiceResponse): MigrationServiceResponse
    {
        $status = app()->call([$migrationRepository, 'delete'], compact('id'));
        $migrationServiceResponse->status = $status;
        if($status){
            $migrationServiceResponse->message = "Delete Success";
        }else{
            $migrationServiceResponse->message = "Delete Failed";
        }

        return $migrationServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param MigrationServiceResponseList $migrationServiceResponseList
     * @return MigrationServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, MigrationServiceResponseList $migrationServiceResponseList): MigrationServiceResponseList{
        if (count($result) > 0) {
            $migrationServiceResponseList->status = true;
            $migrationServiceResponseList->message = 'Data Found';
            $migrationServiceResponseList->migrationList = $result;
            $migrationServiceResponseList->count = $result->total();
            $migrationServiceResponseList->countFiltered = $result->count();
        } else {
            $migrationServiceResponseList->status = false;
            $migrationServiceResponseList->message = 'Data Not Found';
        }
        return $migrationServiceResponseList;
    }

    /**
     * @param Migration|null $migration
     * @param MigrationServiceResponse $migrationServiceResponse
     * @return MigrationServiceResponse
     */
    private function formatResult(?Migration $migration, MigrationServiceResponse $migrationServiceResponse): MigrationServiceResponse{
        if($migration == null){
            $migrationServiceResponse->status = false;
            $migrationServiceResponse->message = "Data Not Found";
        }else{
            $migrationServiceResponse->status = true;
            $migrationServiceResponse->message = "Data Found";
            $migrationServiceResponse->migration = $migration;
        }

        return $migrationServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(MigrationRepository $migrationRepository, MigrationServiceResponseList $migrationServiceResponseList, int $length = 12, string $q = null): MigrationServiceResponseList
    {
        $result = app()->call([$migrationRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $migrationServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(MigrationRepository $migrationRepository, string $q = null): int
    {
        return app()->call([$migrationRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getById(int $id, MigrationRepository $migrationRepository, MigrationServiceResponse $migrationServiceResponse): MigrationServiceResponse
    {
        $migration = app()->call([$migrationRepository, 'getById'], compact('id'));
        return $this->formatResult($migration, $migrationServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, MigrationRepository $migrationRepository, MigrationServiceResponseList $migrationServiceResponseList, string $q = null,  int $length = 12): MigrationServiceResponseList
    {
        $migration = app()->call([$migrationRepository, 'getByIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($migration, $migrationServiceResponseList);
    }

}
