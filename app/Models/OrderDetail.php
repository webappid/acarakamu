<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 16:04:14
 * Time: 2022/09/14
 * Class OrderDetail
 * @package App\Models
 */
class OrderDetail extends Model
{
    use ModelTrait;
    protected $primaryKey = 'orderDetailId';
    public $incrementing = true;
    protected $table = 'order_detail';
    protected $fillable = ['orderDetailId', 'orderDetailOrderId', 'orderDetailEventId', 'orderDetailQty', 'orderDetailEventCost', 'orderDetailDateChange', 'created_at', 'updated_at'];
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
