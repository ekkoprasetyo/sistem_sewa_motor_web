<?php

namespace App\Helpers;

use App\Model\LastCSEOSNumberModel;
use App\Model\LastEOSRunningGeneratorNumberModel;
use App\Model\LastEOSSwapInventoryNumberModel;
use App\Model\LastInventoryNumberModel;
use App\Model\LastNumberModel;
use App\Model\LastTroubleshootNumberModel;
use App\Model\LocationModel;
use App\Model\UnitModel;
use DB;
use Illuminate\Support\Facades\Log;

class NumberHelper {
    public static function generateInventoryNumber($device) {
        Log::channel('last_number_inventory')->info('Get Last Number For '.$device);
        $number = LastInventoryNumberModel::where('c_last_inventory_number_device', $device)
            ->first();

        if ($number) {
            Log::channel('last_number_inventory')->info('['.$number->c_last_inventory_number_id.'] Last Number Exist');
            $data_month = date('Y-m', strtotime($number->c_last_inventory_number_date));
            $current_month = date('Y-m');
            if($current_month > $data_month) {
                Log::channel('last_number_inventory')->info('['.$number->c_last_inventory_number_id.'] Reset Last Number, last data month : '.$data_month.' current month : '.$current_month);
                //Reset Number
                LastInventoryNumberModel::find($number->c_last_inventory_number_id)->update([
                    'c_last_inventory_number_number' => 1,
                    'c_last_inventory_number_date' => date('Y-m-d'),
                    'c_last_inventory_number_update_by' => UserAuthorization::getUserID(),
                    'c_last_inventory_number_update_time' => date('Y-m-d H:i:s'),
                ]);

                $generate_number = 'RL-INV-' . $device . '-' . date('my') . '-' .
                    str_pad(1, 5, '0', STR_PAD_LEFT);
                Log::channel('last_number_inventory')->info('Return number '.$generate_number);
                return $generate_number;
            } else {
                Log::channel('last_number_inventory')->info('['.$number->c_last_inventory_number_id.'] Update Last Number For '.$device.' to '.($number->c_last_inventory_number_number+1));
                LastInventoryNumberModel::find($number->c_last_inventory_number_id)->update([
                    'c_last_inventory_number_number' => $number->c_last_inventory_number_number + 1,
                    'c_last_inventory_number_date' => date('Y-m-d'),
                    'c_last_inventory_number_update_by' => UserAuthorization::getUserID(),
                    'c_last_inventory_number_update_time' => date('Y-m-d H:i:s'),
                ]);

                $generate_number = 'RL-INV-' . $device . '-' . date('my') . '-' .
                    str_pad($number->c_last_inventory_number_number + 1, 5, '0', STR_PAD_LEFT);
                Log::channel('last_number_inventory')->info('Return number '.$generate_number);
                return $generate_number;
            }
        } else {
            Log::channel('last_number_inventory')->info('Last Number doesnt exist');
            $last_inventory_number = new LastInventoryNumberModel([
                'c_last_inventory_number_device' => $device,
                'c_last_inventory_number_number' => 1,
                'c_last_inventory_number_date' => date('Y-m-d'),
                'c_last_inventory_number_update_by' => UserAuthorization::getUserID(),
                'c_last_inventory_number_update_time' => date('Y-m-d H:i:s'),
            ]);
            $last_inventory_number->save();
            Log::channel('last_number_inventory')->info('['.$last_inventory_number->c_last_inventory_number_id.'] Create Last Number For '.$device.' to 1');
            $generate_number = 'RL-INV-' . $device . '-' . date('my') . '-' .
                str_pad(1, 5, '0', STR_PAD_LEFT);
            Log::channel('last_number_inventory')->info('Return number '.$generate_number);
            return $generate_number;
        }
    }

    public static function thousandsCurrencyFormat($num) {

        if($num>1000) {
            $x = round($num);
            $x_number_format = number_format($x);
            $x_array = explode(',', $x_number_format);
            $x_parts = array(' K', ' M', ' B', ' T');
            $x_count_parts = count($x_array) - 1;
            $x_display = $x;
            $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
            $x_display .= $x_parts[$x_count_parts - 1];
            return $x_display;
        }
        return $num;
    }
}
