<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\SfMicroprocess;
use App\Models\SfMicroprocessProcess;
use App\Repositories\Requests\SfMicroprocessProcessRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:36
 * Time: 2022/09/14
 * Trait SfMicroprocessProcessRepositoryTrait
 * @package App\Repositories
 */
trait SfMicroprocessProcessRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $sf_microprocess_ref_process = app()->make(Join::class);
        $sf_microprocess_ref_process->class = SfMicroprocessRefProcess::class;
        $sf_microprocess_ref_process->foreign = 'sf_microprocess_process.microprocessProcessProcessId';
        $sf_microprocess_ref_process->type = 'left';
        $sf_microprocess_ref_process->primary = 'sf_microprocess_ref_process.processId';
        $this->joinTable['sf_microprocess_ref_process'] = $sf_microprocess_ref_process;

        $sf_microprocess = app()->make(Join::class);
        $sf_microprocess->class = SfMicroprocess::class;
        $sf_microprocess->foreign = 'sf_microprocess_process.microprocessProcessMicroprocessId';
        $sf_microprocess->type = 'inner';
        $sf_microprocess->primary = 'sf_microprocess.microprocessId';
        $this->joinTable['sf_microprocess'] = $sf_microprocess;

        $microprocessProcessLinkId_sf_microprocess_ref_process = app()->make(Join::class);
        $microprocessProcessLinkId_sf_microprocess_ref_process->class = SfMicroprocessRefProcess::class;
        $microprocessProcessLinkId_sf_microprocess_ref_process->foreign = 'sf_microprocess_process.microprocessProcessLinkId';
        $microprocessProcessLinkId_sf_microprocess_ref_process->type = 'left';
        $microprocessProcessLinkId_sf_microprocess_ref_process->primary = 'microprocessProcessLinkId_sf_microprocess_ref_process.processId';
        $this->joinTable['microprocessProcessLinkId_sf_microprocess_ref_process'] = $microprocessProcessLinkId_sf_microprocess_ref_process;

        $sf_microprocess_ref_param = app()->make(Join::class);
        $sf_microprocess_ref_param->class = SfMicroprocessRefParam::class;
        $sf_microprocess_ref_param->foreign = 'sf_microprocess_process.microprocessProcessKeyId';
        $sf_microprocess_ref_param->type = 'left';
        $sf_microprocess_ref_param->primary = 'sf_microprocess_ref_param.paramId';
        $this->joinTable['sf_microprocess_ref_param'] = $sf_microprocess_ref_param;

        $microprocessProcessForeignId_sf_microprocess_ref_param = app()->make(Join::class);
        $microprocessProcessForeignId_sf_microprocess_ref_param->class = SfMicroprocessRefParam::class;
        $microprocessProcessForeignId_sf_microprocess_ref_param->foreign = 'sf_microprocess_process.microprocessProcessForeignId';
        $microprocessProcessForeignId_sf_microprocess_ref_param->type = 'left';
        $microprocessProcessForeignId_sf_microprocess_ref_param->primary = 'microprocessProcessForeignId_sf_microprocess_ref_param.paramId';
        $this->joinTable['microprocessProcessForeignId_sf_microprocess_ref_param'] = $microprocessProcessForeignId_sf_microprocess_ref_param;

    }

    /**
     * @inheritDoc
     */
    public function store(SfMicroprocessProcessRepositoryRequest $sfMicroprocessProcessRepositoryRequest, SfMicroprocessProcess $sfMicroprocessProcess): ?SfMicroprocessProcess
    {
        try {
            $sfMicroprocessProcess = Lazy::transform($sfMicroprocessProcessRepositoryRequest, $sfMicroprocessProcess);
            $sfMicroprocessProcess->save();
            return $sfMicroprocessProcess;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $microprocessProcessId, SfMicroprocessProcessRepositoryRequest $sfMicroprocessProcessRepositoryRequest, SfMicroprocessProcess $sfMicroprocessProcess): ?SfMicroprocessProcess
    {
        $sfMicroprocessProcess = $sfMicroprocessProcess->where('microprocessProcessId', $microprocessProcessId)->first();
        if($sfMicroprocessProcess != null){
            try {
                $sfMicroprocessProcess = Lazy::transform($sfMicroprocessProcessRepositoryRequest, $sfMicroprocessProcess);
                $sfMicroprocessProcess->save();
                return $sfMicroprocessProcess;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $sfMicroprocessProcess;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $microprocessProcessId, SfMicroprocessProcess $sfMicroprocessProcess): bool
    {
        $sfMicroprocessProcess = $sfMicroprocessProcess->where('sf_microprocess_process.microprocessProcessId',$microprocessProcessId)->first();
        if($sfMicroprocessProcess!=null){
            return $sfMicroprocessProcess->delete();
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
    public function get(SfMicroprocessProcess $sfMicroprocessProcess, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocessProcess)
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
    public function getCount(SfMicroprocessProcess $sfMicroprocessProcess, string $q = null): int
    {
        return $this
            ->getJoin($sfMicroprocessProcess)
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
    public function getByMicroprocessProcessId(int $microprocessProcessId, SfMicroprocessProcess $sfMicroprocessProcess):? SfMicroprocessProcess
    {
        return $this
            ->getJoin($sfMicroprocessProcess)
            ->where('sf_microprocess_process.microprocessProcessId', '=', $microprocessProcessId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessProcessIdList(int $microprocessProcessId, SfMicroprocessProcess $sfMicroprocessProcess, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocessProcess)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_microprocess_process.microprocessProcessId', '=', $microprocessProcessId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefProcessProcessCode(string $processCode, SfMicroprocessProcess $sfMicroprocessProcess):? SfMicroprocessProcess
    {
        return $this
            ->getJoin($sfMicroprocessProcess)
            ->where('sf_microprocess_ref_process.processCode', '=', $processCode )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefProcessProcessCodeList(string $processCode, SfMicroprocessProcess $sfMicroprocessProcess, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocessProcess)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_microprocess_ref_process.processCode', '=', $processCode )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefProcessProcessId(int $processId, SfMicroprocessProcess $sfMicroprocessProcess):? SfMicroprocessProcess
    {
        return $this
            ->getJoin($sfMicroprocessProcess)
            ->where('sf_microprocess_ref_process.processId', '=', $processId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefProcessProcessIdList(int $processId, SfMicroprocessProcess $sfMicroprocessProcess, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocessProcess)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_microprocess_ref_process.processId', '=', $processId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessMicroprocessCode(string $microprocessCode, SfMicroprocessProcess $sfMicroprocessProcess):? SfMicroprocessProcess
    {
        return $this
            ->getJoin($sfMicroprocessProcess)
            ->where('sf_microprocess.microprocessCode', '=', $microprocessCode )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessMicroprocessCodeList(string $microprocessCode, SfMicroprocessProcess $sfMicroprocessProcess, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocessProcess)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_microprocess.microprocessCode', '=', $microprocessCode )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessMicroprocessId(int $microprocessId, SfMicroprocessProcess $sfMicroprocessProcess):? SfMicroprocessProcess
    {
        return $this
            ->getJoin($sfMicroprocessProcess)
            ->where('sf_microprocess.microprocessId', '=', $microprocessId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessMicroprocessIdList(int $microprocessId, SfMicroprocessProcess $sfMicroprocessProcess, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocessProcess)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_microprocess.microprocessId', '=', $microprocessId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessProcessLinkIdSfMicroprocessRefProcessProcessCode(string $processCode, SfMicroprocessProcess $sfMicroprocessProcess):? SfMicroprocessProcess
    {
        return $this
            ->getJoin($sfMicroprocessProcess)
            ->where('microprocessProcessLinkId_sf_microprocess_ref_process.processCode', '=', $processCode )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessProcessLinkIdSfMicroprocessRefProcessProcessCodeList(string $processCode, SfMicroprocessProcess $sfMicroprocessProcess, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocessProcess)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('microprocessProcessLinkId_sf_microprocess_ref_process.processCode', '=', $processCode )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessProcessLinkIdSfMicroprocessRefProcessProcessId(int $processId, SfMicroprocessProcess $sfMicroprocessProcess):? SfMicroprocessProcess
    {
        return $this
            ->getJoin($sfMicroprocessProcess)
            ->where('microprocessProcessLinkId_sf_microprocess_ref_process.processId', '=', $processId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessProcessLinkIdSfMicroprocessRefProcessProcessIdList(int $processId, SfMicroprocessProcess $sfMicroprocessProcess, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocessProcess)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('microprocessProcessLinkId_sf_microprocess_ref_process.processId', '=', $processId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefParamParamName(string $paramName, SfMicroprocessProcess $sfMicroprocessProcess):? SfMicroprocessProcess
    {
        return $this
            ->getJoin($sfMicroprocessProcess)
            ->where('sf_microprocess_ref_param.paramName', '=', $paramName )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefParamParamNameList(string $paramName, SfMicroprocessProcess $sfMicroprocessProcess, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocessProcess)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_microprocess_ref_param.paramName', '=', $paramName )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefParamParamId(int $paramId, SfMicroprocessProcess $sfMicroprocessProcess):? SfMicroprocessProcess
    {
        return $this
            ->getJoin($sfMicroprocessProcess)
            ->where('sf_microprocess_ref_param.paramId', '=', $paramId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefParamParamIdList(int $paramId, SfMicroprocessProcess $sfMicroprocessProcess, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocessProcess)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_microprocess_ref_param.paramId', '=', $paramId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessProcessForeignIdSfMicroprocessRefParamParamName(string $paramName, SfMicroprocessProcess $sfMicroprocessProcess):? SfMicroprocessProcess
    {
        return $this
            ->getJoin($sfMicroprocessProcess)
            ->where('microprocessProcessForeignId_sf_microprocess_ref_param.paramName', '=', $paramName )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessProcessForeignIdSfMicroprocessRefParamParamNameList(string $paramName, SfMicroprocessProcess $sfMicroprocessProcess, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocessProcess)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('microprocessProcessForeignId_sf_microprocess_ref_param.paramName', '=', $paramName )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessProcessForeignIdSfMicroprocessRefParamParamId(int $paramId, SfMicroprocessProcess $sfMicroprocessProcess):? SfMicroprocessProcess
    {
        return $this
            ->getJoin($sfMicroprocessProcess)
            ->where('microprocessProcessForeignId_sf_microprocess_ref_param.paramId', '=', $paramId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessProcessForeignIdSfMicroprocessRefParamParamIdList(int $paramId, SfMicroprocessProcess $sfMicroprocessProcess, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocessProcess)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('microprocessProcessForeignId_sf_microprocess_ref_param.paramId', '=', $paramId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
