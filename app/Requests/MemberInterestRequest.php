<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:11
 * Time: 2022/09/14
 * Class MemberInterestRequest
 * @package App\Requests
 */

class MemberInterestRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'memberInterestCategoryId' => 'required|int',
            'memberIntersetMemberId' => 'required|int'
        ];
    }
}
