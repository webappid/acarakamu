<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 16:04:28
 * Time: 2022/09/14
 * Class SfLabel
 * @package App\Models
 */
class SfLabel extends Model
{
    use ModelTrait;
    protected $primaryKey = 'labelId';
    public $incrementing = true;
    protected $table = 'sf_label';
    protected $fillable = ['labelId', 'languageId', 'modulId', 'labelName', 'labelValue', 'userId', 'dateInsert', 'dateChange', 'publish', 'status', 'created_at', 'updated_at'];
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
