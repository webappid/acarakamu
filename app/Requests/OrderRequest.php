<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:20
 * Time: 2021/11/06
 * Class OrderRequest
 * @package App\Requests
 */

class OrderRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'orderNumber' => 'required|max:20|string',
            'orderOrderStatus' => 'required|int',
            'orderMemberId' => 'required|int',
            'orderQty' => 'required|int',
            'orderCost' => 'required|numeric',
            'orderDateTimeLimit' => 'nullable|max:100|string',
            'orderDateTimeChange' => 'nullable|max:100|string',
            'orderUserId' => 'required|int'
        ];
    }
}
