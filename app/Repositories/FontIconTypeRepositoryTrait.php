<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\FontIconType;
use App\Repositories\Requests\FontIconTypeRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 14:04:13
 * Time: 2021/11/06
 * Trait FontIconTypeRepositoryTrait
 * @package App\Repositories
 */
trait FontIconTypeRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){

    }

    /**
     * @inheritDoc
     */
    public function store(FontIconTypeRepositoryRequest $fontIconTypeRepositoryRequest, FontIconType $fontIconType): ?FontIconType
    {
        try {
            $fontIconType = Lazy::transform($fontIconTypeRepositoryRequest, $fontIconType);
            $fontIconType->save();
            return $fontIconType;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(string $name, FontIconTypeRepositoryRequest $fontIconTypeRepositoryRequest, FontIconType $fontIconType): ?FontIconType
    {
        $fontIconType = $fontIconType->where('name', $name)->first();
        if($fontIconType != null){
            try {
                $fontIconType = Lazy::transform($fontIconTypeRepositoryRequest, $fontIconType);
                $fontIconType->save();
                return $fontIconType;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $fontIconType;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $name, FontIconType $fontIconType): bool
    {
        $fontIconType = $fontIconType->where('font_icon_types.name',$name)->first();
        if($fontIconType!=null){
            return $fontIconType->delete();
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
            return $query->where('font_icon_types.name', 'LIKE', '%' . $q . '%');
        });

    }

    /**
     * @inheritDoc
     */
    public function get(FontIconType $fontIconType, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($fontIconType)
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
    public function getCount(FontIconType $fontIconType, string $q = null): int
    {
        return $this
            ->getJoin($fontIconType)
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
    public function getByName(string $name, FontIconType $fontIconType):? FontIconType
    {
        return $this
            ->getJoin($fontIconType)
            ->where('font_icon_types.name', '=', $name )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByNameList(string $name, FontIconType $fontIconType, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($fontIconType)
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
    public function getById(int $id, FontIconType $fontIconType):? FontIconType
    {
        return $this
            ->getJoin($fontIconType)
            ->where('font_icon_types.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, FontIconType $fontIconType, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($fontIconType)
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
