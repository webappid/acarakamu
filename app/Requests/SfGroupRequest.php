<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:34
 * Time: 2021/11/06
 * Class SfGroupRequest
 * @package App\Requests
 */

class SfGroupRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'groupName' => 'required|max:15|string'
        ];
    }
}
