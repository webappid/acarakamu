<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 14:03:50
 * Time: 2021/11/06
 * Class SecurityLevel
 * @package App\Models
 */
class SecurityLevel extends Model
{
    use ModelTrait;
    protected $primaryKey = 'Id';
    public $incrementing = true;
    protected $table = 'SecurityLevel';
    protected $fillable = ['Id', 'Label', 'IsMMEM', 'created_at', 'updated_at'];
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
