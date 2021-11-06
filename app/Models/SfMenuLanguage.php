<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 14:04:42
 * Time: 2021/11/06
 * Class SfMenuLanguage
 * @package App\Models
 */
class SfMenuLanguage extends Model
{
    use ModelTrait;
    protected $primaryKey = 'menuLangId';
    public $incrementing = true;
    protected $table = 'sf_menu_language';
    protected $fillable = ['menuLangId', 'languageId', 'menuId', 'displayMenu', 'created_at', 'updated_at'];
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
