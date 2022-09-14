<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:14
 * Time: 2022/09/14
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
