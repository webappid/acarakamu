<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 16:03:56
 * Time: 2022/09/14
 * Class AdsOrderDetail
 * @package App\Models
 */
class AdsOrderDetail extends Model
{
    use ModelTrait;
    protected $primaryKey = 'adsOrderDetailId';
    public $incrementing = true;
    protected $table = 'ads_order_detail';
    protected $fillable = ['adsOrderDetailId', 'adsOrderDetailAdsOrderId', 'adsOrderDetailAdsRefPriceId', 'adsOrderDetailAdsEventId', 'adsOrderDetailQty', 'adsOrderDetailSubTotal', 'adsOrderDetailTotal', 'adsOrderDetailDateChange', 'created_at', 'updated_at'];
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
