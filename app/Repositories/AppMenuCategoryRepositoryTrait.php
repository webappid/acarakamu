<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\AppMenuCategory;
use App\Repositories\Requests\AppMenuCategoryRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 14:03:57
 * Time: 2021/11/06
 * Trait AppMenuCategoryRepositoryTrait
 * @package App\Repositories
 */
trait AppMenuCategoryRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){

    }

    /**
     * @inheritDoc
     */
    public function store(AppMenuCategoryRepositoryRequest $appMenuCategoryRepositoryRequest, AppMenuCategory $appMenuCategory): ?AppMenuCategory
    {
        try {
            $appMenuCategory = Lazy::transform($appMenuCategoryRepositoryRequest, $appMenuCategory);
            $appMenuCategory->save();
            return $appMenuCategory;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(string $name, AppMenuCategoryRepositoryRequest $appMenuCategoryRepositoryRequest, AppMenuCategory $appMenuCategory): ?AppMenuCategory
    {
        $appMenuCategory = $appMenuCategory->where('name', $name)->first();
        if($appMenuCategory != null){
            try {
                $appMenuCategory = Lazy::transform($appMenuCategoryRepositoryRequest, $appMenuCategory);
                $appMenuCategory->save();
                return $appMenuCategory;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $appMenuCategory;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $name, AppMenuCategory $appMenuCategory): bool
    {
        $appMenuCategory = $appMenuCategory->where('app_menu_categories.name',$name)->first();
        if($appMenuCategory!=null){
            return $appMenuCategory->delete();
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
            return $query->where('app_menu_categories.name', 'LIKE', '%' . $q . '%');
        });

    }

    /**
     * @inheritDoc
     */
    public function get(AppMenuCategory $appMenuCategory, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($appMenuCategory)
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
    public function getCount(AppMenuCategory $appMenuCategory, string $q = null): int
    {
        return $this
            ->getJoin($appMenuCategory)
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
    public function getByName(string $name, AppMenuCategory $appMenuCategory):? AppMenuCategory
    {
        return $this
            ->getJoin($appMenuCategory)
            ->where('app_menu_categories.name', '=', $name )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByNameList(string $name, AppMenuCategory $appMenuCategory, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appMenuCategory)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('app_menu_categories.name', '=', $name )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id, AppMenuCategory $appMenuCategory):? AppMenuCategory
    {
        return $this
            ->getJoin($appMenuCategory)
            ->where('app_menu_categories.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, AppMenuCategory $appMenuCategory, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appMenuCategory)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('app_menu_categories.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
