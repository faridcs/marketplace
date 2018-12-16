<?php
/**
 * Created by PhpStorm.
 * User: faridcs
 * Date: 12/20/17
 * Time: 11:27 AM
 */

namespace App\Services\Utils;

use App\Database\Entities\EventLogModel;
use App\Database\Entities\Users\User;
use Auth;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class EventLogger
{
    /**
     * Fast event log
     *
     * @param int $logType
     * @param $relation
     * @param null $desc
     * @param null $operator
     * @param null $type
     * @param $from
     * @param $to
     * @param $ip
     * @param $id
     * @param null $date
     */
    public static function make(int $logType, $relation, $desc = null, $operator = null, $ip, $type = null, $from = null, $to = null, $id = null, $date = null)
    {

        if ($operator == null && Auth::user()) {
            $operator = Auth::user()->id;
        }

        if ($operator instanceof User) {
            $operator = $operator->id;
        }

        if (is_scalar($relation)) {
            $relation_id = (int)$relation;
            $relation_type = null;
            $relation_details = null;
        } elseif ($relation instanceof Model) {
            $relation_id = $relation->id;
            $relation_type = get_class($relation);
            $relation_details = json_encode($relation->getAttributes());
        } elseif (is_null($relation)) {
            $relation_id = $id ?: 0;
            $relation_type = null;
            $relation_details = null;
        } else {
            throw new InvalidArgumentException();
        }

        if (is_null($desc) == false && is_scalar($desc) == false) {
            $desc = json_encode($desc);
        }

        $eventLogModel = new EventLogModel();
        $eventLogModel->action_type = $logType;
        $eventLogModel->relation_id = $relation_id;
        $eventLogModel->relation_type = $relation_type;
        $eventLogModel->relation_details = $relation_details;
        $eventLogModel->operator_id = $operator ?: 0;
        $eventLogModel->description = $desc;
        $eventLogModel->ip = $ip;
        $eventLogModel->country = geoip()->getLocation($ip)['iso_code'];
        $eventLogModel->type = $type;
        $eventLogModel->from = $from;
        $eventLogModel->to = $to;

        if ($date != null) {
            $eventLogModel->created_at = $date;
            $eventLogModel->updated_at = $date;
        }

        $eventLogModel->save();
    }

}