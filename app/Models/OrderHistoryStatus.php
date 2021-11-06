<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 14:04:22
 * Time: 2021/11/06
 * Class OrderHistoryStatus
 * @package App\Models
 */
class OrderHistoryStatus extends Model
{
    use ModelTrait;
    protected $primaryKey = 'orderHistoryStatusId';
    public $incrementing = true;
    protected $table = 'order_history_status';
    protected $fillable = ['orderHistoryStatusId', 'orderHistoryStatusOrderId', 'orderHistoryStatusDesc', 'orderHistoryStatusStatusId', 'orderHistoryStatusUserId', 'created_at', 'updated_at'];
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
