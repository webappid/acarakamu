<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:24
 * Time: 2021/11/06
 * Class OrderStatusRequest
 * @package App\Requests
 */

class OrderStatusRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'orderStatusName' => 'required|max:20|string'
        ];
    }
}
