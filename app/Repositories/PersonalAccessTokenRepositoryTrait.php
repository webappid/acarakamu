<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\PersonalAccessToken;
use App\Repositories\Requests\PersonalAccessTokenRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:18
 * Time: 2022/09/14
 * Trait PersonalAccessTokenRepositoryTrait
 * @package App\Repositories
 */
trait PersonalAccessTokenRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){

    }

    /**
     * @inheritDoc
     */
    public function store(PersonalAccessTokenRepositoryRequest $personalAccessTokenRepositoryRequest, PersonalAccessToken $personalAccessToken): ?PersonalAccessToken
    {
        try {
            $personalAccessToken = Lazy::transform($personalAccessTokenRepositoryRequest, $personalAccessToken);
            $personalAccessToken->save();
            return $personalAccessToken;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(string $token, PersonalAccessTokenRepositoryRequest $personalAccessTokenRepositoryRequest, PersonalAccessToken $personalAccessToken): ?PersonalAccessToken
    {
        $personalAccessToken = $personalAccessToken->where('token', $token)->first();
        if($personalAccessToken != null){
            try {
                $personalAccessToken = Lazy::transform($personalAccessTokenRepositoryRequest, $personalAccessToken);
                $personalAccessToken->save();
                return $personalAccessToken;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $personalAccessToken;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $token, PersonalAccessToken $personalAccessToken): bool
    {
        $personalAccessToken = $personalAccessToken->where('personal_access_tokens.token',$token)->first();
        if($personalAccessToken!=null){
            return $personalAccessToken->delete();
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
            return $query->where('personal_access_tokens.tokenable_type', 'LIKE', '%' . $q . '%')
        ->orWhere('personal_access_tokens.tokenable_id', 'LIKE', '%' . $q . '%')
        ->orWhere('personal_access_tokens.token', 'LIKE', '%' . $q . '%');
        });

    }

    /**
     * @inheritDoc
     */
    public function get(PersonalAccessToken $personalAccessToken, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($personalAccessToken)
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
    public function getCount(PersonalAccessToken $personalAccessToken, string $q = null): int
    {
        return $this
            ->getJoin($personalAccessToken)
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
    public function getByTokenableTypeTokenableId(string $tokenableType, int $tokenableId, PersonalAccessToken $personalAccessToken):? PersonalAccessToken
    {
        return $this
            ->getJoin($personalAccessToken)
            ->where('personal_access_tokens.tokenable_type', '=', $tokenableType )
            ->where('personal_access_tokens.tokenable_id', '=', $tokenableId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByTokenableTypeTokenableIdList(string $tokenableType, int $tokenableId, PersonalAccessToken $personalAccessToken, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($personalAccessToken)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('personal_access_tokens.tokenable_type', '=', $tokenableType )
            ->where('personal_access_tokens.tokenable_id', '=', $tokenableId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByToken(string $token, PersonalAccessToken $personalAccessToken):? PersonalAccessToken
    {
        return $this
            ->getJoin($personalAccessToken)
            ->where('personal_access_tokens.token', '=', $token )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByTokenList(string $token, PersonalAccessToken $personalAccessToken, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($personalAccessToken)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('personal_access_tokens.token', '=', $token )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id, PersonalAccessToken $personalAccessToken):? PersonalAccessToken
    {
        return $this
            ->getJoin($personalAccessToken)
            ->where('personal_access_tokens.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, PersonalAccessToken $personalAccessToken, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($personalAccessToken)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('personal_access_tokens.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
