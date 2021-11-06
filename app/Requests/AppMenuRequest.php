<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:00
 * Time: 2021/11/06
 * Class AppMenuRequest
 * @package App\Requests
 */

class AppMenuRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'parent_id' => 'nullable|int',
            'name' => 'required|max:100|string',
            'route_id' => 'nullable|int',
            'icon' => 'nullable|max:100|string',
            'menu_order' => 'required|int',
            'is_active' => 'required|max:5|string'
        ];
    }
}
