<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\CategoryRef;
use App\Models\Member;
use App\Models\MemberInterest;
use App\Repositories\Requests\MemberInterestRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:11
 * Time: 2022/09/14
 * Trait MemberInterestRepositoryTrait
 * @package App\Repositories
 */
trait MemberInterestRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $category_ref = app()->make(Join::class);
        $category_ref->class = CategoryRef::class;
        $category_ref->foreign = 'member_interest.memberInterestCategoryId';
        $category_ref->type = 'inner';
        $category_ref->primary = 'category_ref.categoryId';
        $this->joinTable['category_ref'] = $category_ref;

        $member = app()->make(Join::class);
        $member->class = Member::class;
        $member->foreign = 'member_interest.memberIntersetMemberId';
        $member->type = 'inner';
        $member->primary = 'member.memberId';
        $this->joinTable['member'] = $member;

    }

    /**
     * @inheritDoc
     */
    public function store(MemberInterestRepositoryRequest $memberInterestRepositoryRequest, MemberInterest $memberInterest): ?MemberInterest
    {
        try {
            $memberInterest = Lazy::transform($memberInterestRepositoryRequest, $memberInterest);
            $memberInterest->save();
            return $memberInterest;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $memberInterestId, MemberInterestRepositoryRequest $memberInterestRepositoryRequest, MemberInterest $memberInterest): ?MemberInterest
    {
        $memberInterest = $memberInterest->where('memberInterestId', $memberInterestId)->first();
        if($memberInterest != null){
            try {
                $memberInterest = Lazy::transform($memberInterestRepositoryRequest, $memberInterest);
                $memberInterest->save();
                return $memberInterest;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $memberInterest;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $memberInterestId, MemberInterest $memberInterest): bool
    {
        $memberInterest = $memberInterest->where('member_interest.memberInterestId',$memberInterestId)->first();
        if($memberInterest!=null){
            return $memberInterest->delete();
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
    public function get(MemberInterest $memberInterest, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($memberInterest)
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
    public function getCount(MemberInterest $memberInterest, string $q = null): int
    {
        return $this
            ->getJoin($memberInterest)
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
    public function getByMemberInterestId(int $memberInterestId, MemberInterest $memberInterest):? MemberInterest
    {
        return $this
            ->getJoin($memberInterest)
            ->where('member_interest.memberInterestId', '=', $memberInterestId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByMemberInterestIdList(int $memberInterestId, MemberInterest $memberInterest, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($memberInterest)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('member_interest.memberInterestId', '=', $memberInterestId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByCategoryRefCategoryId(int $categoryId, MemberInterest $memberInterest):? MemberInterest
    {
        return $this
            ->getJoin($memberInterest)
            ->where('category_ref.categoryId', '=', $categoryId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByCategoryRefCategoryIdList(int $categoryId, MemberInterest $memberInterest, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($memberInterest)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('category_ref.categoryId', '=', $categoryId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByMemberMemberId(int $memberId, MemberInterest $memberInterest):? MemberInterest
    {
        return $this
            ->getJoin($memberInterest)
            ->where('member.memberId', '=', $memberId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByMemberMemberIdList(int $memberId, MemberInterest $memberInterest, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($memberInterest)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('member.memberId', '=', $memberId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
