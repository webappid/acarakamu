<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\Image;
use App\Models\Member;
use App\Repositories\Requests\MemberRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:09
 * Time: 2022/09/14
 * Trait MemberRepositoryTrait
 * @package App\Repositories
 */
trait MemberRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $image = app()->make(Join::class);
        $image->class = Image::class;
        $image->foreign = 'member.memberImageId';
        $image->type = 'left';
        $image->primary = 'image.imageId';
        $this->joinTable['image'] = $image;

        $sf_user = app()->make(Join::class);
        $sf_user->class = SfUser::class;
        $sf_user->foreign = 'member.memberUserId';
        $sf_user->type = 'inner';
        $sf_user->primary = 'sf_user.userId';
        $this->joinTable['sf_user'] = $sf_user;

    }

    /**
     * @inheritDoc
     */
    public function store(MemberRepositoryRequest $memberRepositoryRequest, Member $member): ?Member
    {
        try {
            $member = Lazy::transform($memberRepositoryRequest, $member);
            $member->save();
            return $member;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $memberId, MemberRepositoryRequest $memberRepositoryRequest, Member $member): ?Member
    {
        $member = $member->where('memberId', $memberId)->first();
        if($member != null){
            try {
                $member = Lazy::transform($memberRepositoryRequest, $member);
                $member->save();
                return $member;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $member;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $memberId, Member $member): bool
    {
        $member = $member->where('member.memberId',$memberId)->first();
        if($member!=null){
            return $member->delete();
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
    public function get(Member $member, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($member)
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
    public function getCount(Member $member, string $q = null): int
    {
        return $this
            ->getJoin($member)
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
    public function getByMemberId(int $memberId, Member $member):? Member
    {
        return $this
            ->getJoin($member)
            ->where('member.memberId', '=', $memberId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByMemberIdList(int $memberId, Member $member, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($member)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('member.memberId', '=', $memberId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByImageImageId(int $imageId, Member $member):? Member
    {
        return $this
            ->getJoin($member)
            ->where('image.imageId', '=', $imageId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByImageImageIdList(int $imageId, Member $member, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($member)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('image.imageId', '=', $imageId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserName(string $userName, Member $member):? Member
    {
        return $this
            ->getJoin($member)
            ->where('sf_user.userName', '=', $userName )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserNameList(string $userName, Member $member, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($member)
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
    public function getBySfUserUserId(int $userId, Member $member):? Member
    {
        return $this
            ->getJoin($member)
            ->where('sf_user.userId', '=', $userId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserIdList(int $userId, Member $member, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($member)
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
