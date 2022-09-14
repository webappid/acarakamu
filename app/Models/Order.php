<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 16:04:13
 * Time: 2022/09/14
 * Class Order
 * @package App\Models
 */
class Order extends Model
{
    use ModelTrait;
    protected $primaryKey = 'orderId';
    public $incrementing = true;
    protected $table = 'order';
    protected $fillable = ['orderId', 'orderNumber', 'orderOrderStatus', 'orderMemberId', 'orderQty', 'orderCost', 'orderDateTimeLimit', 'orderDateTimeChange', 'orderUserId', 'created_at', 'updated_at'];
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
