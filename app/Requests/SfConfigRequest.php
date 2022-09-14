<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:24
 * Time: 2022/09/14
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
