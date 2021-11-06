<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 14:04:09
 * Time: 2021/11/06
 * Class EventMemberLike
 * @package App\Models
 */
class EventMemberLike extends Model
{
    use ModelTrait;
    protected $primaryKey = 'eventMemberLikeId';
    public $incrementing = true;
    protected $table = 'event_member_like';
    protected $fillable = ['eventMemberLikeId', 'eventMemberLikeEventId', 'eventMemberLikeMemberId', 'eventMemberLikeStars', 'eventMemberLikeDateChange', 'eventMemberLikeUserId', 'created_at', 'updated_at'];
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
