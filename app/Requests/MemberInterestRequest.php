<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:17
 * Time: 2021/11/06
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
