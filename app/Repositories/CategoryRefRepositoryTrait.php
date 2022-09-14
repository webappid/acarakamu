<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\CategoryRef;
use App\Repositories\Requests\CategoryRefRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:03:58
 * Time: 2022/09/14
 * Trait CategoryRefRepositoryTrait
 * @package App\Repositories
 */
trait CategoryRefRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $sf_user = app()->make(Join::class);
        $sf_user->class = SfUser::class;
        $sf_user->foreign = 'category_ref.categoryUserId';
        $sf_user->type = 'inner';
        $sf_user->primary = 'sf_user.userId';
        $this->joinTable['sf_user'] = $sf_user;

    }

    /**
     * @inheritDoc
     */
    public function store(CategoryRefRepositoryRequest $categoryRefRepositoryRequest, CategoryRef $categoryRef): ?CategoryRef
    {
        try {
            $categoryRef = Lazy::transform($categoryRefRepositoryRequest, $categoryRef);
            $categoryRef->save();
            return $categoryRef;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $categoryId, CategoryRefRepositoryRequest $categoryRefRepositoryRequest, CategoryRef $categoryRef): ?CategoryRef
    {
        $categoryRef = $categoryRef->where('categoryId', $categoryId)->first();
        if($categoryRef != null){
            try {
                $categoryRef = Lazy::transform($categoryRefRepositoryRequest, $categoryRef);
                $categoryRef->save();
                return $categoryRef;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $categoryRef;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $categoryId, CategoryRef $categoryRef): bool
    {
        $categoryRef = $categoryRef->where('category_ref.categoryId',$categoryId)->first();
        if($categoryRef!=null){
            return $categoryRef->delete();
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
    public function get(CategoryRef $categoryRef, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($categoryRef)
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
    public function getCount(CategoryRef $categoryRef, string $q = null): int
    {
        return $this
            ->getJoin($categoryRef)
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
    public function getByCategoryId(int $categoryId, CategoryRef $categoryRef):? CategoryRef
    {
        return $this
            ->getJoin($categoryRef)
            ->where('category_ref.categoryId', '=', $categoryId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByCategoryIdList(int $categoryId, CategoryRef $categoryRef, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($categoryRef)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('category_ref.categoryId', '=', $categoryId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserName(string $userName, CategoryRef $categoryRef):? CategoryRef
    {
        return $this
            ->getJoin($categoryRef)
            ->where('sf_user.userName', '=', $userName )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserNameList(string $userName, CategoryRef $categoryRef, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($categoryRef)
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
    public function getBySfUserUserId(int $userId, CategoryRef $categoryRef):? CategoryRef
    {
        return $this
            ->getJoin($categoryRef)
            ->where('sf_user.userId', '=', $userId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserIdList(int $userId, CategoryRef $categoryRef, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($categoryRef)
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
