<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 16:04:09
 * Time: 2022/09/14
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
