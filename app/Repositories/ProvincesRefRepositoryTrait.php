<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\ProvincesRef;
use App\Repositories\Requests\ProvincesRefRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:19
 * Time: 2022/09/14
 * Trait ProvincesRefRepositoryTrait
 * @package App\Repositories
 */
trait ProvincesRefRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $sf_user = app()->make(Join::class);
        $sf_user->class = SfUser::class;
        $sf_user->foreign = 'provinces_ref.provincesRefUserId';
        $sf_user->type = 'inner';
        $sf_user->primary = 'sf_user.userId';
        $this->joinTable['sf_user'] = $sf_user;

    }

    /**
     * @inheritDoc
     */
    public function store(ProvincesRefRepositoryRequest $provincesRefRepositoryRequest, ProvincesRef $provincesRef): ?ProvincesRef
    {
        try {
            $provincesRef = Lazy::transform($provincesRefRepositoryRequest, $provincesRef);
            $provincesRef->save();
            return $provincesRef;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $provincesRefId, ProvincesRefRepositoryRequest $provincesRefRepositoryRequest, ProvincesRef $provincesRef): ?ProvincesRef
    {
        $provincesRef = $provincesRef->where('provincesRefId', $provincesRefId)->first();
        if($provincesRef != null){
            try {
                $provincesRef = Lazy::transform($provincesRefRepositoryRequest, $provincesRef);
                $provincesRef->save();
                return $provincesRef;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $provincesRef;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $provincesRefId, ProvincesRef $provincesRef): bool
    {
        $provincesRef = $provincesRef->where('provinces_ref.provincesRefId',$provincesRefId)->first();
        if($provincesRef!=null){
            return $provincesRef->delete();
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
    public function get(ProvincesRef $provincesRef, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($provincesRef)
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
    public function getCount(ProvincesRef $provincesRef, string $q = null): int
    {
        return $this
            ->getJoin($provincesRef)
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
    public function getByProvincesRefId(int $provincesRefId, ProvincesRef $provincesRef):? ProvincesRef
    {
        return $this
            ->getJoin($provincesRef)
            ->where('provinces_ref.provincesRefId', '=', $provincesRefId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByProvincesRefIdList(int $provincesRefId, ProvincesRef $provincesRef, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($provincesRef)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('provinces_ref.provincesRefId', '=', $provincesRefId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserName(string $userName, ProvincesRef $provincesRef):? ProvincesRef
    {
        return $this
            ->getJoin($provincesRef)
            ->where('sf_user.userName', '=', $userName )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserNameList(string $userName, ProvincesRef $provincesRef, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($provincesRef)
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
    public function getBySfUserUserId(int $userId, ProvincesRef $provincesRef):? ProvincesRef
    {
        return $this
            ->getJoin($provincesRef)
            ->where('sf_user.userId', '=', $userId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserIdList(int $userId, ProvincesRef $provincesRef, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($provincesRef)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_user.userId', '=', $userId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
