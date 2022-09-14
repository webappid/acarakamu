<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:19
 * Time: 2022/09/14
 * Class ProvincesRefService
 * @package App\Requests
 */

class ProvincesRefSearchRequest extends AbstractFormRequest
{
    function rules():array
    {
        return [
            'q' => 'string|nullable|max:255',
            'search' => 'array|nullable|max:255',
        ];
    }
}
