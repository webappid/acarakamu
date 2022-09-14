<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:35
 * Time: 2022/09/14
 * Class SfMicroprocessInputRequest
 * @package App\Requests
 */

class SfMicroprocessInputRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'microprocessInputProcessId' => 'required|int',
            'microprocessInputParamId' => 'required|int',
            'microprocessInputParamOrder' => 'required|int',
            'microprocessInputParamParentId' => 'required|int',
            'microprocessInputAllowNull' => 'nullable|max:3|string',
            'microprocessInputModel' => 'required|max:9|string'
        ];
    }
}
