<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\SfLanguage;
use App\Repositories\Requests\SfLanguageRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:30
 * Time: 2022/09/14
 * Trait SfLanguageRepositoryTrait
 * @package App\Repositories
 */
trait SfLanguageRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){

    }

    /**
     * @inheritDoc
     */
    public function store(SfLanguageRepositoryRequest $sfLanguageRepositoryRequest, SfLanguage $sfLanguage): ?SfLanguage
    {
        try {
            $sfLanguage = Lazy::transform($sfLanguageRepositoryRequest, $sfLanguage);
            $sfLanguage->save();
            return $sfLanguage;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $languageId, SfLanguageRepositoryRequest $sfLanguageRepositoryRequest, SfLanguage $sfLanguage): ?SfLanguage
    {
        $sfLanguage = $sfLanguage->where('languageId', $languageId)->first();
        if($sfLanguage != null){
            try {
                $sfLanguage = Lazy::transform($sfLanguageRepositoryRequest, $sfLanguage);
                $sfLanguage->save();
                return $sfLanguage;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $sfLanguage;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $languageId, SfLanguage $sfLanguage): bool
    {
        $sfLanguage = $sfLanguage->where('sf_language.languageId',$languageId)->first();
        if($sfLanguage!=null){
            return $sfLanguage->delete();
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
    public function get(SfLanguage $sfLanguage, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfLanguage)
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
    public function getCount(SfLanguage $sfLanguage, string $q = null): int
    {
        return $this
            ->getJoin($sfLanguage)
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
    public function getByLanguageId(int $languageId, SfLanguage $sfLanguage):? SfLanguage
    {
        return $this
            ->getJoin($sfLanguage)
            ->where('sf_language.languageId', '=', $languageId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByLanguageIdList(int $languageId, SfLanguage $sfLanguage, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfLanguage)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_language.languageId', '=', $languageId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
