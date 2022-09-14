<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\SfConfig;
use App\Repositories\Requests\SfConfigRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:24
 * Time: 2022/09/14
 * Trait SfConfigRepositoryTrait
 * @package App\Repositories
 */
trait SfConfigRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){

    }

    /**
     * @inheritDoc
     */
    public function store(SfConfigRepositoryRequest $sfConfigRepositoryRequest, SfConfig $sfConfig): ?SfConfig
    {
        try {
            $sfConfig = Lazy::transform($sfConfigRepositoryRequest, $sfConfig);
            $sfConfig->save();
            return $sfConfig;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(string $configCode, SfConfigRepositoryRequest $sfConfigRepositoryRequest, SfConfig $sfConfig): ?SfConfig
    {
        $sfConfig = $sfConfig->where('configCode', $configCode)->first();
        if($sfConfig != null){
            try {
                $sfConfig = Lazy::transform($sfConfigRepositoryRequest, $sfConfig);
                $sfConfig->save();
                return $sfConfig;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $sfConfig;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $configCode, SfConfig $sfConfig): bool
    {
        $sfConfig = $sfConfig->where('sf_config.configCode',$configCode)->first();
        if($sfConfig!=null){
            return $sfConfig->delete();
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
            return $query->where('sf_config.configCode', 'LIKE', '%' . $q . '%');
        });

    }

    /**
     * @inheritDoc
     */
    public function get(SfConfig $sfConfig, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfConfig)
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
    public function getCount(SfConfig $sfConfig, string $q = null): int
    {
        return $this
            ->getJoin($sfConfig)
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
    public function getByConfigCode(string $configCode, SfConfig $sfConfig):? SfConfig
    {
        return $this
            ->getJoin($sfConfig)
            ->where('sf_config.configCode', '=', $configCode )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByConfigCodeList(string $configCode, SfConfig $sfConfig, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfConfig)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_config.configCode', '=', $configCode )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByConfigId(int $configId, SfConfig $sfConfig):? SfConfig
    {
        return $this
            ->getJoin($sfConfig)
            ->where('sf_config.configId', '=', $configId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByConfigIdList(int $configId, SfConfig $sfConfig, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfConfig)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_config.configId', '=', $configId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
