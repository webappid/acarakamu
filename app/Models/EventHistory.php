<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 14:04:08
 * Time: 2021/11/06
 * Class EventHistory
 * @package App\Models
 */
class EventHistory extends Model
{
    use ModelTrait;
    protected $primaryKey = 'eventHistoryId';
    public $incrementing = true;
    protected $table = 'event_history';
    protected $fillable = ['eventHistoryId', 'eventHitoryEventId', 'eventHistoryStatusId', 'eventHistoryMessage', 'eventHistoryDateTime', 'eventHistoryUserId', 'created_at', 'updated_at'];
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
