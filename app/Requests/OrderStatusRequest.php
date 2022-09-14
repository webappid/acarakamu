<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:16
 * Time: 2022/09/14
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
