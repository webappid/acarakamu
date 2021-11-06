<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:37
 * Time: 2021/11/06
 * Class SfGroupModuleRequest
 * @package App\Requests
 */

class SfGroupModuleRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'groupId' => 'required|int',
            'moduleId' => 'required|int',
            'accessId' => 'nullable|max:20|string'
        ];
    }
}
