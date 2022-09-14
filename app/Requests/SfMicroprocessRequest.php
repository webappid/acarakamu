<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:33
 * Time: 2022/09/14
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
