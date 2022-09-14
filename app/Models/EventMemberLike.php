<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 16:04:03
 * Time: 2022/09/14
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
