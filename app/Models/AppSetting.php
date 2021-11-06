<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 14:04:03
 * Time: 2021/11/06
 * Class AppSetting
 * @package App\Models
 */
class AppSetting extends Model
{
    use ModelTrait;
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $table = 'app_settings';
    protected $fillable = ['id', 'date_time_format', 'date_format', 'time_format', 'hour_minute_format', 'user_id', 'creator_id', 'owner_id', 'created_at', 'updated_at'];
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
