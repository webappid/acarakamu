<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\Image;
use App\Repositories\ImageRepository;
use App\Repositories\Requests\ImageRepositoryRequest;
use App\Services\Requests\ImageServiceRequest;
use App\Services\Responses\ImageServiceResponse;
use App\Services\Responses\ImageServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:08
 * Time: 2022/09/14
 * Class ImageServiceTrait
 * @package App\Services
 */
trait ImageServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(ImageServiceRequest $imageServiceRequest, ImageRepositoryRequest $imageRepositoryRequest, ImageRepository $imageRepository, ImageServiceResponse $imageServiceResponse): ImageServiceResponse
    {
        $imageRepositoryRequest = Lazy::transform($imageServiceRequest, $imageRepositoryRequest);

        $result = app()->call([$imageRepository, 'store'], ['imageRepositoryRequest' => $imageRepositoryRequest]);
        if ($result != null) {
            $imageServiceResponse->status = true;
            $imageServiceResponse->message = 'Store Data Success';
            $imageServiceResponse->image = $result;
        } else {
            $imageServiceResponse->status = false;
            $imageServiceResponse->message = 'Store Data Failed';
        }

        return $imageServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $imageId, ImageServiceRequest $imageServiceRequest, ImageRepositoryRequest $imageRepositoryRequest, ImageRepository $imageRepository, ImageServiceResponse $imageServiceResponse): ImageServiceResponse
    {
        $imageRepositoryRequest = Lazy::transform($imageServiceRequest, $imageRepositoryRequest);

        $result = app()->call([$imageRepository, 'update'], ['imageId' => $imageId, 'imageRepositoryRequest' => $imageRepositoryRequest]);
        if ($result != null) {
            $imageServiceResponse->status = true;
            $imageServiceResponse->message = 'Update Data Success';
            $imageServiceResponse->image = $result;
        } else {
            $imageServiceResponse->status = false;
            $imageServiceResponse->message = 'Update Data Failed';
        }

        return $imageServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $imageId, ImageRepository $imageRepository, ImageServiceResponse $imageServiceResponse): ImageServiceResponse
    {
        $status = app()->call([$imageRepository, 'delete'], compact('imageId'));
        $imageServiceResponse->status = $status;
        if($status){
            $imageServiceResponse->message = "Delete Success";
        }else{
            $imageServiceResponse->message = "Delete Failed";
        }

        return $imageServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param ImageServiceResponseList $imageServiceResponseList
     * @return ImageServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, ImageServiceResponseList $imageServiceResponseList): ImageServiceResponseList{
        if (count($result) > 0) {
            $imageServiceResponseList->status = true;
            $imageServiceResponseList->message = 'Data Found';
            $imageServiceResponseList->imageList = $result;
            $imageServiceResponseList->count = $result->total();
            $imageServiceResponseList->countFiltered = $result->count();
        } else {
            $imageServiceResponseList->status = false;
            $imageServiceResponseList->message = 'Data Not Found';
        }
        return $imageServiceResponseList;
    }

    /**
     * @param Image|null $image
     * @param ImageServiceResponse $imageServiceResponse
     * @return ImageServiceResponse
     */
    private function formatResult(?Image $image, ImageServiceResponse $imageServiceResponse): ImageServiceResponse{
        if($image == null){
            $imageServiceResponse->status = false;
            $imageServiceResponse->message = "Data Not Found";
        }else{
            $imageServiceResponse->status = true;
            $imageServiceResponse->message = "Data Found";
            $imageServiceResponse->image = $image;
        }

        return $imageServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(ImageRepository $imageRepository, ImageServiceResponseList $imageServiceResponseList, int $length = 12, string $q = null): ImageServiceResponseList
    {
        $result = app()->call([$imageRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $imageServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(ImageRepository $imageRepository, string $q = null): int
    {
        return app()->call([$imageRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByImageId(int $imageId, ImageRepository $imageRepository, ImageServiceResponse $imageServiceResponse): ImageServiceResponse
    {
        $image = app()->call([$imageRepository, 'getByImageId'], compact('imageId'));
        return $this->formatResult($image, $imageServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByImageIdList(int $imageId, ImageRepository $imageRepository, ImageServiceResponseList $imageServiceResponseList, string $q = null,  int $length = 12): ImageServiceResponseList
    {
        $image = app()->call([$imageRepository, 'getByImageIdList'], compact('imageId', 'length', 'q'));
        return $this->formatResultList($image, $imageServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserName(string $userName, ImageRepository $imageRepository, ImageServiceResponse $imageServiceResponse): ImageServiceResponse
    {
        $image = app()->call([$imageRepository, 'getBySfUserUserName'], compact('userName'));
        return $this->formatResult($image, $imageServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserNameList(string $userName, ImageRepository $imageRepository, ImageServiceResponseList $imageServiceResponseList, string $q = null,  int $length = 12): ImageServiceResponseList
    {
        $image = app()->call([$imageRepository, 'getBySfUserUserNameList'], compact('userName', 'length', 'q'));
        return $this->formatResultList($image, $imageServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserId(int $userId, ImageRepository $imageRepository, ImageServiceResponse $imageServiceResponse): ImageServiceResponse
    {
        $image = app()->call([$imageRepository, 'getBySfUserUserId'], compact('userId'));
        return $this->formatResult($image, $imageServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserIdList(int $userId, ImageRepository $imageRepository, ImageServiceResponseList $imageServiceResponseList, string $q = null,  int $length = 12): ImageServiceResponseList
    {
        $image = app()->call([$imageRepository, 'getBySfUserUserIdList'], compact('userId', 'length', 'q'));
        return $this->formatResultList($image, $imageServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByImageOwnerUserIdSfUserUserName(string $userName, ImageRepository $imageRepository, ImageServiceResponse $imageServiceResponse): ImageServiceResponse
    {
        $image = app()->call([$imageRepository, 'getByImageOwnerUserIdSfUserUserName'], compact('userName'));
        return $this->formatResult($image, $imageServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByImageOwnerUserIdSfUserUserNameList(string $userName, ImageRepository $imageRepository, ImageServiceResponseList $imageServiceResponseList, string $q = null,  int $length = 12): ImageServiceResponseList
    {
        $image = app()->call([$imageRepository, 'getByImageOwnerUserIdSfUserUserNameList'], compact('userName', 'length', 'q'));
        return $this->formatResultList($image, $imageServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByImageOwnerUserIdSfUserUserId(int $userId, ImageRepository $imageRepository, ImageServiceResponse $imageServiceResponse): ImageServiceResponse
    {
        $image = app()->call([$imageRepository, 'getByImageOwnerUserIdSfUserUserId'], compact('userId'));
        return $this->formatResult($image, $imageServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByImageOwnerUserIdSfUserUserIdList(int $userId, ImageRepository $imageRepository, ImageServiceResponseList $imageServiceResponseList, string $q = null,  int $length = 12): ImageServiceResponseList
    {
        $image = app()->call([$imageRepository, 'getByImageOwnerUserIdSfUserUserIdList'], compact('userId', 'length', 'q'));
        return $this->formatResultList($image, $imageServiceResponseList);
    }

}
