<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:21
 * Time: 2021/11/06
 * Class OrderDetailRequest
 * @package App\Requests
 */

class OrderDetailRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'orderDetailOrderId' => 'required|int',
            'orderDetailEventId' => 'required|int',
            'orderDetailQty' => 'required|int',
            'orderDetailEventCost' => 'required|numeric',
            'orderDetailDateChange' => 'required|max:100|string'
        ];
    }
}
