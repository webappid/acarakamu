<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\UserActivity;
use App\Repositories\Requests\UserActivityRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 14:04:58
 * Time: 2021/11/06
 * Trait UserActivityRepositoryTrait
 * @package App\Repositories
 */
trait UserActivityRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $users = app()->make(Join::class);
        $users->class = User::class;
        $users->foreign = 'user_activities.user_id';
        $users->type = 'left';
        $users->primary = 'users.id';
        $this->joinTable['users'] = $users;

    }

    /**
     * @inheritDoc
     */
    public function store(UserActivityRepositoryRequest $userActivityRepositoryRequest, UserActivity $userActivity): ?UserActivity
    {
        try {
            $userActivity = Lazy::transform($userActivityRepositoryRequest, $userActivity);
            $userActivity->save();
            return $userActivity;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, UserActivityRepositoryRequest $userActivityRepositoryRequest, UserActivity $userActivity): ?UserActivity
    {
        $userActivity = $userActivity->where('id', $id)->first();
        if($userActivity != null){
            try {
                $userActivity = Lazy::transform($userActivityRepositoryRequest, $userActivity);
                $userActivity->save();
                return $userActivity;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $userActivity;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, UserActivity $userActivity): bool
    {
        $userActivity = $userActivity->where('user_activities.id',$id)->first();
        if($userActivity!=null){
            return $userActivity->delete();
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
    public function get(UserActivity $userActivity, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($userActivity)
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
    public function getCount(UserActivity $userActivity, string $q = null): int
    {
        return $this
            ->getJoin($userActivity)
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
    public function getById(int $id, UserActivity $userActivity):? UserActivity
    {
        return $this
            ->getJoin($userActivity)
            ->where('user_activities.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, UserActivity $userActivity, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($userActivity)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('user_activities.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByUserApiToken(string $apiToken, UserActivity $userActivity):? UserActivity
    {
        return $this
            ->getJoin($userActivity)
            ->where('users.api_token', '=', $apiToken )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserApiTokenList(string $apiToken, UserActivity $userActivity, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($userActivity)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('users.api_token', '=', $apiToken )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByUserEmail(string $email, UserActivity $userActivity):? UserActivity
    {
        return $this
            ->getJoin($userActivity)
            ->where('users.email', '=', $email )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserEmailList(string $email, UserActivity $userActivity, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($userActivity)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('users.email', '=', $email )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByUserId(int $id, UserActivity $userActivity):? UserActivity
    {
        return $this
            ->getJoin($userActivity)
            ->where('users.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserIdList(int $id, UserActivity $userActivity, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($userActivity)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('users.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
