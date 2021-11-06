<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 14:04:00
 * Time: 2021/11/06
 * Class AppRoleMenu
 * @package App\Models
 */
class AppRoleMenu extends Model
{
    use ModelTrait;
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $table = 'app_role_menus';
    protected $fillable = ['id', 'menu_id', 'role_id', 'created_at', 'updated_at'];
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
