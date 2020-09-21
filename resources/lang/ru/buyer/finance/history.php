<?php
return [
    'personal' => [
        'table_titles' => [
            'row_num'    => '№',
            'type'       => 'Тип операции',
            'pay_system' => 'Платежная система',
            'amount'     => 'Сумма',
            'date'       => 'Дата',
        ],

        'bind' => [
            'trans_type' => [
                'deposit'               => 'Пополнение',
                'withdraw'              => 'Вывод',
                'purchase'              => 'Покупка товара',
                'deposit_from_cashback' => 'Перевод со счета Кэшбэк',
                'deposit_from_seller'   => 'Перевод со счета Продавец',
                'deposit_from_partner'  => 'Перевод со счета Партнер',
            ],
        ],
    ],
];