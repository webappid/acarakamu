<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 16:04:32
 * Time: 2022/09/14
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
