<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 16:04:31
 * Time: 2022/09/14
 * Class SfMenu
 * @package App\Models
 */
class SfMenu extends Model
{
    use ModelTrait;
    protected $primaryKey = 'menuId';
    public $incrementing = true;
    protected $table = 'sf_menu';
    protected $fillable = ['menuId', 'menuName', 'menuPath', 'moduleId', 'parentLink', 'menuIcon', 'order', 'userId', 'dateChange', 'created_at', 'updated_at'];
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
