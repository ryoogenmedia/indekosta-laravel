<?php

namespace App\Helpers;

use App\Models\Kost;
use App\Models\Recomendation;
use App\Models\Skills;

class HomeChart
{
    public static function RECOMENDATION()
    {
        $data = [
            'date' => [],
            'data' => [],
        ];

        for ($i = 9; $i >= 0; $i--) {
            $dates = date('Y-m-d', strtotime("-" . $i . " day"));
            $datas = Recomendation::whereDate('created_at', $dates)->count();

            $data['date'][] = date('d M Y', strtotime($dates));
            $data['data'][] = $datas ? $datas : 0;
        }

        return $data;
    }

    public static function KOST()
    {
        $data = [
            'date' => [],
            'data' => [],
        ];

        for ($i = 9; $i >= 0; $i--) {
            $dates = date('Y-m-d', strtotime("-" . $i . " day"));
            $datas = Kost::whereDate('created_at', $dates)->count();

            $data['date'][] = date('d M Y', strtotime($dates));
            $data['data'][] = $datas ? $datas : 0;
        }

        return $data;
    }
}
