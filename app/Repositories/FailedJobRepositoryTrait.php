<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\FailedJob;
use App\Repositories\Requests\FailedJobRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:07
 * Time: 2022/09/14
 * Trait FailedJobRepositoryTrait
 * @package App\Repositories
 */
trait FailedJobRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){

    }

    /**
     * @inheritDoc
     */
    public function store(FailedJobRepositoryRequest $failedJobRepositoryRequest, FailedJob $failedJob): ?FailedJob
    {
        try {
            $failedJob = Lazy::transform($failedJobRepositoryRequest, $failedJob);
            $failedJob->save();
            return $failedJob;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(string $uuid, FailedJobRepositoryRequest $failedJobRepositoryRequest, FailedJob $failedJob): ?FailedJob
    {
        $failedJob = $failedJob->where('uuid', $uuid)->first();
        if($failedJob != null){
            try {
                $failedJob = Lazy::transform($failedJobRepositoryRequest, $failedJob);
                $failedJob->save();
                return $failedJob;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $failedJob;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $uuid, FailedJob $failedJob): bool
    {
        $failedJob = $failedJob->where('failed_jobs.uuid',$uuid)->first();
        if($failedJob!=null){
            return $failedJob->delete();
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
            return $query->where('failed_jobs.uuid', 'LIKE', '%' . $q . '%');
        });

    }

    /**
     * @inheritDoc
     */
    public function get(FailedJob $failedJob, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($failedJob)
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
    public function getCount(FailedJob $failedJob, string $q = null): int
    {
        return $this
            ->getJoin($failedJob)
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
    public function getByUuid(string $uuid, FailedJob $failedJob):? FailedJob
    {
        return $this
            ->getJoin($failedJob)
            ->where('failed_jobs.uuid', '=', $uuid )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUuidList(string $uuid, FailedJob $failedJob, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($failedJob)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('failed_jobs.uuid', '=', $uuid )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id, FailedJob $failedJob):? FailedJob
    {
        return $this
            ->getJoin($failedJob)
            ->where('failed_jobs.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, FailedJob $failedJob, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($failedJob)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('failed_jobs.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
