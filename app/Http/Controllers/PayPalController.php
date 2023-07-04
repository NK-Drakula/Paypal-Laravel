<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;

class PayPalController extends Controller
{
    public function paypal()
    {
        $sum = 500;
        $apiContext = new ApiContext(
            new OAuthTokenCredential('AQAK3XVazZ_WyO1eBjFbN6ixQ-xLCyjMY3XgbIpfWIdyF1GfNbuqPq3DZNkiGiYYePkk-cXoPV8UeY_n', 'EBzHV9LTmNV8yHGAsnYbUQgUecX3FkhjEAT7Anb97LCSVgWisIiZKmKH_y-C0KrSv8lwCC14WEKZMm-_')
        );
        // dd($apiContext);

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        // dd($payer);

        // redirect URLS
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('success'))
            ->setCancelUrl(route('cancel'));
        // dd($redirectUrls);

        // Set Amount
        $amount = new Amount();
        $amount->setCurrency('USD')->setTotal($sum);
        // dd($amount);

        // Set Transction Object
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setDescription('Payment for order');
        // dd($transaction);

        // Full payment Object
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
        // dd($payment);

        // Create Payment with valid API Context
        try {
            $payment->create($apiContext);
            return redirect($payment->getApprovalLink());
        } catch (PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        } catch (Exception $ex) {
            die($ex);
        }
    }

    public function success()
    {
        $apiContext = new ApiContext(
            new OAuthTokenCredential('AQAK3XVazZ_WyO1eBjFbN6ixQ-xLCyjMY3XgbIpfWIdyF1GfNbuqPq3DZNkiGiYYePkk-cXoPV8UeY_n', 'EBzHV9LTmNV8yHGAsnYbUQgUecX3FkhjEAT7Anb97LCSVgWisIiZKmKH_y-C0KrSv8lwCC14WEKZMm-_')
        );

        $paymentId = $_GET['paymentId'];
        $payment = Payment::get($paymentId, $apiContext);
        $payerId = $_GET['PayerID'];
        // Execute Payer with ID

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);


        try {
            dd('success');
        } catch (PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        } catch (Exception $ex) {
            die($ex);
        }
    }

    public function cancel()
    {
        dd('cancel');
    }
}
