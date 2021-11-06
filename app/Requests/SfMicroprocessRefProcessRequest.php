<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:49
 * Time: 2021/11/06
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
