<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 14:03:59
 * Time: 2021/11/06
 * Class AppMenuRoute
 * @package App\Models
 */
class AppMenuRoute extends Model
{
    use ModelTrait;
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $table = 'app_menu_routes';
    protected $fillable = ['id', 'menu_id', 'route_id', 'created_at', 'updated_at'];
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
