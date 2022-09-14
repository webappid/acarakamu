<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:40
 * Time: 2022/09/14
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
