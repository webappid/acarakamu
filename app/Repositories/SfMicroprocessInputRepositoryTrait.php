<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\SfMicroprocessInput;
use App\Repositories\Requests\SfMicroprocessInputRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:34
 * Time: 2022/09/14
 * Trait SfMicroprocessInputRepositoryTrait
 * @package App\Repositories
 */
trait SfMicroprocessInputRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $sf_microprocess_ref_param = app()->make(Join::class);
        $sf_microprocess_ref_param->class = SfMicroprocessRefParam::class;
        $sf_microprocess_ref_param->foreign = 'sf_microprocess_input.microprocessInputParamId';
        $sf_microprocess_ref_param->type = 'inner';
        $sf_microprocess_ref_param->primary = 'sf_microprocess_ref_param.paramId';
        $this->joinTable['sf_microprocess_ref_param'] = $sf_microprocess_ref_param;

        $sf_microprocess_ref_process = app()->make(Join::class);
        $sf_microprocess_ref_process->class = SfMicroprocessRefProcess::class;
        $sf_microprocess_ref_process->foreign = 'sf_microprocess_input.microprocessInputProcessId';
        $sf_microprocess_ref_process->type = 'inner';
        $sf_microprocess_ref_process->primary = 'sf_microprocess_ref_process.processId';
        $this->joinTable['sf_microprocess_ref_process'] = $sf_microprocess_ref_process;

    }

    /**
     * @inheritDoc
     */
    public function store(SfMicroprocessInputRepositoryRequest $sfMicroprocessInputRepositoryRequest, SfMicroprocessInput $sfMicroprocessInput): ?SfMicroprocessInput
    {
        try {
            $sfMicroprocessInput = Lazy::transform($sfMicroprocessInputRepositoryRequest, $sfMicroprocessInput);
            $sfMicroprocessInput->save();
            return $sfMicroprocessInput;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $microprocessInputId, SfMicroprocessInputRepositoryRequest $sfMicroprocessInputRepositoryRequest, SfMicroprocessInput $sfMicroprocessInput): ?SfMicroprocessInput
    {
        $sfMicroprocessInput = $sfMicroprocessInput->where('microprocessInputId', $microprocessInputId)->first();
        if($sfMicroprocessInput != null){
            try {
                $sfMicroprocessInput = Lazy::transform($sfMicroprocessInputRepositoryRequest, $sfMicroprocessInput);
                $sfMicroprocessInput->save();
                return $sfMicroprocessInput;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $sfMicroprocessInput;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $microprocessInputId, SfMicroprocessInput $sfMicroprocessInput): bool
    {
        $sfMicroprocessInput = $sfMicroprocessInput->where('sf_microprocess_input.microprocessInputId',$microprocessInputId)->first();
        if($sfMicroprocessInput!=null){
            return $sfMicroprocessInput->delete();
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
            return $query->where('sf_microprocess_input.microprocessInputParamOrder', 'LIKE', '%' . $q . '%')
        ->orWhere('sf_microprocess_input.microprocessInputParamParentId', 'LIKE', '%' . $q . '%');
        });

    }

    /**
     * @inheritDoc
     */
    public function get(SfMicroprocessInput $sfMicroprocessInput, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocessInput)
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
    public function getCount(SfMicroprocessInput $sfMicroprocessInput, string $q = null): int
    {
        return $this
            ->getJoin($sfMicroprocessInput)
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
    public function getByMicroprocessInputProcessIdMicroprocessInputParamIdMicroprocessInputParamOrderMicroprocessInputParamParentId(int $microprocessInputProcessId, int $microprocessInputParamId, int $microprocessInputParamOrder, int $microprocessInputParamParentId, SfMicroprocessInput $sfMicroprocessInput):? SfMicroprocessInput
    {
        return $this
            ->getJoin($sfMicroprocessInput)
            ->where('sf_microprocess_input.microprocessInputProcessId', '=', $microprocessInputProcessId )
            ->where('sf_microprocess_input.microprocessInputParamId', '=', $microprocessInputParamId )
            ->where('sf_microprocess_input.microprocessInputParamOrder', '=', $microprocessInputParamOrder )
            ->where('sf_microprocess_input.microprocessInputParamParentId', '=', $microprocessInputParamParentId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessInputProcessIdMicroprocessInputParamIdMicroprocessInputParamOrderMicroprocessInputParamParentIdList(int $microprocessInputProcessId, int $microprocessInputParamId, int $microprocessInputParamOrder, int $microprocessInputParamParentId, SfMicroprocessInput $sfMicroprocessInput, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocessInput)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_microprocess_input.microprocessInputProcessId', '=', $microprocessInputProcessId )
            ->where('sf_microprocess_input.microprocessInputParamId', '=', $microprocessInputParamId )
            ->where('sf_microprocess_input.microprocessInputParamOrder', '=', $microprocessInputParamOrder )
            ->where('sf_microprocess_input.microprocessInputParamParentId', '=', $microprocessInputParamParentId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessInputId(int $microprocessInputId, SfMicroprocessInput $sfMicroprocessInput):? SfMicroprocessInput
    {
        return $this
            ->getJoin($sfMicroprocessInput)
            ->where('sf_microprocess_input.microprocessInputId', '=', $microprocessInputId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessInputIdList(int $microprocessInputId, SfMicroprocessInput $sfMicroprocessInput, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocessInput)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_microprocess_input.microprocessInputId', '=', $microprocessInputId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefParamParamName(string $paramName, SfMicroprocessInput $sfMicroprocessInput):? SfMicroprocessInput
    {
        return $this
            ->getJoin($sfMicroprocessInput)
            ->where('sf_microprocess_ref_param.paramName', '=', $paramName )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefParamParamNameList(string $paramName, SfMicroprocessInput $sfMicroprocessInput, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocessInput)
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
    public function getBySfMicroprocessRefParamParamId(int $paramId, SfMicroprocessInput $sfMicroprocessInput):? SfMicroprocessInput
    {
        return $this
            ->getJoin($sfMicroprocessInput)
            ->where('sf_microprocess_ref_param.paramId', '=', $paramId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefParamParamIdList(int $paramId, SfMicroprocessInput $sfMicroprocessInput, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocessInput)
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
    public function getBySfMicroprocessRefProcessProcessCode(string $processCode, SfMicroprocessInput $sfMicroprocessInput):? SfMicroprocessInput
    {
        return $this
            ->getJoin($sfMicroprocessInput)
            ->where('sf_microprocess_ref_process.processCode', '=', $processCode )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefProcessProcessCodeList(string $processCode, SfMicroprocessInput $sfMicroprocessInput, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocessInput)
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
    public function getBySfMicroprocessRefProcessProcessId(int $processId, SfMicroprocessInput $sfMicroprocessInput):? SfMicroprocessInput
    {
        return $this
            ->getJoin($sfMicroprocessInput)
            ->where('sf_microprocess_ref_process.processId', '=', $processId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfMicroprocessRefProcessProcessIdList(int $processId, SfMicroprocessInput $sfMicroprocessInput, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocessInput)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_microprocess_ref_process.processId', '=', $processId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
