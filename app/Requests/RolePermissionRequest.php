<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:30
 * Time: 2021/11/06
 * Class RolePermissionRequest
 * @package App\Requests
 */

class RolePermissionRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'role_id' => 'nullable|int',
            'permission_id' => 'nullable|int',
            'created_by' => 'nullable|int',
            'updated_by' => 'nullable|int'
        ];
    }
}
