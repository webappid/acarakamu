<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:25
 * Time: 2021/11/06
 * Class PermissionRequest
 * @package App\Requests
 */

class PermissionRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'name' => 'nullable|max:100|string',
            'description' => 'nullable|max:65535|string',
            'created_by' => 'nullable|int',
            'updated_by' => 'nullable|int'
        ];
    }
}
