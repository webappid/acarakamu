<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:27
 * Time: 2022/09/14
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
