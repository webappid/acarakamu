<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 16:03:55
 * Time: 2022/09/14
 * Class AdsOrder
 * @package App\Models
 */
class AdsOrder extends Model
{
    use ModelTrait;
    protected $primaryKey = 'adsOrderId';
    public $incrementing = true;
    protected $table = 'ads_order';
    protected $fillable = ['adsOrderId', 'adsOrderNumber', 'adsOrderDateOrder', 'adsOrderStatusId', 'adsOrderDateChange', 'adsOrderQty', 'adsOrderTotal', 'adsOrderUserId', 'created_at', 'updated_at'];
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
