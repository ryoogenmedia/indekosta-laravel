<?php

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
