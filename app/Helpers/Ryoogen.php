<?php

use App\Models\Recomendation;

/**
 * nelisys/snmp
 *
 * @author    Ryoogen Media <https://github.com/Ryoogen>
 * @copyright 2023 Ryoogen Media
 *
 * @link https://github.com/Ryoogen
 */

if (!function_exists('money_format_idr')) {
    function money_format_idr($money, $withRp = true, $desimal = false)
    {
        $money = (float) $money;

        return $withRp
            ? 'Rp. ' . number_format($money, $desimal ? 2 : 0, ',', '.') . ''
            : number_format($money, $desimal ? 2 : 0, ',', '.');
    }
}

if(!function_exists('ratings')){
    function ratings($id){
        $rating = Recomendation::where('kost_id', $id)->get();

        $totalRating = $rating->count();

        $rating5 = 0;
        $rating4 = 0;
        $rating3 = 0;
        $rating2 = 0;
        $rating1 = 0;

        $jumlahRating = 0;

        foreach($rating as $data){
            switch($data->rating){
                case 5: 
                    $rating5 += 1;
                    $jumlahRating += $data->rating;
                    break;
                case 4: 
                    $rating4 += 1;
                    $jumlahRating += $data->rating;
                    break;
                case 3: 
                    $rating3 += 1;
                    $jumlahRating += $data->rating;
                    break;
                case 2: 
                    $rating2 += 1;
                    $jumlahRating += $data->rating;
                    break;
                default:
                    $rating1 += 1;
                    $jumlahRating += $d['rating'];
            }
        }

        if($jumlahRating && $totalRating){
            $avarageRating =  round($jumlahRating / $totalRating, 1);
            $avarageFloor = floor($jumlahRating / $totalRating);
        } else {
            $avarageRating =  0;
            $avarageFloor = 0;
        }

        return [
            'average' => $avarageRating,
            'floor' => $avarageFloor,
            'total' => $totalRating,
            'rating5' => $rating5,
            'rating4' => $rating4,
            'rating3' => $rating3,
            'rating2' => $rating2,
            'rating1' => $rating1,
        ];
    }
}
