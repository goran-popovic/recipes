<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Order;
use App\Subscription;
use App\User;
use Illuminate\Http\Request;
use Log;

class HooksController extends Controller
{
    public function licenseChangeNotifications(Request $request)
    {
        /* License Change Notification */
        $params = $request->all();
        $pass = $this->get2CheckoutSecret(); /* your secret key to compute HASH */

        /* do something only if it's posted with the right fields */
        if (
            isset($params)
            && is_array($params)
            && isset($params['HASH']) && is_string($params['HASH']) && strlen($params['HASH']) > 0
            && isset($params['LICENSE_CODE']) && is_string($params['LICENSE_CODE']) && strlen($params['LICENSE_CODE']) > 0
            && isset($params['EXPIRATION_DATE']) && is_string($params['EXPIRATION_DATE']) && strlen($params['EXPIRATION_DATE']) > 0
            && $params['HASH'] == $this->hmac($pass, $this->serializeArray($params))
        ) {
            $returnedDate = date('YmdGis');
            $returnedHash = $this->hmac($pass, $this->serializeArray(array(
                $pass,
                $params['LICENSE_CODE'],
                $params['EXPIRATION_DATE'],
                $returnedDate
            )));

            /* must echo this to give feedback to us */
            echo '<EPAYMENT>' . $returnedDate . '|' . $returnedHash . '</EPAYMENT>';

            /* put your custom "SUCCESS" code below */
            if(isset($params['EMAIL'])) {
                $user = User::where('email', $params['EMAIL'])->firstOrFail();

                $subscriptionData = [
                    'user_id' => $user->id,
                    'status' => $params['STATUS'],
                    'reference' => $params['LICENSE_CODE'],
                    'recurring' => $params['RECURRING'],
                    'customer_reference' => $params['AVANGATE_CUSTOMER_REFERENCE'],
                    'start_date' => $params['START_DATE'],
                    'expiration_date' => $params['EXPIRATION_DATE'],
                ];

                Subscription::updateOrCreate(
                    ['user_id' => $user->id],
                    $subscriptionData
                );
            }
        } else {
            Log::info('LCN ERROR');
        }
    }

    public function instantPaymentNotifications(Request $request)
    {
        /* Instant Payment Notification */
        $params = $request->all();
        $pass = $this->get2CheckoutSecret();    /* pass to compute HASH */
        $result = '';                 /* string for compute HASH for received data */
        $signature = $params['HASH'];    /* HASH received */

        foreach ($params as $key => $val) {
            $$key = $val;
            /* get values */
            if ($key != "HASH") {
                if (is_array($val)) {
                    $result .= $this->arrayExpand($val);
                } else {
                    $size = strlen(StripSlashes($val)); /*StripSlashes function to be used only for PHP versions <= PHP 5.3.0, only if the magic_quotes_gpc function is enabled */
                    $result .= $size . StripSlashes($val);  /*StripSlashes function to be used only for PHP versions <= PHP 5.3.0, only if the magic_quotes_gpc function is enabled */
                }
            }
        }

        $dateReturn = date('YmdHis');
        $return = strlen($params['IPN_PID'][0]) . $params['IPN_PID'][0] . strlen($params['IPN_PNAME'][0]) . $params['IPN_PNAME'][0];
        $return .= strlen($params['IPN_DATE']) . $params['IPN_DATE'] . strlen($dateReturn) . $dateReturn;

        $hash = $this->hmac($pass, $result); /* HASH for data received */

        if ($hash == $signature) {
            /* ePayment response */
            $resultHash = $this->hmac($pass, $return);
            echo '<EPAYMENT>' . $dateReturn . '|' . $resultHash . '</EPAYMENT>';
            /* Begin automated procedures (START YOUR CODE)*/
            Log::info('IPN SUCCESS', ['params' => $params]);
        } else {
            Log::info('IPN ERROR');
        }
    }

    public function arrayExpand($array)
    {
        $returnValue = '';

        for ($i = 0; $i < sizeof($array); $i++) {
            $size = strlen(StripSlashes($array[$i]));  /*StripSlashes function to be used only for PHP versions <= PHP 5.3.0, only if the magic_quotes_gpc function is enabled */
            $returnValue .= $size . StripSlashes($array[$i]);  /*StripSlashes function to be used only for PHP versions <= PHP 5.3.0, only if the magic_quotes_gpc function is enabled */
        }

        return $returnValue;
    }

    public function hmac($key, $data)
    {
        $b = 64; // byte length for md5

        if (strlen($key) > $b) {
            $key = pack('H*', md5($key));
        }

        $key = str_pad($key, $b, chr(0x00));
        $ipad = str_pad('', $b, chr(0x36));
        $opad = str_pad('', $b, chr(0x5c));
        $kIpad = $key ^ $ipad;
        $kOpad = $key ^ $opad;

        return md5($kOpad . pack('H*', md5($kIpad . $data)));
    }

    public function serializeArray($array)
    {
        $returnValue = '';

        if (isset($array) && is_array($array) && count($array) > 0) {
            foreach ($array as $key => $val) {
                if ($key == 'HASH') {
                    continue;
                }

                if (is_array($val)) {
                    $returnValue .= $this->serializeArray($val);
                } else {
                    $returnValue .= strlen($val) . $val;
                }
            }
        }

        return $returnValue;
    }

    private function get2CheckoutSecret()
    {
        return config('services.2checkout.secret');
    }
}
