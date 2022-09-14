<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 16:04:00
 * Time: 2022/09/14
 * Class Event
 * @package App\Models
 */
class Event extends Model
{
    use ModelTrait;
    protected $primaryKey = 'eventId';
    public $incrementing = true;
    protected $table = 'event';
    protected $fillable = ['eventId', 'eventTitle', 'eventCoverImageId', 'eventDescription', 'eventCityId', 'eventAlamatDetil', 'eventCategoryId', 'eventPrice', 'eventInfo', 'eventStatusId', 'eventDateTimeStart', 'eventDateTimeEnd', 'eventDateChange', 'eventQuota', 'eventQuotaSisa', 'eventGMT', 'eventOwnerUserId', 'eventUserId', 'created_at', 'updated_at'];
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
