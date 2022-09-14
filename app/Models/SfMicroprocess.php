<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 16:04:33
 * Time: 2022/09/14
 * Class SfMicroprocess
 * @package App\Models
 */
class SfMicroprocess extends Model
{
    use ModelTrait;
    protected $primaryKey = 'microprocessId';
    public $incrementing = true;
    protected $table = 'sf_microprocess';
    protected $fillable = ['microprocessId', 'microprocessCode', 'microprocessDesc', 'microprocessAccess', 'microprocessMethod', 'microprocessCustomeSuccessCode', 'microprocessCustomeSuccessMessage', 'microprocessReturn', 'microprocessStatus', 'created_at', 'updated_at'];
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
