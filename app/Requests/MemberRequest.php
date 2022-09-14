<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:10
 * Time: 2022/09/14
 * Class MemberRequest
 * @package App\Requests
 */

class MemberRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'memberUserId' => 'required|int',
            'memberFirstName' => 'required|max:50|string',
            'memberLastName' => 'required|max:50|string',
            'memberEmail' => 'required|max:50|string',
            'memberImageId' => 'nullable|int',
            'memberNoTelp' => 'required|max:20|string',
            'memberDateChange' => 'required|max:100|string'
        ];
    }
}
