<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\Event;
use App\Models\EventGallery;
use App\Repositories\Requests\EventGalleryRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:01
 * Time: 2022/09/14
 * Trait EventGalleryRepositoryTrait
 * @package App\Repositories
 */
trait EventGalleryRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $event = app()->make(Join::class);
        $event->class = Event::class;
        $event->foreign = 'event_gallery.eventGalleryEventId';
        $event->type = 'inner';
        $event->primary = 'event.eventId';
        $this->joinTable['event'] = $event;

        $image = app()->make(Join::class);
        $image->class = Image::class;
        $image->foreign = 'event_gallery.eventGalleryImageId';
        $image->type = 'inner';
        $image->primary = 'image.imageId';
        $this->joinTable['image'] = $image;

    }

    /**
     * @inheritDoc
     */
    public function store(EventGalleryRepositoryRequest $eventGalleryRepositoryRequest, EventGallery $eventGallery): ?EventGallery
    {
        try {
            $eventGallery = Lazy::transform($eventGalleryRepositoryRequest, $eventGallery);
            $eventGallery->save();
            return $eventGallery;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $eventGalleryId, EventGalleryRepositoryRequest $eventGalleryRepositoryRequest, EventGallery $eventGallery): ?EventGallery
    {
        $eventGallery = $eventGallery->where('eventGalleryId', $eventGalleryId)->first();
        if($eventGallery != null){
            try {
                $eventGallery = Lazy::transform($eventGalleryRepositoryRequest, $eventGallery);
                $eventGallery->save();
                return $eventGallery;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $eventGallery;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $eventGalleryId, EventGallery $eventGallery): bool
    {
        $eventGallery = $eventGallery->where('event_gallery.eventGalleryId',$eventGalleryId)->first();
        if($eventGallery!=null){
            return $eventGallery->delete();
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
    public function get(EventGallery $eventGallery, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($eventGallery)
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
    public function getCount(EventGallery $eventGallery, string $q = null): int
    {
        return $this
            ->getJoin($eventGallery)
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
    public function getByEventGalleryId(int $eventGalleryId, EventGallery $eventGallery):? EventGallery
    {
        return $this
            ->getJoin($eventGallery)
            ->where('event_gallery.eventGalleryId', '=', $eventGalleryId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByEventGalleryIdList(int $eventGalleryId, EventGallery $eventGallery, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($eventGallery)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('event_gallery.eventGalleryId', '=', $eventGalleryId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByEventEventId(int $eventId, EventGallery $eventGallery):? EventGallery
    {
        return $this
            ->getJoin($eventGallery)
            ->where('event.eventId', '=', $eventId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByEventEventIdList(int $eventId, EventGallery $eventGallery, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($eventGallery)
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
    public function getByImageImageId(int $imageId, EventGallery $eventGallery):? EventGallery
    {
        return $this
            ->getJoin($eventGallery)
            ->where('image.imageId', '=', $imageId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByImageImageIdList(int $imageId, EventGallery $eventGallery, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($eventGallery)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('image.imageId', '=', $imageId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
