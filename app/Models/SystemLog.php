<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 14:04:56
 * Time: 2021/11/06
 * Class SystemLog
 * @package App\Models
 */
class SystemLog extends Model
{
    use ModelTrait;
    protected $primaryKey = 'logId';
    public $incrementing = true;
    protected $table = 'system_log';
    protected $fillable = ['logId', 'logValue', 'logTimeStam', 'created_at', 'updated_at'];
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
