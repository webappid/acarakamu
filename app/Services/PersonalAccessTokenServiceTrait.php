<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\PersonalAccessToken;
use App\Repositories\PersonalAccessTokenRepository;
use App\Repositories\Requests\PersonalAccessTokenRepositoryRequest;
use App\Services\Requests\PersonalAccessTokenServiceRequest;
use App\Services\Responses\PersonalAccessTokenServiceResponse;
use App\Services\Responses\PersonalAccessTokenServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:18
 * Time: 2022/09/14
 * Class PersonalAccessTokenServiceTrait
 * @package App\Services
 */
trait PersonalAccessTokenServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(PersonalAccessTokenServiceRequest $personalAccessTokenServiceRequest, PersonalAccessTokenRepositoryRequest $personalAccessTokenRepositoryRequest, PersonalAccessTokenRepository $personalAccessTokenRepository, PersonalAccessTokenServiceResponse $personalAccessTokenServiceResponse): PersonalAccessTokenServiceResponse
    {
        $personalAccessTokenRepositoryRequest = Lazy::transform($personalAccessTokenServiceRequest, $personalAccessTokenRepositoryRequest);

        $result = app()->call([$personalAccessTokenRepository, 'store'], ['personalAccessTokenRepositoryRequest' => $personalAccessTokenRepositoryRequest]);
        if ($result != null) {
            $personalAccessTokenServiceResponse->status = true;
            $personalAccessTokenServiceResponse->message = 'Store Data Success';
            $personalAccessTokenServiceResponse->personalAccessToken = $result;
        } else {
            $personalAccessTokenServiceResponse->status = false;
            $personalAccessTokenServiceResponse->message = 'Store Data Failed';
        }

        return $personalAccessTokenServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(string $token, PersonalAccessTokenServiceRequest $personalAccessTokenServiceRequest, PersonalAccessTokenRepositoryRequest $personalAccessTokenRepositoryRequest, PersonalAccessTokenRepository $personalAccessTokenRepository, PersonalAccessTokenServiceResponse $personalAccessTokenServiceResponse): PersonalAccessTokenServiceResponse
    {
        $personalAccessTokenRepositoryRequest = Lazy::transform($personalAccessTokenServiceRequest, $personalAccessTokenRepositoryRequest);

        $result = app()->call([$personalAccessTokenRepository, 'update'], ['token' => $token, 'personalAccessTokenRepositoryRequest' => $personalAccessTokenRepositoryRequest]);
        if ($result != null) {
            $personalAccessTokenServiceResponse->status = true;
            $personalAccessTokenServiceResponse->message = 'Update Data Success';
            $personalAccessTokenServiceResponse->personalAccessToken = $result;
        } else {
            $personalAccessTokenServiceResponse->status = false;
            $personalAccessTokenServiceResponse->message = 'Update Data Failed';
        }

        return $personalAccessTokenServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $token, PersonalAccessTokenRepository $personalAccessTokenRepository, PersonalAccessTokenServiceResponse $personalAccessTokenServiceResponse): PersonalAccessTokenServiceResponse
    {
        $status = app()->call([$personalAccessTokenRepository, 'delete'], compact('token'));
        $personalAccessTokenServiceResponse->status = $status;
        if($status){
            $personalAccessTokenServiceResponse->message = "Delete Success";
        }else{
            $personalAccessTokenServiceResponse->message = "Delete Failed";
        }

        return $personalAccessTokenServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param PersonalAccessTokenServiceResponseList $personalAccessTokenServiceResponseList
     * @return PersonalAccessTokenServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, PersonalAccessTokenServiceResponseList $personalAccessTokenServiceResponseList): PersonalAccessTokenServiceResponseList{
        if (count($result) > 0) {
            $personalAccessTokenServiceResponseList->status = true;
            $personalAccessTokenServiceResponseList->message = 'Data Found';
            $personalAccessTokenServiceResponseList->personalAccessTokenList = $result;
            $personalAccessTokenServiceResponseList->count = $result->total();
            $personalAccessTokenServiceResponseList->countFiltered = $result->count();
        } else {
            $personalAccessTokenServiceResponseList->status = false;
            $personalAccessTokenServiceResponseList->message = 'Data Not Found';
        }
        return $personalAccessTokenServiceResponseList;
    }

    /**
     * @param PersonalAccessToken|null $personalAccessToken
     * @param PersonalAccessTokenServiceResponse $personalAccessTokenServiceResponse
     * @return PersonalAccessTokenServiceResponse
     */
    private function formatResult(?PersonalAccessToken $personalAccessToken, PersonalAccessTokenServiceResponse $personalAccessTokenServiceResponse): PersonalAccessTokenServiceResponse{
        if($personalAccessToken == null){
            $personalAccessTokenServiceResponse->status = false;
            $personalAccessTokenServiceResponse->message = "Data Not Found";
        }else{
            $personalAccessTokenServiceResponse->status = true;
            $personalAccessTokenServiceResponse->message = "Data Found";
            $personalAccessTokenServiceResponse->personalAccessToken = $personalAccessToken;
        }

        return $personalAccessTokenServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(PersonalAccessTokenRepository $personalAccessTokenRepository, PersonalAccessTokenServiceResponseList $personalAccessTokenServiceResponseList, int $length = 12, string $q = null): PersonalAccessTokenServiceResponseList
    {
        $result = app()->call([$personalAccessTokenRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $personalAccessTokenServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(PersonalAccessTokenRepository $personalAccessTokenRepository, string $q = null): int
    {
        return app()->call([$personalAccessTokenRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByTokenableTypeTokenableId(string $tokenableType, int $tokenableId, PersonalAccessTokenRepository $personalAccessTokenRepository, PersonalAccessTokenServiceResponse $personalAccessTokenServiceResponse): PersonalAccessTokenServiceResponse
    {
        $personalAccessToken = app()->call([$personalAccessTokenRepository, 'getByTokenableTypeTokenableId'], compact('tokenableType', 'tokenableId'));
        return $this->formatResult($personalAccessToken, $personalAccessTokenServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByTokenableTypeTokenableIdList(string $tokenableType, int $tokenableId, PersonalAccessTokenRepository $personalAccessTokenRepository, PersonalAccessTokenServiceResponseList $personalAccessTokenServiceResponseList, string $q = null,  int $length = 12): PersonalAccessTokenServiceResponseList
    {
        $personalAccessToken = app()->call([$personalAccessTokenRepository, 'getByTokenableTypeTokenableIdList'], compact('tokenableType', 'tokenableId', 'length', 'q'));
        return $this->formatResultList($personalAccessToken, $personalAccessTokenServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByToken(string $token, PersonalAccessTokenRepository $personalAccessTokenRepository, PersonalAccessTokenServiceResponse $personalAccessTokenServiceResponse): PersonalAccessTokenServiceResponse
    {
        $personalAccessToken = app()->call([$personalAccessTokenRepository, 'getByToken'], compact('token'));
        return $this->formatResult($personalAccessToken, $personalAccessTokenServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByTokenList(string $token, PersonalAccessTokenRepository $personalAccessTokenRepository, PersonalAccessTokenServiceResponseList $personalAccessTokenServiceResponseList, string $q = null,  int $length = 12): PersonalAccessTokenServiceResponseList
    {
        $personalAccessToken = app()->call([$personalAccessTokenRepository, 'getByTokenList'], compact('token', 'length', 'q'));
        return $this->formatResultList($personalAccessToken, $personalAccessTokenServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id, PersonalAccessTokenRepository $personalAccessTokenRepository, PersonalAccessTokenServiceResponse $personalAccessTokenServiceResponse): PersonalAccessTokenServiceResponse
    {
        $personalAccessToken = app()->call([$personalAccessTokenRepository, 'getById'], compact('id'));
        return $this->formatResult($personalAccessToken, $personalAccessTokenServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, PersonalAccessTokenRepository $personalAccessTokenRepository, PersonalAccessTokenServiceResponseList $personalAccessTokenServiceResponseList, string $q = null,  int $length = 12): PersonalAccessTokenServiceResponseList
    {
        $personalAccessToken = app()->call([$personalAccessTokenRepository, 'getByIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($personalAccessToken, $personalAccessTokenServiceResponseList);
    }

}
