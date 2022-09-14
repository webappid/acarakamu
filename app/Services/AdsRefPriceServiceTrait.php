<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\AdsRefPrice;
use App\Repositories\AdsRefPriceRepository;
use App\Repositories\Requests\AdsRefPriceRepositoryRequest;
use App\Services\Requests\AdsRefPriceServiceRequest;
use App\Services\Responses\AdsRefPriceServiceResponse;
use App\Services\Responses\AdsRefPriceServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:03:57
 * Time: 2022/09/14
 * Class AdsRefPriceServiceTrait
 * @package App\Services
 */
trait AdsRefPriceServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(AdsRefPriceServiceRequest $adsRefPriceServiceRequest, AdsRefPriceRepositoryRequest $adsRefPriceRepositoryRequest, AdsRefPriceRepository $adsRefPriceRepository, AdsRefPriceServiceResponse $adsRefPriceServiceResponse): AdsRefPriceServiceResponse
    {
        $adsRefPriceRepositoryRequest = Lazy::transform($adsRefPriceServiceRequest, $adsRefPriceRepositoryRequest);

        $result = app()->call([$adsRefPriceRepository, 'store'], ['adsRefPriceRepositoryRequest' => $adsRefPriceRepositoryRequest]);
        if ($result != null) {
            $adsRefPriceServiceResponse->status = true;
            $adsRefPriceServiceResponse->message = 'Store Data Success';
            $adsRefPriceServiceResponse->adsRefPrice = $result;
        } else {
            $adsRefPriceServiceResponse->status = false;
            $adsRefPriceServiceResponse->message = 'Store Data Failed';
        }

        return $adsRefPriceServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $adsPriceRefId, AdsRefPriceServiceRequest $adsRefPriceServiceRequest, AdsRefPriceRepositoryRequest $adsRefPriceRepositoryRequest, AdsRefPriceRepository $adsRefPriceRepository, AdsRefPriceServiceResponse $adsRefPriceServiceResponse): AdsRefPriceServiceResponse
    {
        $adsRefPriceRepositoryRequest = Lazy::transform($adsRefPriceServiceRequest, $adsRefPriceRepositoryRequest);

        $result = app()->call([$adsRefPriceRepository, 'update'], ['adsPriceRefId' => $adsPriceRefId, 'adsRefPriceRepositoryRequest' => $adsRefPriceRepositoryRequest]);
        if ($result != null) {
            $adsRefPriceServiceResponse->status = true;
            $adsRefPriceServiceResponse->message = 'Update Data Success';
            $adsRefPriceServiceResponse->adsRefPrice = $result;
        } else {
            $adsRefPriceServiceResponse->status = false;
            $adsRefPriceServiceResponse->message = 'Update Data Failed';
        }

        return $adsRefPriceServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $adsPriceRefId, AdsRefPriceRepository $adsRefPriceRepository, AdsRefPriceServiceResponse $adsRefPriceServiceResponse): AdsRefPriceServiceResponse
    {
        $status = app()->call([$adsRefPriceRepository, 'delete'], compact('adsPriceRefId'));
        $adsRefPriceServiceResponse->status = $status;
        if($status){
            $adsRefPriceServiceResponse->message = "Delete Success";
        }else{
            $adsRefPriceServiceResponse->message = "Delete Failed";
        }

        return $adsRefPriceServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param AdsRefPriceServiceResponseList $adsRefPriceServiceResponseList
     * @return AdsRefPriceServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, AdsRefPriceServiceResponseList $adsRefPriceServiceResponseList): AdsRefPriceServiceResponseList{
        if (count($result) > 0) {
            $adsRefPriceServiceResponseList->status = true;
            $adsRefPriceServiceResponseList->message = 'Data Found';
            $adsRefPriceServiceResponseList->adsRefPriceList = $result;
            $adsRefPriceServiceResponseList->count = $result->total();
            $adsRefPriceServiceResponseList->countFiltered = $result->count();
        } else {
            $adsRefPriceServiceResponseList->status = false;
            $adsRefPriceServiceResponseList->message = 'Data Not Found';
        }
        return $adsRefPriceServiceResponseList;
    }

    /**
     * @param AdsRefPrice|null $adsRefPrice
     * @param AdsRefPriceServiceResponse $adsRefPriceServiceResponse
     * @return AdsRefPriceServiceResponse
     */
    private function formatResult(?AdsRefPrice $adsRefPrice, AdsRefPriceServiceResponse $adsRefPriceServiceResponse): AdsRefPriceServiceResponse{
        if($adsRefPrice == null){
            $adsRefPriceServiceResponse->status = false;
            $adsRefPriceServiceResponse->message = "Data Not Found";
        }else{
            $adsRefPriceServiceResponse->status = true;
            $adsRefPriceServiceResponse->message = "Data Found";
            $adsRefPriceServiceResponse->adsRefPrice = $adsRefPrice;
        }

        return $adsRefPriceServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(AdsRefPriceRepository $adsRefPriceRepository, AdsRefPriceServiceResponseList $adsRefPriceServiceResponseList, int $length = 12, string $q = null): AdsRefPriceServiceResponseList
    {
        $result = app()->call([$adsRefPriceRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $adsRefPriceServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(AdsRefPriceRepository $adsRefPriceRepository, string $q = null): int
    {
        return app()->call([$adsRefPriceRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByAdsPriceRefId(int $adsPriceRefId, AdsRefPriceRepository $adsRefPriceRepository, AdsRefPriceServiceResponse $adsRefPriceServiceResponse): AdsRefPriceServiceResponse
    {
        $adsRefPrice = app()->call([$adsRefPriceRepository, 'getByAdsPriceRefId'], compact('adsPriceRefId'));
        return $this->formatResult($adsRefPrice, $adsRefPriceServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByAdsPriceRefIdList(int $adsPriceRefId, AdsRefPriceRepository $adsRefPriceRepository, AdsRefPriceServiceResponseList $adsRefPriceServiceResponseList, string $q = null,  int $length = 12): AdsRefPriceServiceResponseList
    {
        $adsRefPrice = app()->call([$adsRefPriceRepository, 'getByAdsPriceRefIdList'], compact('adsPriceRefId', 'length', 'q'));
        return $this->formatResultList($adsRefPrice, $adsRefPriceServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserName(string $userName, AdsRefPriceRepository $adsRefPriceRepository, AdsRefPriceServiceResponse $adsRefPriceServiceResponse): AdsRefPriceServiceResponse
    {
        $adsRefPrice = app()->call([$adsRefPriceRepository, 'getBySfUserUserName'], compact('userName'));
        return $this->formatResult($adsRefPrice, $adsRefPriceServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserNameList(string $userName, AdsRefPriceRepository $adsRefPriceRepository, AdsRefPriceServiceResponseList $adsRefPriceServiceResponseList, string $q = null,  int $length = 12): AdsRefPriceServiceResponseList
    {
        $adsRefPrice = app()->call([$adsRefPriceRepository, 'getBySfUserUserNameList'], compact('userName', 'length', 'q'));
        return $this->formatResultList($adsRefPrice, $adsRefPriceServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserId(int $userId, AdsRefPriceRepository $adsRefPriceRepository, AdsRefPriceServiceResponse $adsRefPriceServiceResponse): AdsRefPriceServiceResponse
    {
        $adsRefPrice = app()->call([$adsRefPriceRepository, 'getBySfUserUserId'], compact('userId'));
        return $this->formatResult($adsRefPrice, $adsRefPriceServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserIdList(int $userId, AdsRefPriceRepository $adsRefPriceRepository, AdsRefPriceServiceResponseList $adsRefPriceServiceResponseList, string $q = null,  int $length = 12): AdsRefPriceServiceResponseList
    {
        $adsRefPrice = app()->call([$adsRefPriceRepository, 'getBySfUserUserIdList'], compact('userId', 'length', 'q'));
        return $this->formatResultList($adsRefPrice, $adsRefPriceServiceResponseList);
    }

}
