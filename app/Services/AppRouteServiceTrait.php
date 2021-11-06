<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\AppRoute;
use App\Repositories\AppRouteRepository;
use App\Repositories\Requests\AppRouteRepositoryRequest;
use App\Services\Requests\AppRouteServiceRequest;
use App\Services\Responses\AppRouteServiceResponse;
use App\Services\Responses\AppRouteServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 14:04:02
 * Time: 2021/11/06
 * Class AppRouteServiceTrait
 * @package App\Services
 */
trait AppRouteServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(AppRouteServiceRequest $appRouteServiceRequest, AppRouteRepositoryRequest $appRouteRepositoryRequest, AppRouteRepository $appRouteRepository, AppRouteServiceResponse $appRouteServiceResponse): AppRouteServiceResponse
    {
        $appRouteRepositoryRequest = Lazy::transform($appRouteServiceRequest, $appRouteRepositoryRequest);

        $result = app()->call([$appRouteRepository, 'store'], ['appRouteRepositoryRequest' => $appRouteRepositoryRequest]);
        if ($result != null) {
            $appRouteServiceResponse->status = true;
            $appRouteServiceResponse->message = 'Store Data Success';
            $appRouteServiceResponse->appRoute = $result;
        } else {
            $appRouteServiceResponse->status = false;
            $appRouteServiceResponse->message = 'Store Data Failed';
        }

        return $appRouteServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(string $name, AppRouteServiceRequest $appRouteServiceRequest, AppRouteRepositoryRequest $appRouteRepositoryRequest, AppRouteRepository $appRouteRepository, AppRouteServiceResponse $appRouteServiceResponse): AppRouteServiceResponse
    {
        $appRouteRepositoryRequest = Lazy::transform($appRouteServiceRequest, $appRouteRepositoryRequest);

        $result = app()->call([$appRouteRepository, 'update'], ['name' => $name, 'appRouteRepositoryRequest' => $appRouteRepositoryRequest]);
        if ($result != null) {
            $appRouteServiceResponse->status = true;
            $appRouteServiceResponse->message = 'Update Data Success';
            $appRouteServiceResponse->appRoute = $result;
        } else {
            $appRouteServiceResponse->status = false;
            $appRouteServiceResponse->message = 'Update Data Failed';
        }

        return $appRouteServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $name, AppRouteRepository $appRouteRepository, AppRouteServiceResponse $appRouteServiceResponse): AppRouteServiceResponse
    {
        $status = app()->call([$appRouteRepository, 'delete'], compact('name'));
        $appRouteServiceResponse->status = $status;
        if($status){
            $appRouteServiceResponse->message = "Delete Success";
        }else{
            $appRouteServiceResponse->message = "Delete Failed";
        }

        return $appRouteServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param AppRouteServiceResponseList $appRouteServiceResponseList
     * @return AppRouteServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, AppRouteServiceResponseList $appRouteServiceResponseList): AppRouteServiceResponseList{
        if (count($result) > 0) {
            $appRouteServiceResponseList->status = true;
            $appRouteServiceResponseList->message = 'Data Found';
            $appRouteServiceResponseList->appRouteList = $result;
            $appRouteServiceResponseList->count = $result->total();
            $appRouteServiceResponseList->countFiltered = $result->count();
        } else {
            $appRouteServiceResponseList->status = false;
            $appRouteServiceResponseList->message = 'Data Not Found';
        }
        return $appRouteServiceResponseList;
    }

    /**
     * @param AppRoute|null $appRoute
     * @param AppRouteServiceResponse $appRouteServiceResponse
     * @return AppRouteServiceResponse
     */
    private function formatResult(?AppRoute $appRoute, AppRouteServiceResponse $appRouteServiceResponse): AppRouteServiceResponse{
        if($appRoute == null){
            $appRouteServiceResponse->status = false;
            $appRouteServiceResponse->message = "Data Not Found";
        }else{
            $appRouteServiceResponse->status = true;
            $appRouteServiceResponse->message = "Data Found";
            $appRouteServiceResponse->appRoute = $appRoute;
        }

        return $appRouteServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(AppRouteRepository $appRouteRepository, AppRouteServiceResponseList $appRouteServiceResponseList, int $length = 12, string $q = null): AppRouteServiceResponseList
    {
        $result = app()->call([$appRouteRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $appRouteServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(AppRouteRepository $appRouteRepository, string $q = null): int
    {
        return app()->call([$appRouteRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByName(string $name, AppRouteRepository $appRouteRepository, AppRouteServiceResponse $appRouteServiceResponse): AppRouteServiceResponse
    {
        $appRoute = app()->call([$appRouteRepository, 'getByName'], compact('name'));
        return $this->formatResult($appRoute, $appRouteServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByNameList(string $name, AppRouteRepository $appRouteRepository, AppRouteServiceResponseList $appRouteServiceResponseList, string $q = null,  int $length = 12): AppRouteServiceResponseList
    {
        $appRoute = app()->call([$appRouteRepository, 'getByNameList'], compact('name', 'length', 'q'));
        return $this->formatResultList($appRoute, $appRouteServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id, AppRouteRepository $appRouteRepository, AppRouteServiceResponse $appRouteServiceResponse): AppRouteServiceResponse
    {
        $appRoute = app()->call([$appRouteRepository, 'getById'], compact('id'));
        return $this->formatResult($appRoute, $appRouteServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, AppRouteRepository $appRouteRepository, AppRouteServiceResponseList $appRouteServiceResponseList, string $q = null,  int $length = 12): AppRouteServiceResponseList
    {
        $appRoute = app()->call([$appRouteRepository, 'getByIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($appRoute, $appRouteServiceResponseList);
    }

}
