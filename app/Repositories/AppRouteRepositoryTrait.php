<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\AppRoute;
use App\Repositories\Requests\AppRouteRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 14:04:02
 * Time: 2021/11/06
 * Trait AppRouteRepositoryTrait
 * @package App\Repositories
 */
trait AppRouteRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){

    }

    /**
     * @inheritDoc
     */
    public function store(AppRouteRepositoryRequest $appRouteRepositoryRequest, AppRoute $appRoute): ?AppRoute
    {
        try {
            $appRoute = Lazy::transform($appRouteRepositoryRequest, $appRoute);
            $appRoute->save();
            return $appRoute;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(string $name, AppRouteRepositoryRequest $appRouteRepositoryRequest, AppRoute $appRoute): ?AppRoute
    {
        $appRoute = $appRoute->where('name', $name)->first();
        if($appRoute != null){
            try {
                $appRoute = Lazy::transform($appRouteRepositoryRequest, $appRoute);
                $appRoute->save();
                return $appRoute;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $appRoute;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $name, AppRoute $appRoute): bool
    {
        $appRoute = $appRoute->where('app_routes.name',$name)->first();
        if($appRoute!=null){
            return $appRoute->delete();
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
            return $query->where('app_routes.name', 'LIKE', '%' . $q . '%');
        });

    }

    /**
     * @inheritDoc
     */
    public function get(AppRoute $appRoute, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($appRoute)
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
    public function getCount(AppRoute $appRoute, string $q = null): int
    {
        return $this
            ->getJoin($appRoute)
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
    public function getByName(string $name, AppRoute $appRoute):? AppRoute
    {
        return $this
            ->getJoin($appRoute)
            ->where('app_routes.name', '=', $name )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByNameList(string $name, AppRoute $appRoute, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appRoute)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('app_routes.name', '=', $name )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id, AppRoute $appRoute):? AppRoute
    {
        return $this
            ->getJoin($appRoute)
            ->where('app_routes.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, AppRoute $appRoute, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appRoute)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('app_routes.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
