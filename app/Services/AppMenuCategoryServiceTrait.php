<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\AppMenuCategory;
use App\Repositories\AppMenuCategoryRepository;
use App\Repositories\Requests\AppMenuCategoryRepositoryRequest;
use App\Services\Requests\AppMenuCategoryServiceRequest;
use App\Services\Responses\AppMenuCategoryServiceResponse;
use App\Services\Responses\AppMenuCategoryServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 14:03:57
 * Time: 2021/11/06
 * Class AppMenuCategoryServiceTrait
 * @package App\Services
 */
trait AppMenuCategoryServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(AppMenuCategoryServiceRequest $appMenuCategoryServiceRequest, AppMenuCategoryRepositoryRequest $appMenuCategoryRepositoryRequest, AppMenuCategoryRepository $appMenuCategoryRepository, AppMenuCategoryServiceResponse $appMenuCategoryServiceResponse): AppMenuCategoryServiceResponse
    {
        $appMenuCategoryRepositoryRequest = Lazy::transform($appMenuCategoryServiceRequest, $appMenuCategoryRepositoryRequest);

        $result = app()->call([$appMenuCategoryRepository, 'store'], ['appMenuCategoryRepositoryRequest' => $appMenuCategoryRepositoryRequest]);
        if ($result != null) {
            $appMenuCategoryServiceResponse->status = true;
            $appMenuCategoryServiceResponse->message = 'Store Data Success';
            $appMenuCategoryServiceResponse->appMenuCategory = $result;
        } else {
            $appMenuCategoryServiceResponse->status = false;
            $appMenuCategoryServiceResponse->message = 'Store Data Failed';
        }

        return $appMenuCategoryServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(string $name, AppMenuCategoryServiceRequest $appMenuCategoryServiceRequest, AppMenuCategoryRepositoryRequest $appMenuCategoryRepositoryRequest, AppMenuCategoryRepository $appMenuCategoryRepository, AppMenuCategoryServiceResponse $appMenuCategoryServiceResponse): AppMenuCategoryServiceResponse
    {
        $appMenuCategoryRepositoryRequest = Lazy::transform($appMenuCategoryServiceRequest, $appMenuCategoryRepositoryRequest);

        $result = app()->call([$appMenuCategoryRepository, 'update'], ['name' => $name, 'appMenuCategoryRepositoryRequest' => $appMenuCategoryRepositoryRequest]);
        if ($result != null) {
            $appMenuCategoryServiceResponse->status = true;
            $appMenuCategoryServiceResponse->message = 'Update Data Success';
            $appMenuCategoryServiceResponse->appMenuCategory = $result;
        } else {
            $appMenuCategoryServiceResponse->status = false;
            $appMenuCategoryServiceResponse->message = 'Update Data Failed';
        }

        return $appMenuCategoryServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $name, AppMenuCategoryRepository $appMenuCategoryRepository, AppMenuCategoryServiceResponse $appMenuCategoryServiceResponse): AppMenuCategoryServiceResponse
    {
        $status = app()->call([$appMenuCategoryRepository, 'delete'], compact('name'));
        $appMenuCategoryServiceResponse->status = $status;
        if($status){
            $appMenuCategoryServiceResponse->message = "Delete Success";
        }else{
            $appMenuCategoryServiceResponse->message = "Delete Failed";
        }

        return $appMenuCategoryServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param AppMenuCategoryServiceResponseList $appMenuCategoryServiceResponseList
     * @return AppMenuCategoryServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, AppMenuCategoryServiceResponseList $appMenuCategoryServiceResponseList): AppMenuCategoryServiceResponseList{
        if (count($result) > 0) {
            $appMenuCategoryServiceResponseList->status = true;
            $appMenuCategoryServiceResponseList->message = 'Data Found';
            $appMenuCategoryServiceResponseList->appMenuCategoryList = $result;
            $appMenuCategoryServiceResponseList->count = $result->total();
            $appMenuCategoryServiceResponseList->countFiltered = $result->count();
        } else {
            $appMenuCategoryServiceResponseList->status = false;
            $appMenuCategoryServiceResponseList->message = 'Data Not Found';
        }
        return $appMenuCategoryServiceResponseList;
    }

    /**
     * @param AppMenuCategory|null $appMenuCategory
     * @param AppMenuCategoryServiceResponse $appMenuCategoryServiceResponse
     * @return AppMenuCategoryServiceResponse
     */
    private function formatResult(?AppMenuCategory $appMenuCategory, AppMenuCategoryServiceResponse $appMenuCategoryServiceResponse): AppMenuCategoryServiceResponse{
        if($appMenuCategory == null){
            $appMenuCategoryServiceResponse->status = false;
            $appMenuCategoryServiceResponse->message = "Data Not Found";
        }else{
            $appMenuCategoryServiceResponse->status = true;
            $appMenuCategoryServiceResponse->message = "Data Found";
            $appMenuCategoryServiceResponse->appMenuCategory = $appMenuCategory;
        }

        return $appMenuCategoryServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(AppMenuCategoryRepository $appMenuCategoryRepository, AppMenuCategoryServiceResponseList $appMenuCategoryServiceResponseList, int $length = 12, string $q = null): AppMenuCategoryServiceResponseList
    {
        $result = app()->call([$appMenuCategoryRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $appMenuCategoryServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(AppMenuCategoryRepository $appMenuCategoryRepository, string $q = null): int
    {
        return app()->call([$appMenuCategoryRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByName(string $name, AppMenuCategoryRepository $appMenuCategoryRepository, AppMenuCategoryServiceResponse $appMenuCategoryServiceResponse): AppMenuCategoryServiceResponse
    {
        $appMenuCategory = app()->call([$appMenuCategoryRepository, 'getByName'], compact('name'));
        return $this->formatResult($appMenuCategory, $appMenuCategoryServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByNameList(string $name, AppMenuCategoryRepository $appMenuCategoryRepository, AppMenuCategoryServiceResponseList $appMenuCategoryServiceResponseList, string $q = null,  int $length = 12): AppMenuCategoryServiceResponseList
    {
        $appMenuCategory = app()->call([$appMenuCategoryRepository, 'getByNameList'], compact('name', 'length', 'q'));
        return $this->formatResultList($appMenuCategory, $appMenuCategoryServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id, AppMenuCategoryRepository $appMenuCategoryRepository, AppMenuCategoryServiceResponse $appMenuCategoryServiceResponse): AppMenuCategoryServiceResponse
    {
        $appMenuCategory = app()->call([$appMenuCategoryRepository, 'getById'], compact('id'));
        return $this->formatResult($appMenuCategory, $appMenuCategoryServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, AppMenuCategoryRepository $appMenuCategoryRepository, AppMenuCategoryServiceResponseList $appMenuCategoryServiceResponseList, string $q = null,  int $length = 12): AppMenuCategoryServiceResponseList
    {
        $appMenuCategory = app()->call([$appMenuCategoryRepository, 'getByIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($appMenuCategory, $appMenuCategoryServiceResponseList);
    }

}
