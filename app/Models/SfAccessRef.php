<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 16:04:23
 * Time: 2022/09/14
 * Class SfAccessRef
 * @package App\Models
 */
class SfAccessRef extends Model
{
    use ModelTrait;
    protected $primaryKey = 'accessId';
    public $incrementing = true;
    protected $table = 'sf_access_ref';
    protected $fillable = ['accessId', 'accessName', 'created_at', 'updated_at'];
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
