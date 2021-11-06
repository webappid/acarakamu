<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:23
 * Time: 2021/11/06
 * Class OrderHistoryStatusRequest
 * @package App\Requests
 */

class OrderHistoryStatusRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'orderHistoryStatusOrderId' => 'required|int',
            'orderHistoryStatusDesc' => 'nullable|max:65535|string',
            'orderHistoryStatusStatusId' => 'required|int',
            'orderHistoryStatusUserId' => 'required|int'
        ];
    }
}
