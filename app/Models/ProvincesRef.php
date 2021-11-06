<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 14:04:29
 * Time: 2021/11/06
 * Class ProvincesRef
 * @package App\Models
 */
class ProvincesRef extends Model
{
    use ModelTrait;
    protected $primaryKey = 'provincesRefId';
    public $incrementing = true;
    protected $table = 'provinces_ref';
    protected $fillable = ['provincesRefId', 'provincesRefNama', 'provincesRefStatusActive', 'provincesRefDateChange', 'provincesRefUserId', 'created_at', 'updated_at'];
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
