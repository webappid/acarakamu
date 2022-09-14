<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:31
 * Time: 2022/09/14
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
