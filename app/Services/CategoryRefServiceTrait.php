<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\CategoryRef;
use App\Repositories\CategoryRefRepository;
use App\Repositories\Requests\CategoryRefRepositoryRequest;
use App\Services\Requests\CategoryRefServiceRequest;
use App\Services\Responses\CategoryRefServiceResponse;
use App\Services\Responses\CategoryRefServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:03:58
 * Time: 2022/09/14
 * Class CategoryRefServiceTrait
 * @package App\Services
 */
trait CategoryRefServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(CategoryRefServiceRequest $categoryRefServiceRequest, CategoryRefRepositoryRequest $categoryRefRepositoryRequest, CategoryRefRepository $categoryRefRepository, CategoryRefServiceResponse $categoryRefServiceResponse): CategoryRefServiceResponse
    {
        $categoryRefRepositoryRequest = Lazy::transform($categoryRefServiceRequest, $categoryRefRepositoryRequest);

        $result = app()->call([$categoryRefRepository, 'store'], ['categoryRefRepositoryRequest' => $categoryRefRepositoryRequest]);
        if ($result != null) {
            $categoryRefServiceResponse->status = true;
            $categoryRefServiceResponse->message = 'Store Data Success';
            $categoryRefServiceResponse->categoryRef = $result;
        } else {
            $categoryRefServiceResponse->status = false;
            $categoryRefServiceResponse->message = 'Store Data Failed';
        }

        return $categoryRefServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $categoryId, CategoryRefServiceRequest $categoryRefServiceRequest, CategoryRefRepositoryRequest $categoryRefRepositoryRequest, CategoryRefRepository $categoryRefRepository, CategoryRefServiceResponse $categoryRefServiceResponse): CategoryRefServiceResponse
    {
        $categoryRefRepositoryRequest = Lazy::transform($categoryRefServiceRequest, $categoryRefRepositoryRequest);

        $result = app()->call([$categoryRefRepository, 'update'], ['categoryId' => $categoryId, 'categoryRefRepositoryRequest' => $categoryRefRepositoryRequest]);
        if ($result != null) {
            $categoryRefServiceResponse->status = true;
            $categoryRefServiceResponse->message = 'Update Data Success';
            $categoryRefServiceResponse->categoryRef = $result;
        } else {
            $categoryRefServiceResponse->status = false;
            $categoryRefServiceResponse->message = 'Update Data Failed';
        }

        return $categoryRefServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $categoryId, CategoryRefRepository $categoryRefRepository, CategoryRefServiceResponse $categoryRefServiceResponse): CategoryRefServiceResponse
    {
        $status = app()->call([$categoryRefRepository, 'delete'], compact('categoryId'));
        $categoryRefServiceResponse->status = $status;
        if($status){
            $categoryRefServiceResponse->message = "Delete Success";
        }else{
            $categoryRefServiceResponse->message = "Delete Failed";
        }

        return $categoryRefServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param CategoryRefServiceResponseList $categoryRefServiceResponseList
     * @return CategoryRefServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, CategoryRefServiceResponseList $categoryRefServiceResponseList): CategoryRefServiceResponseList{
        if (count($result) > 0) {
            $categoryRefServiceResponseList->status = true;
            $categoryRefServiceResponseList->message = 'Data Found';
            $categoryRefServiceResponseList->categoryRefList = $result;
            $categoryRefServiceResponseList->count = $result->total();
            $categoryRefServiceResponseList->countFiltered = $result->count();
        } else {
            $categoryRefServiceResponseList->status = false;
            $categoryRefServiceResponseList->message = 'Data Not Found';
        }
        return $categoryRefServiceResponseList;
    }

    /**
     * @param CategoryRef|null $categoryRef
     * @param CategoryRefServiceResponse $categoryRefServiceResponse
     * @return CategoryRefServiceResponse
     */
    private function formatResult(?CategoryRef $categoryRef, CategoryRefServiceResponse $categoryRefServiceResponse): CategoryRefServiceResponse{
        if($categoryRef == null){
            $categoryRefServiceResponse->status = false;
            $categoryRefServiceResponse->message = "Data Not Found";
        }else{
            $categoryRefServiceResponse->status = true;
            $categoryRefServiceResponse->message = "Data Found";
            $categoryRefServiceResponse->categoryRef = $categoryRef;
        }

        return $categoryRefServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(CategoryRefRepository $categoryRefRepository, CategoryRefServiceResponseList $categoryRefServiceResponseList, int $length = 12, string $q = null): CategoryRefServiceResponseList
    {
        $result = app()->call([$categoryRefRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $categoryRefServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(CategoryRefRepository $categoryRefRepository, string $q = null): int
    {
        return app()->call([$categoryRefRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByCategoryId(int $categoryId, CategoryRefRepository $categoryRefRepository, CategoryRefServiceResponse $categoryRefServiceResponse): CategoryRefServiceResponse
    {
        $categoryRef = app()->call([$categoryRefRepository, 'getByCategoryId'], compact('categoryId'));
        return $this->formatResult($categoryRef, $categoryRefServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByCategoryIdList(int $categoryId, CategoryRefRepository $categoryRefRepository, CategoryRefServiceResponseList $categoryRefServiceResponseList, string $q = null,  int $length = 12): CategoryRefServiceResponseList
    {
        $categoryRef = app()->call([$categoryRefRepository, 'getByCategoryIdList'], compact('categoryId', 'length', 'q'));
        return $this->formatResultList($categoryRef, $categoryRefServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserName(string $userName, CategoryRefRepository $categoryRefRepository, CategoryRefServiceResponse $categoryRefServiceResponse): CategoryRefServiceResponse
    {
        $categoryRef = app()->call([$categoryRefRepository, 'getBySfUserUserName'], compact('userName'));
        return $this->formatResult($categoryRef, $categoryRefServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserNameList(string $userName, CategoryRefRepository $categoryRefRepository, CategoryRefServiceResponseList $categoryRefServiceResponseList, string $q = null,  int $length = 12): CategoryRefServiceResponseList
    {
        $categoryRef = app()->call([$categoryRefRepository, 'getBySfUserUserNameList'], compact('userName', 'length', 'q'));
        return $this->formatResultList($categoryRef, $categoryRefServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserId(int $userId, CategoryRefRepository $categoryRefRepository, CategoryRefServiceResponse $categoryRefServiceResponse): CategoryRefServiceResponse
    {
        $categoryRef = app()->call([$categoryRefRepository, 'getBySfUserUserId'], compact('userId'));
        return $this->formatResult($categoryRef, $categoryRefServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserIdList(int $userId, CategoryRefRepository $categoryRefRepository, CategoryRefServiceResponseList $categoryRefServiceResponseList, string $q = null,  int $length = 12): CategoryRefServiceResponseList
    {
        $categoryRef = app()->call([$categoryRefRepository, 'getBySfUserUserIdList'], compact('userId', 'length', 'q'));
        return $this->formatResultList($categoryRef, $categoryRefServiceResponseList);
    }

}
