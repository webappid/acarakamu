<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\SfMenuLanguage;
use App\Repositories\Requests\SfMenuLanguageRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:32
 * Time: 2022/09/14
 * Trait SfMenuLanguageRepositoryTrait
 * @package App\Repositories
 */
trait SfMenuLanguageRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){

    }

    /**
     * @inheritDoc
     */
    public function store(SfMenuLanguageRepositoryRequest $sfMenuLanguageRepositoryRequest, SfMenuLanguage $sfMenuLanguage): ?SfMenuLanguage
    {
        try {
            $sfMenuLanguage = Lazy::transform($sfMenuLanguageRepositoryRequest, $sfMenuLanguage);
            $sfMenuLanguage->save();
            return $sfMenuLanguage;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $menuLangId, SfMenuLanguageRepositoryRequest $sfMenuLanguageRepositoryRequest, SfMenuLanguage $sfMenuLanguage): ?SfMenuLanguage
    {
        $sfMenuLanguage = $sfMenuLanguage->where('menuLangId', $menuLangId)->first();
        if($sfMenuLanguage != null){
            try {
                $sfMenuLanguage = Lazy::transform($sfMenuLanguageRepositoryRequest, $sfMenuLanguage);
                $sfMenuLanguage->save();
                return $sfMenuLanguage;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $sfMenuLanguage;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $menuLangId, SfMenuLanguage $sfMenuLanguage): bool
    {
        $sfMenuLanguage = $sfMenuLanguage->where('sf_menu_language.menuLangId',$menuLangId)->first();
        if($sfMenuLanguage!=null){
            return $sfMenuLanguage->delete();
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
            return $query->where('sf_menu_language.languageId', 'LIKE', '%' . $q . '%')
        ->orWhere('sf_menu_language.menuId', 'LIKE', '%' . $q . '%');
        });

    }

    /**
     * @inheritDoc
     */
    public function get(SfMenuLanguage $sfMenuLanguage, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMenuLanguage)
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
    public function getCount(SfMenuLanguage $sfMenuLanguage, string $q = null): int
    {
        return $this
            ->getJoin($sfMenuLanguage)
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
    public function getByLanguageId(int $languageId, SfMenuLanguage $sfMenuLanguage):? SfMenuLanguage
    {
        return $this
            ->getJoin($sfMenuLanguage)
            ->where('sf_menu_language.languageId', '=', $languageId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByLanguageIdList(int $languageId, SfMenuLanguage $sfMenuLanguage, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMenuLanguage)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_menu_language.languageId', '=', $languageId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByMenuId(int $menuId, SfMenuLanguage $sfMenuLanguage):? SfMenuLanguage
    {
        return $this
            ->getJoin($sfMenuLanguage)
            ->where('sf_menu_language.menuId', '=', $menuId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByMenuIdList(int $menuId, SfMenuLanguage $sfMenuLanguage, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMenuLanguage)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_menu_language.menuId', '=', $menuId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByMenuLangId(int $menuLangId, SfMenuLanguage $sfMenuLanguage):? SfMenuLanguage
    {
        return $this
            ->getJoin($sfMenuLanguage)
            ->where('sf_menu_language.menuLangId', '=', $menuLangId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByMenuLangIdList(int $menuLangId, SfMenuLanguage $sfMenuLanguage, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMenuLanguage)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_menu_language.menuLangId', '=', $menuLangId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
