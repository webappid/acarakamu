<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\CategoryRef;
use App\Models\CityRef;
use App\Models\Event;
use App\Repositories\Requests\EventRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:00
 * Time: 2022/09/14
 * Trait EventRepositoryTrait
 * @package App\Repositories
 */
trait EventRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $sf_user = app()->make(Join::class);
        $sf_user->class = SfUser::class;
        $sf_user->foreign = 'event.eventOwnerUserId';
        $sf_user->type = 'inner';
        $sf_user->primary = 'sf_user.userId';
        $this->joinTable['sf_user'] = $sf_user;

        $eventUserId_sf_user = app()->make(Join::class);
        $eventUserId_sf_user->class = SfUser::class;
        $eventUserId_sf_user->foreign = 'event.eventUserId';
        $eventUserId_sf_user->type = 'inner';
        $eventUserId_sf_user->primary = 'eventUserId_sf_user.userId';
        $this->joinTable['eventUserId_sf_user'] = $eventUserId_sf_user;

        $image = app()->make(Join::class);
        $image->class = Image::class;
        $image->foreign = 'event.eventCoverImageId';
        $image->type = 'left';
        $image->primary = 'image.imageId';
        $this->joinTable['image'] = $image;

        $event_status_ref = app()->make(Join::class);
        $event_status_ref->class = EventStatusRef::class;
        $event_status_ref->foreign = 'event.eventStatusId';
        $event_status_ref->type = 'inner';
        $event_status_ref->primary = 'event_status_ref.eventStatusId';
        $this->joinTable['event_status_ref'] = $event_status_ref;

        $category_ref = app()->make(Join::class);
        $category_ref->class = CategoryRef::class;
        $category_ref->foreign = 'event.eventCategoryId';
        $category_ref->type = 'inner';
        $category_ref->primary = 'category_ref.categoryId';
        $this->joinTable['category_ref'] = $category_ref;

        $city_ref = app()->make(Join::class);
        $city_ref->class = CityRef::class;
        $city_ref->foreign = 'event.eventCityId';
        $city_ref->type = 'inner';
        $city_ref->primary = 'city_ref.cityId';
        $this->joinTable['city_ref'] = $city_ref;

    }

    /**
     * @inheritDoc
     */
    public function store(EventRepositoryRequest $eventRepositoryRequest, Event $event): ?Event
    {
        try {
            $event = Lazy::transform($eventRepositoryRequest, $event);
            $event->save();
            return $event;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $eventId, EventRepositoryRequest $eventRepositoryRequest, Event $event): ?Event
    {
        $event = $event->where('eventId', $eventId)->first();
        if($event != null){
            try {
                $event = Lazy::transform($eventRepositoryRequest, $event);
                $event->save();
                return $event;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $event;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $eventId, Event $event): bool
    {
        $event = $event->where('event.eventId',$eventId)->first();
        if($event!=null){
            return $event->delete();
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
    public function get(Event $event, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($event)
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
    public function getCount(Event $event, string $q = null): int
    {
        return $this
            ->getJoin($event)
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
    public function getByEventId(int $eventId, Event $event):? Event
    {
        return $this
            ->getJoin($event)
            ->where('event.eventId', '=', $eventId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByEventIdList(int $eventId, Event $event, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($event)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('event.eventId', '=', $eventId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserName(string $userName, Event $event):? Event
    {
        return $this
            ->getJoin($event)
            ->where('sf_user.userName', '=', $userName )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserNameList(string $userName, Event $event, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($event)
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
    public function getBySfUserUserId(int $userId, Event $event):? Event
    {
        return $this
            ->getJoin($event)
            ->where('sf_user.userId', '=', $userId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserIdList(int $userId, Event $event, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($event)
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
    public function getByEventUserIdSfUserUserName(string $userName, Event $event):? Event
    {
        return $this
            ->getJoin($event)
            ->where('eventUserId_sf_user.userName', '=', $userName )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByEventUserIdSfUserUserNameList(string $userName, Event $event, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($event)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('eventUserId_sf_user.userName', '=', $userName )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByEventUserIdSfUserUserId(int $userId, Event $event):? Event
    {
        return $this
            ->getJoin($event)
            ->where('eventUserId_sf_user.userId', '=', $userId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByEventUserIdSfUserUserIdList(int $userId, Event $event, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($event)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('eventUserId_sf_user.userId', '=', $userId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByImageImageId(int $imageId, Event $event):? Event
    {
        return $this
            ->getJoin($event)
            ->where('image.imageId', '=', $imageId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByImageImageIdList(int $imageId, Event $event, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($event)
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
    public function getByEventStatusRefEventStatusId(int $eventStatusId, Event $event):? Event
    {
        return $this
            ->getJoin($event)
            ->where('event_status_ref.eventStatusId', '=', $eventStatusId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByEventStatusRefEventStatusIdList(int $eventStatusId, Event $event, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($event)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('event_status_ref.eventStatusId', '=', $eventStatusId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByCategoryRefCategoryId(int $categoryId, Event $event):? Event
    {
        return $this
            ->getJoin($event)
            ->where('category_ref.categoryId', '=', $categoryId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByCategoryRefCategoryIdList(int $categoryId, Event $event, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($event)
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
    public function getByCityRefCityId(int $cityId, Event $event):? Event
    {
        return $this
            ->getJoin($event)
            ->where('city_ref.cityId', '=', $cityId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByCityRefCityIdList(int $cityId, Event $event, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($event)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('city_ref.cityId', '=', $cityId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
