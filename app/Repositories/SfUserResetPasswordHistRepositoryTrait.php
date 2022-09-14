<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\SfUser;
use App\Models\SfUserResetPasswordHist;
use App\Repositories\Requests\SfUserResetPasswordHistRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:43
 * Time: 2022/09/14
 * Trait SfUserResetPasswordHistRepositoryTrait
 * @package App\Repositories
 */
trait SfUserResetPasswordHistRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $sf_user = app()->make(Join::class);
        $sf_user->class = SfUser::class;
        $sf_user->foreign = 'sf_user_reset_password_hist.userResetPasswordHistUserId';
        $sf_user->type = 'inner';
        $sf_user->primary = 'sf_user.userId';
        $this->joinTable['sf_user'] = $sf_user;

    }

    /**
     * @inheritDoc
     */
    public function store(SfUserResetPasswordHistRepositoryRequest $sfUserResetPasswordHistRepositoryRequest, SfUserResetPasswordHist $sfUserResetPasswordHist): ?SfUserResetPasswordHist
    {
        try {
            $sfUserResetPasswordHist = Lazy::transform($sfUserResetPasswordHistRepositoryRequest, $sfUserResetPasswordHist);
            $sfUserResetPasswordHist->save();
            return $sfUserResetPasswordHist;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $userResetPasswordHistId, SfUserResetPasswordHistRepositoryRequest $sfUserResetPasswordHistRepositoryRequest, SfUserResetPasswordHist $sfUserResetPasswordHist): ?SfUserResetPasswordHist
    {
        $sfUserResetPasswordHist = $sfUserResetPasswordHist->where('userResetPasswordHistId', $userResetPasswordHistId)->first();
        if($sfUserResetPasswordHist != null){
            try {
                $sfUserResetPasswordHist = Lazy::transform($sfUserResetPasswordHistRepositoryRequest, $sfUserResetPasswordHist);
                $sfUserResetPasswordHist->save();
                return $sfUserResetPasswordHist;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $sfUserResetPasswordHist;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $userResetPasswordHistId, SfUserResetPasswordHist $sfUserResetPasswordHist): bool
    {
        $sfUserResetPasswordHist = $sfUserResetPasswordHist->where('sf_user_reset_password_hist.userResetPasswordHistId',$userResetPasswordHistId)->first();
        if($sfUserResetPasswordHist!=null){
            return $sfUserResetPasswordHist->delete();
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
    public function get(SfUserResetPasswordHist $sfUserResetPasswordHist, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfUserResetPasswordHist)
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
    public function getCount(SfUserResetPasswordHist $sfUserResetPasswordHist, string $q = null): int
    {
        return $this
            ->getJoin($sfUserResetPasswordHist)
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
    public function getByUserResetPasswordHistId(int $userResetPasswordHistId, SfUserResetPasswordHist $sfUserResetPasswordHist):? SfUserResetPasswordHist
    {
        return $this
            ->getJoin($sfUserResetPasswordHist)
            ->where('sf_user_reset_password_hist.userResetPasswordHistId', '=', $userResetPasswordHistId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserResetPasswordHistIdList(int $userResetPasswordHistId, SfUserResetPasswordHist $sfUserResetPasswordHist, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfUserResetPasswordHist)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_user_reset_password_hist.userResetPasswordHistId', '=', $userResetPasswordHistId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserName(string $userName, SfUserResetPasswordHist $sfUserResetPasswordHist):? SfUserResetPasswordHist
    {
        return $this
            ->getJoin($sfUserResetPasswordHist)
            ->where('sf_user.userName', '=', $userName )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserNameList(string $userName, SfUserResetPasswordHist $sfUserResetPasswordHist, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfUserResetPasswordHist)
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
    public function getBySfUserUserId(int $userId, SfUserResetPasswordHist $sfUserResetPasswordHist):? SfUserResetPasswordHist
    {
        return $this
            ->getJoin($sfUserResetPasswordHist)
            ->where('sf_user.userId', '=', $userId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserIdList(int $userId, SfUserResetPasswordHist $sfUserResetPasswordHist, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfUserResetPasswordHist)
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
