<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\SfMicroprocess;
use App\Repositories\Requests\SfMicroprocessRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:33
 * Time: 2022/09/14
 * Trait SfMicroprocessRepositoryTrait
 * @package App\Repositories
 */
trait SfMicroprocessRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){

    }

    /**
     * @inheritDoc
     */
    public function store(SfMicroprocessRepositoryRequest $sfMicroprocessRepositoryRequest, SfMicroprocess $sfMicroprocess): ?SfMicroprocess
    {
        try {
            $sfMicroprocess = Lazy::transform($sfMicroprocessRepositoryRequest, $sfMicroprocess);
            $sfMicroprocess->save();
            return $sfMicroprocess;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(string $microprocessCode, SfMicroprocessRepositoryRequest $sfMicroprocessRepositoryRequest, SfMicroprocess $sfMicroprocess): ?SfMicroprocess
    {
        $sfMicroprocess = $sfMicroprocess->where('microprocessCode', $microprocessCode)->first();
        if($sfMicroprocess != null){
            try {
                $sfMicroprocess = Lazy::transform($sfMicroprocessRepositoryRequest, $sfMicroprocess);
                $sfMicroprocess->save();
                return $sfMicroprocess;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $sfMicroprocess;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $microprocessCode, SfMicroprocess $sfMicroprocess): bool
    {
        $sfMicroprocess = $sfMicroprocess->where('sf_microprocess.microprocessCode',$microprocessCode)->first();
        if($sfMicroprocess!=null){
            return $sfMicroprocess->delete();
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
            return $query->where('sf_microprocess.microprocessCode', 'LIKE', '%' . $q . '%');
        });

    }

    /**
     * @inheritDoc
     */
    public function get(SfMicroprocess $sfMicroprocess, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocess)
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
    public function getCount(SfMicroprocess $sfMicroprocess, string $q = null): int
    {
        return $this
            ->getJoin($sfMicroprocess)
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
    public function getByMicroprocessCode(string $microprocessCode, SfMicroprocess $sfMicroprocess):? SfMicroprocess
    {
        return $this
            ->getJoin($sfMicroprocess)
            ->where('sf_microprocess.microprocessCode', '=', $microprocessCode )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessCodeList(string $microprocessCode, SfMicroprocess $sfMicroprocess, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocess)
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
    public function getByMicroprocessId(int $microprocessId, SfMicroprocess $sfMicroprocess):? SfMicroprocess
    {
        return $this
            ->getJoin($sfMicroprocess)
            ->where('sf_microprocess.microprocessId', '=', $microprocessId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByMicroprocessIdList(int $microprocessId, SfMicroprocess $sfMicroprocess, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocess)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_microprocess.microprocessId', '=', $microprocessId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
