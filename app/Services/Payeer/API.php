<?php

namespace App\Services\Payeer;

class API
{
    private $config = [];

    /** @var CPayeer $payeer */
    private $payeer;

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
        $this->payeer = new CPayeer($config['account'], $config['api_id'], $config['api_pass']);
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
     * Авторизован ли
     *
     * @return bool
     */
    public function isAuth(): bool
    {
        if ($this->payeer->isAuth()) return true;

        $this->setStatus(
            self::STATUS_ERROR,
            __METHOD__,
            $this->payeer->getErrors()
        );

        return false;
    }

    /**
     * Проверить существование аккаунта
     *
     * @param string $wallet
     *
     * @return bool
     */
    public function checkUser(string $wallet = ''): bool
    {
        return (preg_match('/^[Pp][0-9]{7,15}$/', $wallet) and $this->payeer->checkUser(['user' => $wallet]));
    }

    /**
     * Перевести средства
     *
     * @param string $payeer
     * @param float  $amount
     * @param string $comment
     *
     * @return array
     */
    public function transfer(string $payeer, float $amount, string $comment = ''): array
    {
        if (!$this->isAuth()) return $this->getStatus();

        $arTransfer = $this->payeer->transfer([
            'curIn'   => 'RUB',
            'sum'     => $amount,
            'curOut'  => 'RUB',
            'sumOut'  => $amount,
            'to'      => $payeer,
            'comment' => $comment,
        ]);

        if (empty($arTransfer['errors'])) {
            $this->setStatus(
                self::STATUS_SUCCESS,
                __METHOD__,
                $arTransfer
            );

            return $this->getStatus();
        }

        $this->setStatus(
            self::STATUS_ERROR,
            __METHOD__,
            $arTransfer
        );

        return $this->getStatus();
    }
}
