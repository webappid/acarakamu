<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:22
 * Time: 2022/09/14
 * Class RouteRequest
 * @package App\Requests
 */

class RouteRequest extends AbstractFormRequest
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
