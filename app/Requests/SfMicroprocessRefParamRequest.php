<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:47
 * Time: 2021/11/06
 * Class SfMicroprocessRefParamRequest
 * @package App\Requests
 */

class SfMicroprocessRefParamRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'paramName' => 'required|max:150|string',
            'paramTypeData' => 'required|max:10|string',
            'paramAllowNull' => 'required|max:3|string'
        ];
    }
}
