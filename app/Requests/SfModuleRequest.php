<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:50
 * Time: 2021/11/06
 * Class SfModuleRequest
 * @package App\Requests
 */

class SfModuleRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'moduleCode' => 'required|max:100|string',
            'moduleName' => 'required|max:50|string',
            'fileName' => 'required|max:50|string',
            'typeFile' => 'required|max:15|string',
            'action' => 'nullable|max:15|string'
        ];
    }
}
