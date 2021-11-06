<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:56
 * Time: 2021/11/06
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
