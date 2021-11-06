<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 14:04:46
 * Time: 2021/11/06
 * Class SfMicroprocessProcess
 * @package App\Models
 */
class SfMicroprocessProcess extends Model
{
    use ModelTrait;
    protected $primaryKey = 'microprocessProcessId';
    public $incrementing = true;
    protected $table = 'sf_microprocess_process';
    protected $fillable = ['microprocessProcessId', 'microprocessProcessMicroprocessId', 'microprocessProcessOrder', 'microprocessProcessProcessId', 'microprocessProcessNext', 'microprocessProcessJumpProcess', 'microprocessProcessJoin', 'microprocessProcessLinkId', 'microprocessProcessKeyId', 'microprocessProcessForeignId', 'microprocessProcessEmpty', 'microprocessProcessFalseCode', 'microprocessProcessFalseMessage', 'microprocessProcessTrueCode', 'microprocessProcessTrueMessage', 'created_at', 'updated_at'];
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
