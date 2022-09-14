<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services\Responses;

use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\SmartResponse\Responses\AbstractResponseList;

/**
 * @author: 
 * Date: 16:04:12
 * Time: 2022/09/14
 * Class MigrationServiceResponseList
 * @package App\Services\Responses
 */
class MigrationServiceResponseList extends AbstractResponseList
{
    /**
     * @var LengthAwarePaginator
     */
    public $migrationList;
}
