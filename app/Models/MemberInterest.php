<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 16:04:11
 * Time: 2022/09/14
 * Class MemberInterest
 * @package App\Models
 */
class MemberInterest extends Model
{
    use ModelTrait;
    protected $primaryKey = 'memberInterestId';
    public $incrementing = true;
    protected $table = 'member_interest';
    protected $fillable = ['memberInterestId', 'memberInterestCategoryId', 'memberIntersetMemberId', 'created_at', 'updated_at'];
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
