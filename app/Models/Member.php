<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 14:04:16
 * Time: 2021/11/06
 * Class Member
 * @package App\Models
 */
class Member extends Model
{
    use ModelTrait;
    protected $primaryKey = 'memberId';
    public $incrementing = true;
    protected $table = 'member';
    protected $fillable = ['memberId', 'memberUserId', 'memberFirstName', 'memberLastName', 'memberEmail', 'memberImageId', 'memberNoTelp', 'memberDateChange', 'created_at', 'updated_at'];
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
