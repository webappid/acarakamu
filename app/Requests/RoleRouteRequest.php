<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:21
 * Time: 2022/09/14
 * Class RoleRouteRequest
 * @package App\Requests
 */

class RoleRouteRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'route_id' => 'required|int',
            'role_id' => 'required|int'
        ];
    }
}
