<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:40
 * Time: 2021/11/06
 * Class SfMenuRequest
 * @package App\Requests
 */

class SfMenuRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'menuName' => 'nullable|max:25|string',
            'menuPath' => 'nullable|max:255|string',
            'moduleId' => 'nullable|int',
            'parentLink' => 'nullable|int',
            'menuIcon' => 'nullable|max:50|string',
            'order' => 'nullable|int',
            'userId' => 'nullable|int',
            'dateChange' => 'nullable|max:100|string'
        ];
    }
}
