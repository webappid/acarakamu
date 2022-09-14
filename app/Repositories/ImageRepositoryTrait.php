<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\Image;
use App\Repositories\Requests\ImageRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:08
 * Time: 2022/09/14
 * Trait ImageRepositoryTrait
 * @package App\Repositories
 */
trait ImageRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $sf_user = app()->make(Join::class);
        $sf_user->class = SfUser::class;
        $sf_user->foreign = 'image.imageUserId';
        $sf_user->type = 'inner';
        $sf_user->primary = 'sf_user.userId';
        $this->joinTable['sf_user'] = $sf_user;

        $imageOwnerUserId_sf_user = app()->make(Join::class);
        $imageOwnerUserId_sf_user->class = SfUser::class;
        $imageOwnerUserId_sf_user->foreign = 'image.imageOwnerUserId';
        $imageOwnerUserId_sf_user->type = 'inner';
        $imageOwnerUserId_sf_user->primary = 'imageOwnerUserId_sf_user.userId';
        $this->joinTable['imageOwnerUserId_sf_user'] = $imageOwnerUserId_sf_user;

    }

    /**
     * @inheritDoc
     */
    public function store(ImageRepositoryRequest $imageRepositoryRequest, Image $image): ?Image
    {
        try {
            $image = Lazy::transform($imageRepositoryRequest, $image);
            $image->save();
            return $image;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $imageId, ImageRepositoryRequest $imageRepositoryRequest, Image $image): ?Image
    {
        $image = $image->where('imageId', $imageId)->first();
        if($image != null){
            try {
                $image = Lazy::transform($imageRepositoryRequest, $image);
                $image->save();
                return $image;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $image;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $imageId, Image $image): bool
    {
        $image = $image->where('image.imageId',$imageId)->first();
        if($image!=null){
            return $image->delete();
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
    public function get(Image $image, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($image)
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
    public function getCount(Image $image, string $q = null): int
    {
        return $this
            ->getJoin($image)
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
    public function getByImageId(int $imageId, Image $image):? Image
    {
        return $this
            ->getJoin($image)
            ->where('image.imageId', '=', $imageId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByImageIdList(int $imageId, Image $image, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($image)
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
    public function getBySfUserUserName(string $userName, Image $image):? Image
    {
        return $this
            ->getJoin($image)
            ->where('sf_user.userName', '=', $userName )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserNameList(string $userName, Image $image, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($image)
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
    public function getBySfUserUserId(int $userId, Image $image):? Image
    {
        return $this
            ->getJoin($image)
            ->where('sf_user.userId', '=', $userId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserIdList(int $userId, Image $image, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($image)
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
    public function getByImageOwnerUserIdSfUserUserName(string $userName, Image $image):? Image
    {
        return $this
            ->getJoin($image)
            ->where('imageOwnerUserId_sf_user.userName', '=', $userName )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByImageOwnerUserIdSfUserUserNameList(string $userName, Image $image, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($image)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('imageOwnerUserId_sf_user.userName', '=', $userName )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByImageOwnerUserIdSfUserUserId(int $userId, Image $image):? Image
    {
        return $this
            ->getJoin($image)
            ->where('imageOwnerUserId_sf_user.userId', '=', $userId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByImageOwnerUserIdSfUserUserIdList(int $userId, Image $image, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($image)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('imageOwnerUserId_sf_user.userId', '=', $userId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
