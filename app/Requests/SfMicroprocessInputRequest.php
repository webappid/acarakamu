<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:44
 * Time: 2021/11/06
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
