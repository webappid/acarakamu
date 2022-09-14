<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 16:04:08
 * Time: 2022/09/14
 * Class Image
 * @package App\Models
 */
class Image extends Model
{
    use ModelTrait;
    protected $primaryKey = 'imageId';
    public $incrementing = true;
    protected $table = 'image';
    protected $fillable = ['imageId', 'imageName', 'imageDescription', 'imageAlt', 'imageOwnerUserId', 'imageDateChange', 'imageUserId', 'created_at', 'updated_at'];
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
