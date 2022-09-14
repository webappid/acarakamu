<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:25
 * Time: 2022/09/14
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
