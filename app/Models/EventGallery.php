<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 14:04:07
 * Time: 2021/11/06
 * Class EventGallery
 * @package App\Models
 */
class EventGallery extends Model
{
    use ModelTrait;
    protected $primaryKey = 'eventGalleryId';
    public $incrementing = true;
    protected $table = 'event_gallery';
    protected $fillable = ['eventGalleryId', 'eventGalleryEventId', 'eventGalleryImageId', 'eventGalleryDateChange', 'eventGalleryUserId', 'created_at', 'updated_at'];
    protected $hidden = [];

    /**
     * @param bool $isFresh
     * @return mixed
     */
    public function getColumns(bool $isFresh = false)
    {
        $columns = $this->getAllColumn($isFresh);

        $forbiddenField = [
            "created_at",
            "updated_at"
        ];

        foreach ($forbiddenField as $item) {
            unset($columns[$item]);
        }

        return $columns;
    }
}
