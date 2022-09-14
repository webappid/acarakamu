<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\SfLanguage;
use App\Repositories\Requests\SfLanguageRepositoryRequest;
use App\Repositories\SfLanguageRepository;
use App\Services\Requests\SfLanguageServiceRequest;
use App\Services\Responses\SfLanguageServiceResponse;
use App\Services\Responses\SfLanguageServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:30
 * Time: 2022/09/14
 * Class SfLanguageServiceTrait
 * @package App\Services
 */
trait SfLanguageServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(SfLanguageServiceRequest $sfLanguageServiceRequest, SfLanguageRepositoryRequest $sfLanguageRepositoryRequest, SfLanguageRepository $sfLanguageRepository, SfLanguageServiceResponse $sfLanguageServiceResponse): SfLanguageServiceResponse
    {
        $sfLanguageRepositoryRequest = Lazy::transform($sfLanguageServiceRequest, $sfLanguageRepositoryRequest);

        $result = app()->call([$sfLanguageRepository, 'store'], ['sfLanguageRepositoryRequest' => $sfLanguageRepositoryRequest]);
        if ($result != null) {
            $sfLanguageServiceResponse->status = true;
            $sfLanguageServiceResponse->message = 'Store Data Success';
            $sfLanguageServiceResponse->sfLanguage = $result;
        } else {
            $sfLanguageServiceResponse->status = false;
            $sfLanguageServiceResponse->message = 'Store Data Failed';
        }

        return $sfLanguageServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $languageId, SfLanguageServiceRequest $sfLanguageServiceRequest, SfLanguageRepositoryRequest $sfLanguageRepositoryRequest, SfLanguageRepository $sfLanguageRepository, SfLanguageServiceResponse $sfLanguageServiceResponse): SfLanguageServiceResponse
    {
        $sfLanguageRepositoryRequest = Lazy::transform($sfLanguageServiceRequest, $sfLanguageRepositoryRequest);

        $result = app()->call([$sfLanguageRepository, 'update'], ['languageId' => $languageId, 'sfLanguageRepositoryRequest' => $sfLanguageRepositoryRequest]);
        if ($result != null) {
            $sfLanguageServiceResponse->status = true;
            $sfLanguageServiceResponse->message = 'Update Data Success';
            $sfLanguageServiceResponse->sfLanguage = $result;
        } else {
            $sfLanguageServiceResponse->status = false;
            $sfLanguageServiceResponse->message = 'Update Data Failed';
        }

        return $sfLanguageServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $languageId, SfLanguageRepository $sfLanguageRepository, SfLanguageServiceResponse $sfLanguageServiceResponse): SfLanguageServiceResponse
    {
        $status = app()->call([$sfLanguageRepository, 'delete'], compact('languageId'));
        $sfLanguageServiceResponse->status = $status;
        if($status){
            $sfLanguageServiceResponse->message = "Delete Success";
        }else{
            $sfLanguageServiceResponse->message = "Delete Failed";
        }

        return $sfLanguageServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param SfLanguageServiceResponseList $sfLanguageServiceResponseList
     * @return SfLanguageServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, SfLanguageServiceResponseList $sfLanguageServiceResponseList): SfLanguageServiceResponseList{
        if (count($result) > 0) {
            $sfLanguageServiceResponseList->status = true;
            $sfLanguageServiceResponseList->message = 'Data Found';
            $sfLanguageServiceResponseList->sfLanguageList = $result;
            $sfLanguageServiceResponseList->count = $result->total();
            $sfLanguageServiceResponseList->countFiltered = $result->count();
        } else {
            $sfLanguageServiceResponseList->status = false;
            $sfLanguageServiceResponseList->message = 'Data Not Found';
        }
        return $sfLanguageServiceResponseList;
    }

    /**
     * @param SfLanguage|null $sfLanguage
     * @param SfLanguageServiceResponse $sfLanguageServiceResponse
     * @return SfLanguageServiceResponse
     */
    private function formatResult(?SfLanguage $sfLanguage, SfLanguageServiceResponse $sfLanguageServiceResponse): SfLanguageServiceResponse{
        if($sfLanguage == null){
            $sfLanguageServiceResponse->status = false;
            $sfLanguageServiceResponse->message = "Data Not Found";
        }else{
            $sfLanguageServiceResponse->status = true;
            $sfLanguageServiceResponse->message = "Data Found";
            $sfLanguageServiceResponse->sfLanguage = $sfLanguage;
        }

        return $sfLanguageServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(SfLanguageRepository $sfLanguageRepository, SfLanguageServiceResponseList $sfLanguageServiceResponseList, int $length = 12, string $q = null): SfLanguageServiceResponseList
    {
        $result = app()->call([$sfLanguageRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $sfLanguageServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(SfLanguageRepository $sfLanguageRepository, string $q = null): int
    {
        return app()->call([$sfLanguageRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByLanguageId(int $languageId, SfLanguageRepository $sfLanguageRepository, SfLanguageServiceResponse $sfLanguageServiceResponse): SfLanguageServiceResponse
    {
        $sfLanguage = app()->call([$sfLanguageRepository, 'getByLanguageId'], compact('languageId'));
        return $this->formatResult($sfLanguage, $sfLanguageServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByLanguageIdList(int $languageId, SfLanguageRepository $sfLanguageRepository, SfLanguageServiceResponseList $sfLanguageServiceResponseList, string $q = null,  int $length = 12): SfLanguageServiceResponseList
    {
        $sfLanguage = app()->call([$sfLanguageRepository, 'getByLanguageIdList'], compact('languageId', 'length', 'q'));
        return $this->formatResultList($sfLanguage, $sfLanguageServiceResponseList);
    }

}
