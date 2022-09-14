<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Requests;

use WebAppId\SmartResponse\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 16:04:03
 * Time: 2022/09/14
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
