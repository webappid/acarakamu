<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 14:04:04
 * Time: 2021/11/06
 * Class CategoryRef
 * @package App\Models
 */
class CategoryRef extends Model
{
    use ModelTrait;
    protected $primaryKey = 'categoryId';
    public $incrementing = true;
    protected $table = 'category_ref';
    protected $fillable = ['categoryId', 'categoryNama', 'categoryImageId', 'categoryIcon', 'categoryStatusAktif', 'categoryDateChange', 'categoryOrderBy', 'categoryUserId', 'created_at', 'updated_at'];
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
