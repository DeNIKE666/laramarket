<?php


namespace App\Services;

use App\Facades\Http;
use Carbon\Carbon;
use DiDom\Document;

class Qiwi
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
     * @var $phone
     */
    protected $phone;
    /**
     * @var $comment
     */
    protected $comment;
    /**
     * @var $amount
     */

    protected $amount;

    /**
     * @var
     */

    protected $callbackUrl;

    /**
     * @param $card
     * @return $this
     */

    public function setCard($card)
    {
        $this->card = $card;

        return $this;
    }

    /**
     * @param $month
     * @return $this
     */

    public function setMonth($month)
    {
        $this->month = $month;

        return $this;
    }

    /**
     * @param $year
     * @return $this
     */

    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @param $cvc
     * @return $this
     */

    public function setCvc($cvc)
    {
        $this->cvc = $cvc;

        return $this;
    }

    /**
     * @param $phone
     * @return $this
     */

    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    public function setComment($coment)
    {
        $this->comment = $coment;

        return $this;
    }

    public function setAmount(int $amount)
    {
        $this->amount = $amount;

        return $this;
    }

    public function setCallback($url)
    {
        $this->callbackUrl = $url;

        return $this;
    }


    public function sendForm()
    {

        $client = resolve('GuzzleHttp\Client');


        // Получаем токен

        $token = $client->request('POST', 'https://qiwi.com/oauth/token', [
            'headers' => [
                'User-Agent'      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:76.0) Gecko/20100101 Firefox/76.0',
                'Accept'          => 'application/vnd.qiwi.v2+json',
                'Accept-Language' => 'ru',
                'Accept-Encoding' => 'gzip, deflate, br',
                'Content-Type'    => 'application/x-www-form-urlencoded',
                'Client-Software' => 'WEB v4.87.0',
            ],
            'body'  => 'grant_type=anonymous&client_id=anonymous'
        ]);

        $response = json_decode($token->getBody()->getContents(), true);


        // склеиваем куки

       /* $tokenCookie = '';

        foreach ($token->cookies() as $formCookie) {
            $tokenCookie .= $formCookie->getName() . '=' . $formCookie->getValue() . '; ';
        }*/

        // генерирем таймстамп

        $time = Carbon::now()->timestamp . '9999';

        $qiwiSend = $client->request('POST' , 'https://edge.qiwi.com/sinap/api/terms/99/payments' , [
           'headers' => [
               'User-Agent'          => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:76.0) Gecko/20100101 Firefox/76.0',
               'Accept'              => 'application/vnd.qiwi.v2+json',
               'Accept-Language'     => 'ru',
               'Accept-Encoding'     => 'gzip, deflate, br',
               'Content-Type'        => 'application/json',
               'X-Application-Id'    => '0ec0da91-65ee-496b-86d7-c07afc987007',
               'X-Application-Secret' => '66f8109f-d6df-49c6-ade9-5692a0b6d0a1',
               'Client-Software'      => 'WEB v4.87.0',
               'Authorization'        => 'TokenHead ' . $response['access_token']  ,
               'Origin'               => 'https://qiwi.com',
           ],
           'body' => '{"id":"'.$time.'","sum":{"amount":'.$this->amount.',"currency":"643"},"paymentMethod":{"card":{"pan":"'.$this->card.'","expirationDate":{"month":"'.$this->month.'","year":"'.$this->year.'"},"cvv":"'.$this->cvc.'"},"saveCard":false,"type":"UnlinkedCard"},"comment":"","fields":{"sinap-form-version":"qw::99999, 5","account":"'.$this->phone.'","accountType":"phone","comment":"'.$this->comment.'","CHECKOUT_REFERER":"https://ds2.mirconnect.ru/vbv1/paresforward;","browser_user_agent_crc":"334cdf79","pfto":"36224"}}',
        ]);

        $response = json_decode($qiwiSend->getBody()->getContents(), true);


        $Md = $response['transaction']['state']['md'];
        $paReq = $response['transaction']['state']['paReq'];
        $redirectUrl = $response['transaction']['state']['redirectUrl'];
        $confirmationUrl =  $this->callbackUrl; //$qiwiSend->transaction->state->confirmationUrl;


        $Html = ' 
        <html>
            <body>
            <form name=\'Redirect\' method=\'post\' action="'.$redirectUrl.'" id=\'Redirect\'>
                <input type=\'hidden\' name=\'MD\' value="'.$Md.'">
                <input type=\'hidden\' name=\'PaReq\' value="'.$paReq.'">
                <input type=\'hidden\' name=\'TermUrl\' value="'. $confirmationUrl.'">
                <noscript><h2>Object moved <input type="submit" value="here"></h2></noscript>
            </form>
            <script type=\'text/javascript\'>document.Redirect.submit();</script>
            </body>
          </html>';

        echo $Html;

    }

    /** Подтверждение платежа
     * @param $paReq
     * @param $md
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public  function sendCallback($paReq, $md)
    {


        $client = resolve('GuzzleHttp\Client');

        $sendFinalQiwiCallback = $client->request('POST' , 'https://qiwi.com/xml/acquiring.finish3ds' , [
            'headers' => [
                'User-agent'   => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36',
                'Accept'       => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
                'Content-type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'PaRes' => $paReq,
                'MD' => $md
            ]
        ]);

        $response = json_decode($sendFinalQiwiCallback->getBody()->getContents(), true);


        if ($response['errorCode'] == 0)
        {
            return true;
        }

        return false;

    }
}