<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:03:50
 * Time: 2021/11/06
 * Class SecurityLevelRequest
 * @package App\Requests
 */

class SecurityLevelRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'Label' => 'required|max:255|string',
            'IsMMEM' => 'required|max:5|string'
        ];
    }
}
