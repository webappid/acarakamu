<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 16:04:41
 * Time: 2022/09/14
 * Class SfUser
 * @package App\Models
 */
class SfUser extends Model
{
    use ModelTrait;
    protected $primaryKey = 'userId';
    public $incrementing = true;
    protected $table = 'sf_user';
    protected $fillable = ['userId', 'userName', 'realName', 'pwdUser', 'groupId', 'lastLogin', 'status', 'loginKey', 'activateKey', 'dateTimeChange', 'created_at', 'updated_at'];
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
