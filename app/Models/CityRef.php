<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 14:04:05
 * Time: 2021/11/06
 * Class CityRef
 * @package App\Models
 */
class CityRef extends Model
{
    use ModelTrait;
    protected $primaryKey = 'cityId';
    public $incrementing = true;
    protected $table = 'city_ref';
    protected $fillable = ['cityId', 'cityProvincesRefId', 'cityNama', 'cityStatusAktif', 'cityDateChange', 'cityUserId', 'created_at', 'updated_at'];
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
