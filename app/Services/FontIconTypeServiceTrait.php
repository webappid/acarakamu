<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\FontIconType;
use App\Repositories\FontIconTypeRepository;
use App\Repositories\Requests\FontIconTypeRepositoryRequest;
use App\Services\Requests\FontIconTypeServiceRequest;
use App\Services\Responses\FontIconTypeServiceResponse;
use App\Services\Responses\FontIconTypeServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 14:04:13
 * Time: 2021/11/06
 * Class FontIconTypeServiceTrait
 * @package App\Services
 */
trait FontIconTypeServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(FontIconTypeServiceRequest $fontIconTypeServiceRequest, FontIconTypeRepositoryRequest $fontIconTypeRepositoryRequest, FontIconTypeRepository $fontIconTypeRepository, FontIconTypeServiceResponse $fontIconTypeServiceResponse): FontIconTypeServiceResponse
    {
        $fontIconTypeRepositoryRequest = Lazy::transform($fontIconTypeServiceRequest, $fontIconTypeRepositoryRequest);

        $result = app()->call([$fontIconTypeRepository, 'store'], ['fontIconTypeRepositoryRequest' => $fontIconTypeRepositoryRequest]);
        if ($result != null) {
            $fontIconTypeServiceResponse->status = true;
            $fontIconTypeServiceResponse->message = 'Store Data Success';
            $fontIconTypeServiceResponse->fontIconType = $result;
        } else {
            $fontIconTypeServiceResponse->status = false;
            $fontIconTypeServiceResponse->message = 'Store Data Failed';
        }

        return $fontIconTypeServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(string $name, FontIconTypeServiceRequest $fontIconTypeServiceRequest, FontIconTypeRepositoryRequest $fontIconTypeRepositoryRequest, FontIconTypeRepository $fontIconTypeRepository, FontIconTypeServiceResponse $fontIconTypeServiceResponse): FontIconTypeServiceResponse
    {
        $fontIconTypeRepositoryRequest = Lazy::transform($fontIconTypeServiceRequest, $fontIconTypeRepositoryRequest);

        $result = app()->call([$fontIconTypeRepository, 'update'], ['name' => $name, 'fontIconTypeRepositoryRequest' => $fontIconTypeRepositoryRequest]);
        if ($result != null) {
            $fontIconTypeServiceResponse->status = true;
            $fontIconTypeServiceResponse->message = 'Update Data Success';
            $fontIconTypeServiceResponse->fontIconType = $result;
        } else {
            $fontIconTypeServiceResponse->status = false;
            $fontIconTypeServiceResponse->message = 'Update Data Failed';
        }

        return $fontIconTypeServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $name, FontIconTypeRepository $fontIconTypeRepository, FontIconTypeServiceResponse $fontIconTypeServiceResponse): FontIconTypeServiceResponse
    {
        $status = app()->call([$fontIconTypeRepository, 'delete'], compact('name'));
        $fontIconTypeServiceResponse->status = $status;
        if($status){
            $fontIconTypeServiceResponse->message = "Delete Success";
        }else{
            $fontIconTypeServiceResponse->message = "Delete Failed";
        }

        return $fontIconTypeServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param FontIconTypeServiceResponseList $fontIconTypeServiceResponseList
     * @return FontIconTypeServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, FontIconTypeServiceResponseList $fontIconTypeServiceResponseList): FontIconTypeServiceResponseList{
        if (count($result) > 0) {
            $fontIconTypeServiceResponseList->status = true;
            $fontIconTypeServiceResponseList->message = 'Data Found';
            $fontIconTypeServiceResponseList->fontIconTypeList = $result;
            $fontIconTypeServiceResponseList->count = $result->total();
            $fontIconTypeServiceResponseList->countFiltered = $result->count();
        } else {
            $fontIconTypeServiceResponseList->status = false;
            $fontIconTypeServiceResponseList->message = 'Data Not Found';
        }
        return $fontIconTypeServiceResponseList;
    }

    /**
     * @param FontIconType|null $fontIconType
     * @param FontIconTypeServiceResponse $fontIconTypeServiceResponse
     * @return FontIconTypeServiceResponse
     */
    private function formatResult(?FontIconType $fontIconType, FontIconTypeServiceResponse $fontIconTypeServiceResponse): FontIconTypeServiceResponse{
        if($fontIconType == null){
            $fontIconTypeServiceResponse->status = false;
            $fontIconTypeServiceResponse->message = "Data Not Found";
        }else{
            $fontIconTypeServiceResponse->status = true;
            $fontIconTypeServiceResponse->message = "Data Found";
            $fontIconTypeServiceResponse->fontIconType = $fontIconType;
        }

        return $fontIconTypeServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(FontIconTypeRepository $fontIconTypeRepository, FontIconTypeServiceResponseList $fontIconTypeServiceResponseList, int $length = 12, string $q = null): FontIconTypeServiceResponseList
    {
        $result = app()->call([$fontIconTypeRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $fontIconTypeServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(FontIconTypeRepository $fontIconTypeRepository, string $q = null): int
    {
        return app()->call([$fontIconTypeRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByName(string $name, FontIconTypeRepository $fontIconTypeRepository, FontIconTypeServiceResponse $fontIconTypeServiceResponse): FontIconTypeServiceResponse
    {
        $fontIconType = app()->call([$fontIconTypeRepository, 'getByName'], compact('name'));
        return $this->formatResult($fontIconType, $fontIconTypeServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByNameList(string $name, FontIconTypeRepository $fontIconTypeRepository, FontIconTypeServiceResponseList $fontIconTypeServiceResponseList, string $q = null,  int $length = 12): FontIconTypeServiceResponseList
    {
        $fontIconType = app()->call([$fontIconTypeRepository, 'getByNameList'], compact('name', 'length', 'q'));
        return $this->formatResultList($fontIconType, $fontIconTypeServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id, FontIconTypeRepository $fontIconTypeRepository, FontIconTypeServiceResponse $fontIconTypeServiceResponse): FontIconTypeServiceResponse
    {
        $fontIconType = app()->call([$fontIconTypeRepository, 'getById'], compact('id'));
        return $this->formatResult($fontIconType, $fontIconTypeServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, FontIconTypeRepository $fontIconTypeRepository, FontIconTypeServiceResponseList $fontIconTypeServiceResponseList, string $q = null,  int $length = 12): FontIconTypeServiceResponseList
    {
        $fontIconType = app()->call([$fontIconTypeRepository, 'getByIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($fontIconType, $fontIconTypeServiceResponseList);
    }

}
