<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:20
 * Time: 2022/09/14
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
