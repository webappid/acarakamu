<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\SfMenuLanguage;
use App\Repositories\Requests\SfMenuLanguageRepositoryRequest;
use App\Repositories\SfMenuLanguageRepository;
use App\Services\Requests\SfMenuLanguageServiceRequest;
use App\Services\Responses\SfMenuLanguageServiceResponse;
use App\Services\Responses\SfMenuLanguageServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:32
 * Time: 2022/09/14
 * Class SfMenuLanguageServiceTrait
 * @package App\Services
 */
trait SfMenuLanguageServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(SfMenuLanguageServiceRequest $sfMenuLanguageServiceRequest, SfMenuLanguageRepositoryRequest $sfMenuLanguageRepositoryRequest, SfMenuLanguageRepository $sfMenuLanguageRepository, SfMenuLanguageServiceResponse $sfMenuLanguageServiceResponse): SfMenuLanguageServiceResponse
    {
        $sfMenuLanguageRepositoryRequest = Lazy::transform($sfMenuLanguageServiceRequest, $sfMenuLanguageRepositoryRequest);

        $result = app()->call([$sfMenuLanguageRepository, 'store'], ['sfMenuLanguageRepositoryRequest' => $sfMenuLanguageRepositoryRequest]);
        if ($result != null) {
            $sfMenuLanguageServiceResponse->status = true;
            $sfMenuLanguageServiceResponse->message = 'Store Data Success';
            $sfMenuLanguageServiceResponse->sfMenuLanguage = $result;
        } else {
            $sfMenuLanguageServiceResponse->status = false;
            $sfMenuLanguageServiceResponse->message = 'Store Data Failed';
        }

        return $sfMenuLanguageServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $menuLangId, SfMenuLanguageServiceRequest $sfMenuLanguageServiceRequest, SfMenuLanguageRepositoryRequest $sfMenuLanguageRepositoryRequest, SfMenuLanguageRepository $sfMenuLanguageRepository, SfMenuLanguageServiceResponse $sfMenuLanguageServiceResponse): SfMenuLanguageServiceResponse
    {
        $sfMenuLanguageRepositoryRequest = Lazy::transform($sfMenuLanguageServiceRequest, $sfMenuLanguageRepositoryRequest);

        $result = app()->call([$sfMenuLanguageRepository, 'update'], ['menuLangId' => $menuLangId, 'sfMenuLanguageRepositoryRequest' => $sfMenuLanguageRepositoryRequest]);
        if ($result != null) {
            $sfMenuLanguageServiceResponse->status = true;
            $sfMenuLanguageServiceResponse->message = 'Update Data Success';
            $sfMenuLanguageServiceResponse->sfMenuLanguage = $result;
        } else {
            $sfMenuLanguageServiceResponse->status = false;
            $sfMenuLanguageServiceResponse->message = 'Update Data Failed';
        }

        return $sfMenuLanguageServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $menuLangId, SfMenuLanguageRepository $sfMenuLanguageRepository, SfMenuLanguageServiceResponse $sfMenuLanguageServiceResponse): SfMenuLanguageServiceResponse
    {
        $status = app()->call([$sfMenuLanguageRepository, 'delete'], compact('menuLangId'));
        $sfMenuLanguageServiceResponse->status = $status;
        if($status){
            $sfMenuLanguageServiceResponse->message = "Delete Success";
        }else{
            $sfMenuLanguageServiceResponse->message = "Delete Failed";
        }

        return $sfMenuLanguageServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param SfMenuLanguageServiceResponseList $sfMenuLanguageServiceResponseList
     * @return SfMenuLanguageServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, SfMenuLanguageServiceResponseList $sfMenuLanguageServiceResponseList): SfMenuLanguageServiceResponseList{
        if (count($result) > 0) {
            $sfMenuLanguageServiceResponseList->status = true;
            $sfMenuLanguageServiceResponseList->message = 'Data Found';
            $sfMenuLanguageServiceResponseList->sfMenuLanguageList = $result;
            $sfMenuLanguageServiceResponseList->count = $result->total();
            $sfMenuLanguageServiceResponseList->countFiltered = $result->count();
        } else {
            $sfMenuLanguageServiceResponseList->status = false;
            $sfMenuLanguageServiceResponseList->message = 'Data Not Found';
        }
        return $sfMenuLanguageServiceResponseList;
    }

    /**
     * @param SfMenuLanguage|null $sfMenuLanguage
     * @param SfMenuLanguageServiceResponse $sfMenuLanguageServiceResponse
     * @return SfMenuLanguageServiceResponse
     */
    private function formatResult(?SfMenuLanguage $sfMenuLanguage, SfMenuLanguageServiceResponse $sfMenuLanguageServiceResponse): SfMenuLanguageServiceResponse{
        if($sfMenuLanguage == null){
            $sfMenuLanguageServiceResponse->status = false;
            $sfMenuLanguageServiceResponse->message = "Data Not Found";
        }else{
            $sfMenuLanguageServiceResponse->status = true;
            $sfMenuLanguageServiceResponse->message = "Data Found";
            $sfMenuLanguageServiceResponse->sfMenuLanguage = $sfMenuLanguage;
        }

        return $sfMenuLanguageServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(SfMenuLanguageRepository $sfMenuLanguageRepository, SfMenuLanguageServiceResponseList $sfMenuLanguageServiceResponseList, int $length = 12, string $q = null): SfMenuLanguageServiceResponseList
    {
        $result = app()->call([$sfMenuLanguageRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $sfMenuLanguageServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(SfMenuLanguageRepository $sfMenuLanguageRepository, string $q = null): int
    {
        return app()->call([$sfMenuLanguageRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByLanguageId(int $languageId, SfMenuLanguageRepository $sfMenuLanguageRepository, SfMenuLanguageServiceResponse $sfMenuLanguageServiceResponse): SfMenuLanguageServiceResponse
    {
        $sfMenuLanguage = app()->call([$sfMenuLanguageRepository, 'getByLanguageId'], compact('languageId'));
        return $this->formatResult($sfMenuLanguage, $sfMenuLanguageServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByLanguageIdList(int $languageId, SfMenuLanguageRepository $sfMenuLanguageRepository, SfMenuLanguageServiceResponseList $sfMenuLanguageServiceResponseList, string $q = null,  int $length = 12): SfMenuLanguageServiceResponseList
    {
        $sfMenuLanguage = app()->call([$sfMenuLanguageRepository, 'getByLanguageIdList'], compact('languageId', 'length', 'q'));
        return $this->formatResultList($sfMenuLanguage, $sfMenuLanguageServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByMenuId(int $menuId, SfMenuLanguageRepository $sfMenuLanguageRepository, SfMenuLanguageServiceResponse $sfMenuLanguageServiceResponse): SfMenuLanguageServiceResponse
    {
        $sfMenuLanguage = app()->call([$sfMenuLanguageRepository, 'getByMenuId'], compact('menuId'));
        return $this->formatResult($sfMenuLanguage, $sfMenuLanguageServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByMenuIdList(int $menuId, SfMenuLanguageRepository $sfMenuLanguageRepository, SfMenuLanguageServiceResponseList $sfMenuLanguageServiceResponseList, string $q = null,  int $length = 12): SfMenuLanguageServiceResponseList
    {
        $sfMenuLanguage = app()->call([$sfMenuLanguageRepository, 'getByMenuIdList'], compact('menuId', 'length', 'q'));
        return $this->formatResultList($sfMenuLanguage, $sfMenuLanguageServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByMenuLangId(int $menuLangId, SfMenuLanguageRepository $sfMenuLanguageRepository, SfMenuLanguageServiceResponse $sfMenuLanguageServiceResponse): SfMenuLanguageServiceResponse
    {
        $sfMenuLanguage = app()->call([$sfMenuLanguageRepository, 'getByMenuLangId'], compact('menuLangId'));
        return $this->formatResult($sfMenuLanguage, $sfMenuLanguageServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByMenuLangIdList(int $menuLangId, SfMenuLanguageRepository $sfMenuLanguageRepository, SfMenuLanguageServiceResponseList $sfMenuLanguageServiceResponseList, string $q = null,  int $length = 12): SfMenuLanguageServiceResponseList
    {
        $sfMenuLanguage = app()->call([$sfMenuLanguageRepository, 'getByMenuLangIdList'], compact('menuLangId', 'length', 'q'));
        return $this->formatResultList($sfMenuLanguage, $sfMenuLanguageServiceResponseList);
    }

}
