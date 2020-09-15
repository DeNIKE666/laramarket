<?php


namespace App\Services;


use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class QiwiP2P
{

    /**
     * @var $card
     */

    protected $card;

    /**
     * @var $month
     */

    protected $month;

    /**
     * @var $year
     */
    protected $year;

    /**
     * @var $cvc
     */
    protected $cvc;


    /**
     * @var $amount
     */

    protected $amount;

    /**
     * @var $callbackUrl ;
     */

    protected $callbackUrl;

    /**
     * @var $payStatus ;
     */

    protected $payStatus;

    /**
     * @var $token ;
     */

    protected $token;

    /**
     * @var $cookies
     */

    protected $cookies;

    /**
     * @var $orderUid
     */
    protected $orderUid;

    /**
     * @param $card
     *
     * @return $this
     */

    public function setCard($card)
    {
        $this->card = str_replace(' ', '', $card);

        return $this;
    }

    /**
     * @param $month
     *
     * @return $this
     */

    public function setMonth($month)
    {
        $this->month = $month;

        return $this;
    }

    /**
     * @param $year
     *
     * @return $this
     */

    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @param $cvc
     *
     * @return $this
     */

    public function setCvc($cvc)
    {
        $this->cvc = $cvc;

        return $this;
    }

    /**
     * @param float $amount
     *
     * @return $this
     */
    public function setAmount(float $amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @param string $url
     *
     * @return $this
     */

    public function setCallback(string $url)
    {
        $this->callbackUrl = $url;

        return $this;
    }

    public function token()
    {
        try {
            $token = Http::withHeaders([
                'User-Agent'      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:76.0) Gecko/20100101 Firefox/76.0',
                'Accept'          => '*/*',
                'Accept-Language' => 'ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
                'Content-Type'    => 'application/json',
            ])->send('POST', 'https://w.qiwi.com/oauth/token?grant_type=anonymous&client_id=checkout_anonymous');
        } catch (ConnectionException $connectionException) {
            return $this->token();
        }

        if ($token->failed()) return false;

        foreach ($token->cookies() as $cookie) {
            $this->cookies .= $cookie->getName() . '=' . $cookie->getValue() . ';';
        }

        $this->token = $token->json()['access_token'];

        return $this;

    }

    public function createOrder()
    {
        // Получаем токен

        $PAGE_PAY_LOWECASE = env('PAGE_PAY');

        $PAGE_PAY_UPPER = preg_replace_callback_array(
            [
                '/^.{1}/u'    => function ($match) {
                    return mb_strtoupper($match[0]);
                },
                '/\-(.{1})/u' => function ($match) {
                    return mb_strtoupper($match[0]);
                },
            ],
            $PAGE_PAY_LOWECASE
        );

        try {
            $order = Http::withHeaders([
                'User-Agent'      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:76.0) Gecko/20100101 Firefox/76.0',
                'Accept'          => '*/*',
                'Accept-Language' => 'ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
                'Authorization'   => 'TokenHead ' . $this->token,
                'Content-Type'    => 'application/json',
                'Cookie'          => $this->cookies,
            ])->send('POST', 'https://edge.qiwi.com/checkout-api/invoice/create', [
                'body' => '{"public_key":"' . env('PUBLIC_KEY') . '","amount":' . $this->amount . ',"customers":[],"extras":[{"code":"widgetAlias","value":"' . $PAGE_PAY_LOWECASE . '"},{"code":"widgetReferrer","value":"my.qiwi.com"},{"code":"themeCode","value":"' . $PAGE_PAY_UPPER . '"}]}',
            ]);
        } catch (ConnectionException $connectionException) {
            return $this->createOrder();
        }

        if ($order->failed()) return false;

        $this->orderUid = $order->object()->invoice_uid;

        return $this;
    }

    public function sendPay()
    {
        try {
            $pay = Http::withHeaders([
                'User-Agent'      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:76.0) Gecko/20100101 Firefox/76.0',
                'Accept'          => '*/*',
                'Accept-Language' => 'ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
                'Authorization'   => 'TokenHead ' . $this->token,
                'Content-Type'    => 'application/json',
                'Cookie'          => $this->cookies,
            ])->send('POST', 'https://edge.qiwi.com/checkout-api/invoice/pay/card', [
                'body' => '{"invoice_uid":"' . $this->orderUid . '","expire_month":"' . $this->month . '","expire_year":"' . $this->year . '","pan":"' . $this->card . '","cvv":"' . $this->cvc . '","card_holder":"","spa_url":"https://oplata.qiwi.com/3ds","time_on_page":' . mt_rand(9999, 99999) . '}',
            ]);
        } catch (ConnectionException $connectionException) {
            return $this->sendPay();
        }

        if ($pay->failed() || !empty($pay->object()->DECLINE_PAY_RESULT)) return false;

        $asc_url = $pay->object()->THREE_DS_REQUIREMENTS->acs_url;
        $MD = $pay->object()->THREE_DS_REQUIREMENTS->MD;
        $PaReq = $pay->object()->THREE_DS_REQUIREMENTS->PaReq;
        $redirectUrl = $this->callbackUrl;

        $Html = ' 
        <html>
            <body>
            <form name=\'Redirect\' method=\'post\' action="' . $asc_url . '" id=\'Redirect\'>
                <input type=\'hidden\' name=\'MD\' value="' . $MD . '">
                <input type=\'hidden\' name=\'PaReq\' value="' . $PaReq . '">
                <input type=\'hidden\' name=\'TermUrl\' value="' . $redirectUrl . '">
                <noscript><h2>Object moved <input type="submit" value="here"></h2></noscript>
            </form>
            <script type=\'text/javascript\'>document.Redirect.submit();</script>
            </body>
          </html>';

        echo $Html;

    }

    /**
     * @param $paReq
     * @param $md
     *
     * @return bool
     * @throws \Exception
     */

    public function sendCallback($paReq, $md)
    {
        $sendFinalQiwiCallback = Http::withHeaders([
            'User-agent'   => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36',
            'Accept'       => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
            'Content-type' => 'application/x-www-form-urlencoded',
        ])->send('POST', 'https://edge.qiwi.com/checkout-api/bank/callback/', [
            'form_params' => [
                'PaRes' => $paReq,
                'MD'    => $md,
            ],
        ]);

        return $sendFinalQiwiCallback->ok() ? true : false;

    }

}