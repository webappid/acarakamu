<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\SfGroup;
use App\Models\SfUser;
use App\Repositories\Requests\SfUserRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:41
 * Time: 2022/09/14
 * Trait SfUserRepositoryTrait
 * @package App\Repositories
 */
trait SfUserRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $sf_group = app()->make(Join::class);
        $sf_group->class = SfGroup::class;
        $sf_group->foreign = 'sf_user.groupId';
        $sf_group->type = 'left';
        $sf_group->primary = 'sf_group.groupId';
        $this->joinTable['sf_group'] = $sf_group;

    }

    /**
     * @inheritDoc
     */
    public function store(SfUserRepositoryRequest $sfUserRepositoryRequest, SfUser $sfUser): ?SfUser
    {
        try {
            $sfUser = Lazy::transform($sfUserRepositoryRequest, $sfUser);
            $sfUser->save();
            return $sfUser;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(string $userName, SfUserRepositoryRequest $sfUserRepositoryRequest, SfUser $sfUser): ?SfUser
    {
        $sfUser = $sfUser->where('userName', $userName)->first();
        if($sfUser != null){
            try {
                $sfUser = Lazy::transform($sfUserRepositoryRequest, $sfUser);
                $sfUser->save();
                return $sfUser;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $sfUser;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $userName, SfUser $sfUser): bool
    {
        $sfUser = $sfUser->where('sf_user.userName',$userName)->first();
        if($sfUser!=null){
            return $sfUser->delete();
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
            return $query->where('sf_user.userName', 'LIKE', '%' . $q . '%');
        });

    }

    /**
     * @inheritDoc
     */
    public function get(SfUser $sfUser, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfUser)
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
    public function getCount(SfUser $sfUser, string $q = null): int
    {
        return $this
            ->getJoin($sfUser)
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
    public function getByUserName(string $userName, SfUser $sfUser):? SfUser
    {
        return $this
            ->getJoin($sfUser)
            ->where('sf_user.userName', '=', $userName )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserNameList(string $userName, SfUser $sfUser, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfUser)
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
    public function getByUserId(int $userId, SfUser $sfUser):? SfUser
    {
        return $this
            ->getJoin($sfUser)
            ->where('sf_user.userId', '=', $userId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserIdList(int $userId, SfUser $sfUser, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfUser)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_user.userId', '=', $userId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getBySfGroupGroupId(int $groupId, SfUser $sfUser):? SfUser
    {
        return $this
            ->getJoin($sfUser)
            ->where('sf_group.groupId', '=', $groupId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfGroupGroupIdList(int $groupId, SfUser $sfUser, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfUser)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_group.groupId', '=', $groupId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
