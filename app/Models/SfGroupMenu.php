<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 14:04:35
 * Time: 2021/11/06
 * Class SfGroupMenu
 * @package App\Models
 */
class SfGroupMenu extends Model
{
    use ModelTrait;
    protected $primaryKey = 'groupMenuId';
    public $incrementing = true;
    protected $table = 'sf_group_menu';
    protected $fillable = ['groupMenuId', 'groupId', 'menuId', 'menuInc', 'created_at', 'updated_at'];
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
