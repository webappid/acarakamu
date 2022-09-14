<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:17
 * Time: 2022/09/14
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
