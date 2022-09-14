<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:37
 * Time: 2022/09/14
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
