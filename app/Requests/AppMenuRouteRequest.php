<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:03:59
 * Time: 2021/11/06
 * Class AppMenuRouteRequest
 * @package App\Requests
 */

class AppMenuRouteRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'menu_id' => 'required|int',
            'route_id' => 'required|int'
        ];
    }
}
