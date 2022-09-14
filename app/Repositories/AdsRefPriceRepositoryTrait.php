<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\AdsRefPrice;
use App\Repositories\Requests\AdsRefPriceRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:03:57
 * Time: 2022/09/14
 * Trait AdsRefPriceRepositoryTrait
 * @package App\Repositories
 */
trait AdsRefPriceRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $sf_user = app()->make(Join::class);
        $sf_user->class = SfUser::class;
        $sf_user->foreign = 'ads_ref_price.adsPriceRefUserId';
        $sf_user->type = 'inner';
        $sf_user->primary = 'sf_user.userId';
        $this->joinTable['sf_user'] = $sf_user;

    }

    /**
     * @inheritDoc
     */
    public function store(AdsRefPriceRepositoryRequest $adsRefPriceRepositoryRequest, AdsRefPrice $adsRefPrice): ?AdsRefPrice
    {
        try {
            $adsRefPrice = Lazy::transform($adsRefPriceRepositoryRequest, $adsRefPrice);
            $adsRefPrice->save();
            return $adsRefPrice;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $adsPriceRefId, AdsRefPriceRepositoryRequest $adsRefPriceRepositoryRequest, AdsRefPrice $adsRefPrice): ?AdsRefPrice
    {
        $adsRefPrice = $adsRefPrice->where('adsPriceRefId', $adsPriceRefId)->first();
        if($adsRefPrice != null){
            try {
                $adsRefPrice = Lazy::transform($adsRefPriceRepositoryRequest, $adsRefPrice);
                $adsRefPrice->save();
                return $adsRefPrice;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $adsRefPrice;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $adsPriceRefId, AdsRefPrice $adsRefPrice): bool
    {
        $adsRefPrice = $adsRefPrice->where('ads_ref_price.adsPriceRefId',$adsPriceRefId)->first();
        if($adsRefPrice!=null){
            return $adsRefPrice->delete();
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
    public function get(AdsRefPrice $adsRefPrice, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($adsRefPrice)
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
    public function getCount(AdsRefPrice $adsRefPrice, string $q = null): int
    {
        return $this
            ->getJoin($adsRefPrice)
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
    public function getByAdsPriceRefId(int $adsPriceRefId, AdsRefPrice $adsRefPrice):? AdsRefPrice
    {
        return $this
            ->getJoin($adsRefPrice)
            ->where('ads_ref_price.adsPriceRefId', '=', $adsPriceRefId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByAdsPriceRefIdList(int $adsPriceRefId, AdsRefPrice $adsRefPrice, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($adsRefPrice)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('ads_ref_price.adsPriceRefId', '=', $adsPriceRefId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserName(string $userName, AdsRefPrice $adsRefPrice):? AdsRefPrice
    {
        return $this
            ->getJoin($adsRefPrice)
            ->where('sf_user.userName', '=', $userName )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserNameList(string $userName, AdsRefPrice $adsRefPrice, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($adsRefPrice)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_user.userName', '=', $userName )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserId(int $userId, AdsRefPrice $adsRefPrice):? AdsRefPrice
    {
        return $this
            ->getJoin($adsRefPrice)
            ->where('sf_user.userId', '=', $userId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserIdList(int $userId, AdsRefPrice $adsRefPrice, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($adsRefPrice)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_user.userId', '=', $userId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
