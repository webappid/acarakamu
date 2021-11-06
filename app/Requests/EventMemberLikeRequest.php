<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 14:04:09
 * Time: 2021/11/06
 * Class EventMemberLikeRequest
 * @package App\Requests
 */

class EventMemberLikeRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'eventMemberLikeEventId' => 'required|int',
            'eventMemberLikeMemberId' => 'required|int',
            'eventMemberLikeStars' => 'required|int',
            'eventMemberLikeDateChange' => 'required|max:100|string',
            'eventMemberLikeUserId' => 'required|int'
        ];
    }
}
