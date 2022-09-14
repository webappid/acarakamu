<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 16:03:57
 * Time: 2022/09/14
 * Class AdsRefPrice
 * @package App\Models
 */
class AdsRefPrice extends Model
{
    use ModelTrait;
    protected $primaryKey = 'adsPriceRefId';
    public $incrementing = true;
    protected $table = 'ads_ref_price';
    protected $fillable = ['adsPriceRefId', 'adsPriceRefCode', 'adsPriceRefValue', 'adsPriceRefClick', 'adsPriceRefDateChange', 'adsPriceRefUserId', 'created_at', 'updated_at'];
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
