<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:03:57
 * Time: 2021/11/06
 * Class AppMenuCategoryRequest
 * @package App\Requests
 */

class AppMenuCategoryRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'name' => 'required|max:255|string'
        ];
    }
}
