<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:44
 * Time: 2022/09/14
 * Class SystemLogRequest
 * @package App\Requests
 */

class SystemLogRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'logValue' => 'nullable|max:65535|string',
            'logTimeStam' => 'required|max:100|string'
        ];
    }
}
