<?php

namespace App\Services\Payeer;

use stdClass;

/**
 * Class Merchant
 * @package App\Services\Payeer
 *
 * @property int    $m_shop
 * @property string $m_orderid
 * @property float  $m_amount
 * @property string $m_curr
 * @property string $m_desc
 * @property string $sign
 */
class Merchant
{
    private $config = [];

    private $status = [
        'status'  => '',
        'message' => [
            'descr' => '',
            'data'  => [],
        ],
    ];

    private const STATUS_ERROR = 'error';
    private const STATUS_SUCCESS = 'success';

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function getStatus(): array
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @param string $descr
     * @param array  $data
     */
    public function setStatus(string $status, string $descr = '', array $data = []): void
    {
        $this->status['status'] = $status;
        $this->status['message']['descr'] = $descr;
        $this->status['message']['data'] = $data;
    }

    /**
     * Инициализация данных для формы оплаты
     *
     * @param string $orderId
     * @param float  $amount
     * @param string $currency
     * @param string $description
     *
     * @return stdClass
     */
    public function initFormData(string $orderId = '', float $amount = 0, string $currency = 'RUB', string $description = ''): StdClass
    {
        $arHash = [
            'm_shop'    => $this->config['merchant_shop'],
            'm_orderid' => $orderId,
            'm_amount'  => number_format($amount, 2, '.', ''),
            'm_curr'    => $currency,
            'm_desc'    => base64_encode($description),
            'm_key'     => $this->config['merchant_secret_key'],
        ];

        $arHash['sign'] = strtoupper(hash('sha256', implode(':', array_values($arHash))));

        return (object)$arHash;
    }

    /**
     * Проверка данных об оплате
     *
     * @param array  $post
     * @param string $ip
     * @param float  $amount
     *
     * @return array
     */
    public function checkPayment(array $post, string $ip, float $amount = 0): array
    {
        //Проверка IP
        if (!$this->checkIP($post, $ip)) return $this->getStatus();

        //Оплаченная сумма меньше требуемой
        if (!$this->checkPayinAmount($post, $amount)) return $this->getStatus();

        //Проверка сигнатуры
        if (!$this->checkSignature($post)) return $this->getStatus();

        $this->setStatus(self::STATUS_SUCCESS);

        return $this->getStatus();
    }

    /**
     * Проверить IP
     *
     * @param array  $post
     * @param string $ip
     *
     * @return bool
     */
    private function checkIP(array $post, string $ip): bool
    {
        if (!in_array($ip, $this->config['merchant_allow_ips'])) {
            $this->setStatus(
                self::STATUS_ERROR,
                'Not found IP [' . $ip . '] in list [' . implode(',', $this->config['merchant_allow_ips']) . ']',
                $post
            );

            return false;
        }

        return true;
    }

    /**
     * Проверка требуемой суммы оплаты
     *
     * @param array $post
     * @param float $amount
     *
     * @return bool
     */
    private function checkPayinAmount(array $post, float $amount): bool
    {
        if ($post['m_amount'] < $amount) {
            $this->setStatus(
                self::STATUS_ERROR,
                'Payment amount [' . $post['m_amount'] . '] less than required [' . $amount . ']',
                $post
            );

            return false;
        }

        return true;
    }

    /**
     * Проверка сигнатуры
     *
     * @param array $post
     *
     * @return bool
     */
    private function checkSignature(array $post): bool
    {
        $arHash = [
            $post['m_operation_id'],
            $post['m_operation_ps'],
            $post['m_operation_date'],
            $post['m_operation_pay_date'],
            $post['m_shop'],
            $post['m_orderid'],
            $post['m_amount'],
            $post['m_curr'],
            $post['m_desc'],
            $post['m_status'],
            $this->config['merchant_secret_key'],
        ];

        $sign_hash = strtoupper(hash('sha256', implode(':', $arHash)));

        //Неравные сигнатуры
        if ($post['m_sign'] !== $sign_hash or $post['m_status'] !== 'success') {
            $this->setStatus(
                self::STATUS_ERROR,
                'Signatures not equal',
                $arHash
            );

            return false;
        }

        return true;
    }
}
