<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:35
 * Time: 2021/11/06
 * Class SfGroupMenuRequest
 * @package App\Requests
 */

class SfGroupMenuRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'groupId' => 'nullable|int',
            'menuId' => 'nullable|int',
            'menuInc' => 'nullable|int'
        ];
    }
}
