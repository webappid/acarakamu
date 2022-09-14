<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\Migration;
use App\Repositories\Requests\MigrationRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:12
 * Time: 2022/09/14
 * Trait MigrationRepositoryTrait
 * @package App\Repositories
 */
trait MigrationRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){

    }

    /**
     * @inheritDoc
     */
    public function store(MigrationRepositoryRequest $migrationRepositoryRequest, Migration $migration): ?Migration
    {
        try {
            $migration = Lazy::transform($migrationRepositoryRequest, $migration);
            $migration->save();
            return $migration;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, MigrationRepositoryRequest $migrationRepositoryRequest, Migration $migration): ?Migration
    {
        $migration = $migration->where('id', $id)->first();
        if($migration != null){
            try {
                $migration = Lazy::transform($migrationRepositoryRequest, $migration);
                $migration->save();
                return $migration;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $migration;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, Migration $migration): bool
    {
        $migration = $migration->where('migrations.id',$id)->first();
        if($migration!=null){
            return $migration->delete();
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
    public function get(Migration $migration, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($migration)
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
    public function getCount(Migration $migration, string $q = null): int
    {
        return $this
            ->getJoin($migration)
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
    public function getById(int $id, Migration $migration):? Migration
    {
        return $this
            ->getJoin($migration)
            ->where('migrations.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, Migration $migration, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($migration)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('migrations.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
