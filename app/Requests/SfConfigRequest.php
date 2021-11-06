<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:33
 * Time: 2021/11/06
 * Class SfConfigRequest
 * @package App\Requests
 */

class SfConfigRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'configCode' => 'required|max:20|string',
            'configName' => 'required|max:255|string'
        ];
    }
}
