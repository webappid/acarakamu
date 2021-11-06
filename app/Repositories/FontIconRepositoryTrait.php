<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\FontIcon;
use App\Repositories\Requests\FontIconRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 14:04:14
 * Time: 2021/11/06
 * Trait FontIconRepositoryTrait
 * @package App\Repositories
 */
trait FontIconRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $font_icon_types = app()->make(Join::class);
        $font_icon_types->class = FontIconType::class;
        $font_icon_types->foreign = 'font_icons.type_id';
        $font_icon_types->type = 'inner';
        $font_icon_types->primary = 'font_icon_types.id';
        $this->joinTable['font_icon_types'] = $font_icon_types;

    }

    /**
     * @inheritDoc
     */
    public function store(FontIconRepositoryRequest $fontIconRepositoryRequest, FontIcon $fontIcon): ?FontIcon
    {
        try {
            $fontIcon = Lazy::transform($fontIconRepositoryRequest, $fontIcon);
            $fontIcon->save();
            return $fontIcon;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, FontIconRepositoryRequest $fontIconRepositoryRequest, FontIcon $fontIcon): ?FontIcon
    {
        $fontIcon = $fontIcon->where('id', $id)->first();
        if($fontIcon != null){
            try {
                $fontIcon = Lazy::transform($fontIconRepositoryRequest, $fontIcon);
                $fontIcon->save();
                return $fontIcon;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $fontIcon;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, FontIcon $fontIcon): bool
    {
        $fontIcon = $fontIcon->where('font_icons.id',$id)->first();
        if($fontIcon!=null){
            return $fontIcon->delete();
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
            return $query->where('font_icons.name', 'LIKE', '%' . $q . '%');
        });

    }

    /**
     * @inheritDoc
     */
    public function get(FontIcon $fontIcon, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($fontIcon)
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
    public function getCount(FontIcon $fontIcon, string $q = null): int
    {
        return $this
            ->getJoin($fontIcon)
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
    public function getByName(string $name, FontIcon $fontIcon):? FontIcon
    {
        return $this
            ->getJoin($fontIcon)
            ->where('font_icons.name', '=', $name )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByNameList(string $name, FontIcon $fontIcon, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($fontIcon)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('font_icons.name', '=', $name )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id, FontIcon $fontIcon):? FontIcon
    {
        return $this
            ->getJoin($fontIcon)
            ->where('font_icons.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, FontIcon $fontIcon, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($fontIcon)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('font_icons.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByFontIconTypeName(string $name, FontIcon $fontIcon):? FontIcon
    {
        return $this
            ->getJoin($fontIcon)
            ->where('font_icon_types.name', '=', $name )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByFontIconTypeNameList(string $name, FontIcon $fontIcon, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($fontIcon)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('font_icon_types.name', '=', $name )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByFontIconTypeId(int $id, FontIcon $fontIcon):? FontIcon
    {
        return $this
            ->getJoin($fontIcon)
            ->where('font_icon_types.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByFontIconTypeIdList(int $id, FontIcon $fontIcon, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($fontIcon)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('font_icon_types.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
