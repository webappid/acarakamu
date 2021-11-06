<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:02
 * Time: 2021/11/06
 * Class AppRouteRequest
 * @package App\Requests
 */

class AppRouteRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'name' => 'required|max:255|string',
            'uri' => 'required|max:100|string',
            'method' => 'required|max:10|string',
            'status' => 'nullable|max:7|string'
        ];
    }
}
