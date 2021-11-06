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
 * Class AppRoleMenuRequest
 * @package App\Requests
 */

class AppRoleMenuRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'menu_id' => 'required|int',
            'role_id' => 'required|int'
        ];
    }
}
