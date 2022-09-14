<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:38
 * Time: 2022/09/14
 * Class SfMicroprocessRefProcessRequest
 * @package App\Requests
 */

class SfMicroprocessRefProcessRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'processCode' => 'required|max:50|string',
            'processDesc' => 'required|max:255|string',
            'processProcess' => 'nullable|max:65535|string',
            'processMethod' => 'required|max:7|string',
            'processResultParamId' => 'nullable|int',
            'processType' => 'required|max:9|string'
        ];
    }
}
