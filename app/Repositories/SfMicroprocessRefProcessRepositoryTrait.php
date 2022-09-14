<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\SfMicroprocessRefParam;
use App\Models\SfMicroprocessRefProcess;
use App\Repositories\Requests\SfMicroprocessRefProcessRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:38
 * Time: 2022/09/14
 * Trait SfMicroprocessRefProcessRepositoryTrait
 * @package App\Repositories
 */
trait SfMicroprocessRefProcessRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $sf_microprocess_ref_param = app()->make(Join::class);
        $sf_microprocess_ref_param->class = SfMicroprocessRefParam::class;
        $sf_microprocess_ref_param->foreign = 'sf_microprocess_ref_process.processResultParamId';
        $sf_microprocess_ref_param->type = 'left';
        $sf_microprocess_ref_param->primary = 'sf_microprocess_ref_param.paramId';
        $this->joinTable['sf_microprocess_ref_param'] = $sf_microprocess_ref_param;

    }

    /**
     * @inheritDoc
     */
    public function store(SfMicroprocessRefProcessRepositoryRequest $sfMicroprocessRefProcessRepositoryRequest, SfMicroprocessRefProcess $sfMicroprocessRefProcess): ?SfMicroprocessRefProcess
    {
        try {
            $sfMicroprocessRefProcess = Lazy::transform($sfMicroprocessRefProcessRepositoryRequest, $sfMicroprocessRefProcess);
            $sfMicroprocessRefProcess->save();
            return $sfMicroprocessRefProcess;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(string $processCode, SfMicroprocessRefProcessRepositoryRequest $sfMicroprocessRefProcessRepositoryRequest, SfMicroprocessRefProcess $sfMicroprocessRefProcess): ?SfMicroprocessRefProcess
    {
        $sfMicroprocessRefProcess = $sfMicroprocessRefProcess->where('processCode', $processCode)->first();
        if($sfMicroprocessRefProcess != null){
            try {
                $sfMicroprocessRefProcess = Lazy::transform($sfMicroprocessRefProcessRepositoryRequest, $sfMicroprocessRefProcess);
                $sfMicroprocessRefProcess->save();
                return $sfMicroprocessRefProcess;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $sfMicroprocessRefProcess;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $processCode, SfMicroprocessRefProcess $sfMicroprocessRefProcess): bool
    {
        $sfMicroprocessRefProcess = $sfMicroprocessRefProcess->where('sf_microprocess_ref_process.processCode',$processCode)->first();
        if($sfMicroprocessRefProcess!=null){
            return $sfMicroprocessRefProcess->delete();
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
            return $query->where('sf_microprocess_ref_process.processCode', 'LIKE', '%' . $q . '%');
        });

    }

    /**
     * @inheritDoc
     */
    public function get(SfMicroprocessRefProcess $sfMicroprocessRefProcess, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocessRefProcess)
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
    public function getCount(SfMicroprocessRefProcess $sfMicroprocessRefProcess, string $q = null): int
    {
        return $this
            ->getJoin($sfMicroprocessRefProcess)
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
    public function getByProcessCode(string $processCode, SfMicroprocessRefProcess $sfMicroprocessRefProcess):? SfMicroprocessRefProcess
    {
        return $this
            ->getJoin($sfMicroprocessRefProcess)
            ->where('sf_microprocess_ref_process.processCode', '=', $processCode )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByProcessCodeList(string $processCode, SfMicroprocessRefProcess $sfMicroprocessRefProcess, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocessRefProcess)
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
    public function getByProcessId(int $processId, SfMicroprocessRefProcess $sfMicroprocessRefProcess):? SfMicroprocessRefProcess
    {
        return $this
            ->getJoin($sfMicroprocessRefProcess)
            ->where('sf_microprocess_ref_process.processId', '=', $processId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByProcessIdList(int $processId, SfMicroprocessRefProcess $sfMicroprocessRefProcess, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocessRefProcess)
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
    public function getBySfMicroprocessRefParamParamName(string $paramName, SfMicroprocessRefProcess $sfMicroprocessRefProcess):? SfMicroprocessRefProcess
    {
        return $this
            ->getJoin($sfMicroprocessRefProcess)
            ->where('sf_microprocess_ref_param.paramName', '=', $paramName )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefParamParamNameList(string $paramName, SfMicroprocessRefProcess $sfMicroprocessRefProcess, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocessRefProcess)
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
    public function getBySfMicroprocessRefParamParamId(int $paramId, SfMicroprocessRefProcess $sfMicroprocessRefProcess):? SfMicroprocessRefProcess
    {
        return $this
            ->getJoin($sfMicroprocessRefProcess)
            ->where('sf_microprocess_ref_param.paramId', '=', $paramId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefParamParamIdList(int $paramId, SfMicroprocessRefProcess $sfMicroprocessRefProcess, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocessRefProcess)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_microprocess_ref_param.paramId', '=', $paramId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
