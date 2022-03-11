<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Model\Setting\DeliveryTimeSLot;
use Illuminate\Http\Request;

class TimeSlotSettingController extends Controller
{
        public function getSlotByDate($date)
    {
        $time_slot = DeliveryTimeSLot::orderBy('expired_at', 'asc')
            ->where('status', '=', 1);

        if ($date == date('Y-m-d')) {
            $current_time = date("H:i:s");
            $time_slot->where('expired_at', '>', $current_time);
        }
        $time_slot = $time_slot->get();

        return $time_slot;

    }
}
