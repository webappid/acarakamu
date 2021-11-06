<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:14
 * Time: 2021/11/06
 * Class FontIconRequest
 * @package App\Requests
 */

class FontIconRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'type_id' => 'required|int',
            'name' => 'required|max:255|string'
        ];
    }
}
