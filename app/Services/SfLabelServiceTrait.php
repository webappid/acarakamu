<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\SfLabel;
use App\Repositories\Requests\SfLabelRepositoryRequest;
use App\Repositories\SfLabelRepository;
use App\Services\Requests\SfLabelServiceRequest;
use App\Services\Responses\SfLabelServiceResponse;
use App\Services\Responses\SfLabelServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:28
 * Time: 2022/09/14
 * Class SfLabelServiceTrait
 * @package App\Services
 */
trait SfLabelServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(SfLabelServiceRequest $sfLabelServiceRequest, SfLabelRepositoryRequest $sfLabelRepositoryRequest, SfLabelRepository $sfLabelRepository, SfLabelServiceResponse $sfLabelServiceResponse): SfLabelServiceResponse
    {
        $sfLabelRepositoryRequest = Lazy::transform($sfLabelServiceRequest, $sfLabelRepositoryRequest);

        $result = app()->call([$sfLabelRepository, 'store'], ['sfLabelRepositoryRequest' => $sfLabelRepositoryRequest]);
        if ($result != null) {
            $sfLabelServiceResponse->status = true;
            $sfLabelServiceResponse->message = 'Store Data Success';
            $sfLabelServiceResponse->sfLabel = $result;
        } else {
            $sfLabelServiceResponse->status = false;
            $sfLabelServiceResponse->message = 'Store Data Failed';
        }

        return $sfLabelServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $labelId, SfLabelServiceRequest $sfLabelServiceRequest, SfLabelRepositoryRequest $sfLabelRepositoryRequest, SfLabelRepository $sfLabelRepository, SfLabelServiceResponse $sfLabelServiceResponse): SfLabelServiceResponse
    {
        $sfLabelRepositoryRequest = Lazy::transform($sfLabelServiceRequest, $sfLabelRepositoryRequest);

        $result = app()->call([$sfLabelRepository, 'update'], ['labelId' => $labelId, 'sfLabelRepositoryRequest' => $sfLabelRepositoryRequest]);
        if ($result != null) {
            $sfLabelServiceResponse->status = true;
            $sfLabelServiceResponse->message = 'Update Data Success';
            $sfLabelServiceResponse->sfLabel = $result;
        } else {
            $sfLabelServiceResponse->status = false;
            $sfLabelServiceResponse->message = 'Update Data Failed';
        }

        return $sfLabelServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $labelId, SfLabelRepository $sfLabelRepository, SfLabelServiceResponse $sfLabelServiceResponse): SfLabelServiceResponse
    {
        $status = app()->call([$sfLabelRepository, 'delete'], compact('labelId'));
        $sfLabelServiceResponse->status = $status;
        if($status){
            $sfLabelServiceResponse->message = "Delete Success";
        }else{
            $sfLabelServiceResponse->message = "Delete Failed";
        }

        return $sfLabelServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param SfLabelServiceResponseList $sfLabelServiceResponseList
     * @return SfLabelServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, SfLabelServiceResponseList $sfLabelServiceResponseList): SfLabelServiceResponseList{
        if (count($result) > 0) {
            $sfLabelServiceResponseList->status = true;
            $sfLabelServiceResponseList->message = 'Data Found';
            $sfLabelServiceResponseList->sfLabelList = $result;
            $sfLabelServiceResponseList->count = $result->total();
            $sfLabelServiceResponseList->countFiltered = $result->count();
        } else {
            $sfLabelServiceResponseList->status = false;
            $sfLabelServiceResponseList->message = 'Data Not Found';
        }
        return $sfLabelServiceResponseList;
    }

    /**
     * @param SfLabel|null $sfLabel
     * @param SfLabelServiceResponse $sfLabelServiceResponse
     * @return SfLabelServiceResponse
     */
    private function formatResult(?SfLabel $sfLabel, SfLabelServiceResponse $sfLabelServiceResponse): SfLabelServiceResponse{
        if($sfLabel == null){
            $sfLabelServiceResponse->status = false;
            $sfLabelServiceResponse->message = "Data Not Found";
        }else{
            $sfLabelServiceResponse->status = true;
            $sfLabelServiceResponse->message = "Data Found";
            $sfLabelServiceResponse->sfLabel = $sfLabel;
        }

        return $sfLabelServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(SfLabelRepository $sfLabelRepository, SfLabelServiceResponseList $sfLabelServiceResponseList, int $length = 12, string $q = null): SfLabelServiceResponseList
    {
        $result = app()->call([$sfLabelRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $sfLabelServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(SfLabelRepository $sfLabelRepository, string $q = null): int
    {
        return app()->call([$sfLabelRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByLanguageId(int $languageId, SfLabelRepository $sfLabelRepository, SfLabelServiceResponse $sfLabelServiceResponse): SfLabelServiceResponse
    {
        $sfLabel = app()->call([$sfLabelRepository, 'getByLanguageId'], compact('languageId'));
        return $this->formatResult($sfLabel, $sfLabelServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByLanguageIdList(int $languageId, SfLabelRepository $sfLabelRepository, SfLabelServiceResponseList $sfLabelServiceResponseList, string $q = null,  int $length = 12): SfLabelServiceResponseList
    {
        $sfLabel = app()->call([$sfLabelRepository, 'getByLanguageIdList'], compact('languageId', 'length', 'q'));
        return $this->formatResultList($sfLabel, $sfLabelServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserId(int $userId, SfLabelRepository $sfLabelRepository, SfLabelServiceResponse $sfLabelServiceResponse): SfLabelServiceResponse
    {
        $sfLabel = app()->call([$sfLabelRepository, 'getByUserId'], compact('userId'));
        return $this->formatResult($sfLabel, $sfLabelServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserIdList(int $userId, SfLabelRepository $sfLabelRepository, SfLabelServiceResponseList $sfLabelServiceResponseList, string $q = null,  int $length = 12): SfLabelServiceResponseList
    {
        $sfLabel = app()->call([$sfLabelRepository, 'getByUserIdList'], compact('userId', 'length', 'q'));
        return $this->formatResultList($sfLabel, $sfLabelServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByLabelId(int $labelId, SfLabelRepository $sfLabelRepository, SfLabelServiceResponse $sfLabelServiceResponse): SfLabelServiceResponse
    {
        $sfLabel = app()->call([$sfLabelRepository, 'getByLabelId'], compact('labelId'));
        return $this->formatResult($sfLabel, $sfLabelServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByLabelIdList(int $labelId, SfLabelRepository $sfLabelRepository, SfLabelServiceResponseList $sfLabelServiceResponseList, string $q = null,  int $length = 12): SfLabelServiceResponseList
    {
        $sfLabel = app()->call([$sfLabelRepository, 'getByLabelIdList'], compact('labelId', 'length', 'q'));
        return $this->formatResultList($sfLabel, $sfLabelServiceResponseList);
    }

}
