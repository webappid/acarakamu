<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\CityRef;
use App\Repositories\Requests\CityRefRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:03:59
 * Time: 2022/09/14
 * Trait CityRefRepositoryTrait
 * @package App\Repositories
 */
trait CityRefRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $sf_user = app()->make(Join::class);
        $sf_user->class = SfUser::class;
        $sf_user->foreign = 'city_ref.cityUserId';
        $sf_user->type = 'inner';
        $sf_user->primary = 'sf_user.userId';
        $this->joinTable['sf_user'] = $sf_user;

        $provinces_ref = app()->make(Join::class);
        $provinces_ref->class = ProvincesRef::class;
        $provinces_ref->foreign = 'city_ref.cityProvincesRefId';
        $provinces_ref->type = 'inner';
        $provinces_ref->primary = 'provinces_ref.provincesRefId';
        $this->joinTable['provinces_ref'] = $provinces_ref;

    }

    /**
     * @inheritDoc
     */
    public function store(CityRefRepositoryRequest $cityRefRepositoryRequest, CityRef $cityRef): ?CityRef
    {
        try {
            $cityRef = Lazy::transform($cityRefRepositoryRequest, $cityRef);
            $cityRef->save();
            return $cityRef;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $cityId, CityRefRepositoryRequest $cityRefRepositoryRequest, CityRef $cityRef): ?CityRef
    {
        $cityRef = $cityRef->where('cityId', $cityId)->first();
        if($cityRef != null){
            try {
                $cityRef = Lazy::transform($cityRefRepositoryRequest, $cityRef);
                $cityRef->save();
                return $cityRef;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $cityRef;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $cityId, CityRef $cityRef): bool
    {
        $cityRef = $cityRef->where('city_ref.cityId',$cityId)->first();
        if($cityRef!=null){
            return $cityRef->delete();
        }else{
            return false;
        }
    }

    /**
     * @param Builder $query
     * @param string $q
     * @return Builder
     */
    protected Function getFilter(Builder $query, string $q)
    {
        return $query->where(function($query) use ($q){
            return $query;
        });

    }

    /**
     * @inheritDoc
     */
    public function get(CityRef $cityRef, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($cityRef)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->paginate($length, $this->getColumn())
            ->appends(request()->all());
    }

    /**
     * @inheritDoc
     */
    public function getCount(CityRef $cityRef, string $q = null): int
    {
        return $this
            ->getJoin($cityRef)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->count();
    }

        /**
     * @inheritDoc
     */
    public function getByCityId(int $cityId, CityRef $cityRef):? CityRef
    {
        return $this
            ->getJoin($cityRef)
            ->where('city_ref.cityId', '=', $cityId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByCityIdList(int $cityId, CityRef $cityRef, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($cityRef)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('city_ref.cityId', '=', $cityId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserName(string $userName, CityRef $cityRef):? CityRef
    {
        return $this
            ->getJoin($cityRef)
            ->where('sf_user.userName', '=', $userName )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserNameList(string $userName, CityRef $cityRef, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($cityRef)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_user.userName', '=', $userName )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserId(int $userId, CityRef $cityRef):? CityRef
    {
        return $this
            ->getJoin($cityRef)
            ->where('sf_user.userId', '=', $userId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserIdList(int $userId, CityRef $cityRef, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($cityRef)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_user.userId', '=', $userId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByProvincesRefProvincesRefId(int $provincesRefId, CityRef $cityRef):? CityRef
    {
        return $this
            ->getJoin($cityRef)
            ->where('provinces_ref.provincesRefId', '=', $provincesRefId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByProvincesRefProvincesRefIdList(int $provincesRefId, CityRef $cityRef, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($cityRef)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('provinces_ref.provincesRefId', '=', $provincesRefId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
