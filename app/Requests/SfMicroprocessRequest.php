<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:43
 * Time: 2021/11/06
 * Class SfMicroprocessRequest
 * @package App\Requests
 */

class SfMicroprocessRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'microprocessCode' => 'required|max:50|string',
            'microprocessDesc' => 'required|max:200|string',
            'microprocessAccess' => 'required|max:10|string',
            'microprocessMethod' => 'required|max:7|string',
            'microprocessCustomeSuccessCode' => 'nullable|max:5|string',
            'microprocessCustomeSuccessMessage' => 'nullable|max:65535|string',
            'microprocessReturn' => 'required|max:4|string',
            'microprocessStatus' => 'required|max:6|string'
        ];
    }
}
