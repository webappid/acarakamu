<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\FontIcon;
use App\Repositories\FontIconRepository;
use App\Repositories\Requests\FontIconRepositoryRequest;
use App\Services\Requests\FontIconServiceRequest;
use App\Services\Responses\FontIconServiceResponse;
use App\Services\Responses\FontIconServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 14:04:14
 * Time: 2021/11/06
 * Class FontIconServiceTrait
 * @package App\Services
 */
trait FontIconServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(FontIconServiceRequest $fontIconServiceRequest, FontIconRepositoryRequest $fontIconRepositoryRequest, FontIconRepository $fontIconRepository, FontIconServiceResponse $fontIconServiceResponse): FontIconServiceResponse
    {
        $fontIconRepositoryRequest = Lazy::transform($fontIconServiceRequest, $fontIconRepositoryRequest);

        $result = app()->call([$fontIconRepository, 'store'], ['fontIconRepositoryRequest' => $fontIconRepositoryRequest]);
        if ($result != null) {
            $fontIconServiceResponse->status = true;
            $fontIconServiceResponse->message = 'Store Data Success';
            $fontIconServiceResponse->fontIcon = $result;
        } else {
            $fontIconServiceResponse->status = false;
            $fontIconServiceResponse->message = 'Store Data Failed';
        }

        return $fontIconServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, FontIconServiceRequest $fontIconServiceRequest, FontIconRepositoryRequest $fontIconRepositoryRequest, FontIconRepository $fontIconRepository, FontIconServiceResponse $fontIconServiceResponse): FontIconServiceResponse
    {
        $fontIconRepositoryRequest = Lazy::transform($fontIconServiceRequest, $fontIconRepositoryRequest);

        $result = app()->call([$fontIconRepository, 'update'], ['id' => $id, 'fontIconRepositoryRequest' => $fontIconRepositoryRequest]);
        if ($result != null) {
            $fontIconServiceResponse->status = true;
            $fontIconServiceResponse->message = 'Update Data Success';
            $fontIconServiceResponse->fontIcon = $result;
        } else {
            $fontIconServiceResponse->status = false;
            $fontIconServiceResponse->message = 'Update Data Failed';
        }

        return $fontIconServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, FontIconRepository $fontIconRepository, FontIconServiceResponse $fontIconServiceResponse): FontIconServiceResponse
    {
        $status = app()->call([$fontIconRepository, 'delete'], compact('id'));
        $fontIconServiceResponse->status = $status;
        if($status){
            $fontIconServiceResponse->message = "Delete Success";
        }else{
            $fontIconServiceResponse->message = "Delete Failed";
        }

        return $fontIconServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param FontIconServiceResponseList $fontIconServiceResponseList
     * @return FontIconServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, FontIconServiceResponseList $fontIconServiceResponseList): FontIconServiceResponseList{
        if (count($result) > 0) {
            $fontIconServiceResponseList->status = true;
            $fontIconServiceResponseList->message = 'Data Found';
            $fontIconServiceResponseList->fontIconList = $result;
            $fontIconServiceResponseList->count = $result->total();
            $fontIconServiceResponseList->countFiltered = $result->count();
        } else {
            $fontIconServiceResponseList->status = false;
            $fontIconServiceResponseList->message = 'Data Not Found';
        }
        return $fontIconServiceResponseList;
    }

    /**
     * @param FontIcon|null $fontIcon
     * @param FontIconServiceResponse $fontIconServiceResponse
     * @return FontIconServiceResponse
     */
    private function formatResult(?FontIcon $fontIcon, FontIconServiceResponse $fontIconServiceResponse): FontIconServiceResponse{
        if($fontIcon == null){
            $fontIconServiceResponse->status = false;
            $fontIconServiceResponse->message = "Data Not Found";
        }else{
            $fontIconServiceResponse->status = true;
            $fontIconServiceResponse->message = "Data Found";
            $fontIconServiceResponse->fontIcon = $fontIcon;
        }

        return $fontIconServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(FontIconRepository $fontIconRepository, FontIconServiceResponseList $fontIconServiceResponseList, int $length = 12, string $q = null): FontIconServiceResponseList
    {
        $result = app()->call([$fontIconRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $fontIconServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(FontIconRepository $fontIconRepository, string $q = null): int
    {
        return app()->call([$fontIconRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByName(string $name, FontIconRepository $fontIconRepository, FontIconServiceResponse $fontIconServiceResponse): FontIconServiceResponse
    {
        $fontIcon = app()->call([$fontIconRepository, 'getByName'], compact('name'));
        return $this->formatResult($fontIcon, $fontIconServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByNameList(string $name, FontIconRepository $fontIconRepository, FontIconServiceResponseList $fontIconServiceResponseList, string $q = null,  int $length = 12): FontIconServiceResponseList
    {
        $fontIcon = app()->call([$fontIconRepository, 'getByNameList'], compact('name', 'length', 'q'));
        return $this->formatResultList($fontIcon, $fontIconServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id, FontIconRepository $fontIconRepository, FontIconServiceResponse $fontIconServiceResponse): FontIconServiceResponse
    {
        $fontIcon = app()->call([$fontIconRepository, 'getById'], compact('id'));
        return $this->formatResult($fontIcon, $fontIconServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, FontIconRepository $fontIconRepository, FontIconServiceResponseList $fontIconServiceResponseList, string $q = null,  int $length = 12): FontIconServiceResponseList
    {
        $fontIcon = app()->call([$fontIconRepository, 'getByIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($fontIcon, $fontIconServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByFontIconTypeName(string $name, FontIconRepository $fontIconRepository, FontIconServiceResponse $fontIconServiceResponse): FontIconServiceResponse
    {
        $fontIcon = app()->call([$fontIconRepository, 'getByFontIconTypeName'], compact('name'));
        return $this->formatResult($fontIcon, $fontIconServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByFontIconTypeNameList(string $name, FontIconRepository $fontIconRepository, FontIconServiceResponseList $fontIconServiceResponseList, string $q = null,  int $length = 12): FontIconServiceResponseList
    {
        $fontIcon = app()->call([$fontIconRepository, 'getByFontIconTypeNameList'], compact('name', 'length', 'q'));
        return $this->formatResultList($fontIcon, $fontIconServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByFontIconTypeId(int $id, FontIconRepository $fontIconRepository, FontIconServiceResponse $fontIconServiceResponse): FontIconServiceResponse
    {
        $fontIcon = app()->call([$fontIconRepository, 'getByFontIconTypeId'], compact('id'));
        return $this->formatResult($fontIcon, $fontIconServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByFontIconTypeIdList(int $id, FontIconRepository $fontIconRepository, FontIconServiceResponseList $fontIconServiceResponseList, string $q = null,  int $length = 12): FontIconServiceResponseList
    {
        $fontIcon = app()->call([$fontIconRepository, 'getByFontIconTypeIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($fontIcon, $fontIconServiceResponseList);
    }

}
