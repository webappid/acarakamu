<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 16:04:43
 * Time: 2022/09/14
 * Class SfUserResetPasswordHist
 * @package App\Models
 */
class SfUserResetPasswordHist extends Model
{
    use ModelTrait;
    protected $primaryKey = 'userResetPasswordHistId';
    public $incrementing = true;
    protected $table = 'sf_user_reset_password_hist';
    protected $fillable = ['userResetPasswordHistId', 'userResetPasswordHistUserId', 'userResetPasswordHistCode', 'userResetPasswordHistValidUntil', 'userResetPasswordHistStatus', 'created_at', 'updated_at'];
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
