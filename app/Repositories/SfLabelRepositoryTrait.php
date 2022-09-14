<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\SfLabel;
use App\Repositories\Requests\SfLabelRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:28
 * Time: 2022/09/14
 * Trait SfLabelRepositoryTrait
 * @package App\Repositories
 */
trait SfLabelRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){

    }

    /**
     * @inheritDoc
     */
    public function store(SfLabelRepositoryRequest $sfLabelRepositoryRequest, SfLabel $sfLabel): ?SfLabel
    {
        try {
            $sfLabel = Lazy::transform($sfLabelRepositoryRequest, $sfLabel);
            $sfLabel->save();
            return $sfLabel;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $labelId, SfLabelRepositoryRequest $sfLabelRepositoryRequest, SfLabel $sfLabel): ?SfLabel
    {
        $sfLabel = $sfLabel->where('labelId', $labelId)->first();
        if($sfLabel != null){
            try {
                $sfLabel = Lazy::transform($sfLabelRepositoryRequest, $sfLabel);
                $sfLabel->save();
                return $sfLabel;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $sfLabel;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $labelId, SfLabel $sfLabel): bool
    {
        $sfLabel = $sfLabel->where('sf_label.labelId',$labelId)->first();
        if($sfLabel!=null){
            return $sfLabel->delete();
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
            return $query->where('sf_label.languageId', 'LIKE', '%' . $q . '%')
        ->orWhere('sf_label.userId', 'LIKE', '%' . $q . '%');
        });

    }

    /**
     * @inheritDoc
     */
    public function get(SfLabel $sfLabel, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfLabel)
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
    public function getCount(SfLabel $sfLabel, string $q = null): int
    {
        return $this
            ->getJoin($sfLabel)
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
    public function getByLanguageId(int $languageId, SfLabel $sfLabel):? SfLabel
    {
        return $this
            ->getJoin($sfLabel)
            ->where('sf_label.languageId', '=', $languageId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByLanguageIdList(int $languageId, SfLabel $sfLabel, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfLabel)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_label.languageId', '=', $languageId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByUserId(int $userId, SfLabel $sfLabel):? SfLabel
    {
        return $this
            ->getJoin($sfLabel)
            ->where('sf_label.userId', '=', $userId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserIdList(int $userId, SfLabel $sfLabel, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfLabel)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_label.userId', '=', $userId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByLabelId(int $labelId, SfLabel $sfLabel):? SfLabel
    {
        return $this
            ->getJoin($sfLabel)
            ->where('sf_label.labelId', '=', $labelId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByLabelIdList(int $labelId, SfLabel $sfLabel, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfLabel)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_label.labelId', '=', $labelId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
