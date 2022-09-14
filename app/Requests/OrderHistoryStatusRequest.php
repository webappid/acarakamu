<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:15
 * Time: 2022/09/14
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
