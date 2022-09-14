<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\SystemLog;
use App\Repositories\Requests\SystemLogRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:44
 * Time: 2022/09/14
 * Trait SystemLogRepositoryTrait
 * @package App\Repositories
 */
trait SystemLogRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){

    }

    /**
     * @inheritDoc
     */
    public function store(SystemLogRepositoryRequest $systemLogRepositoryRequest, SystemLog $systemLog): ?SystemLog
    {
        try {
            $systemLog = Lazy::transform($systemLogRepositoryRequest, $systemLog);
            $systemLog->save();
            return $systemLog;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $logId, SystemLogRepositoryRequest $systemLogRepositoryRequest, SystemLog $systemLog): ?SystemLog
    {
        $systemLog = $systemLog->where('logId', $logId)->first();
        if($systemLog != null){
            try {
                $systemLog = Lazy::transform($systemLogRepositoryRequest, $systemLog);
                $systemLog->save();
                return $systemLog;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $systemLog;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $logId, SystemLog $systemLog): bool
    {
        $systemLog = $systemLog->where('system_log.logId',$logId)->first();
        if($systemLog!=null){
            return $systemLog->delete();
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
    public function get(SystemLog $systemLog, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($systemLog)
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
    public function getCount(SystemLog $systemLog, string $q = null): int
    {
        return $this
            ->getJoin($systemLog)
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
    public function getByLogId(int $logId, SystemLog $systemLog):? SystemLog
    {
        return $this
            ->getJoin($systemLog)
            ->where('system_log.logId', '=', $logId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByLogIdList(int $logId, SystemLog $systemLog, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($systemLog)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('system_log.logId', '=', $logId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
