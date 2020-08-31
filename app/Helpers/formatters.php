<?php

function formatByCurrency($amount = 0, int $decimals = 0) {

    if ($decimals === 0) {
        $amount = floor($amount);
    }

    return number_format($amount, $decimals, '.', ' ') . ' ' . __('currencies.rouble');
}