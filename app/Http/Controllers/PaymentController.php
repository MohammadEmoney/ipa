<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Enums\EnumGateway;
use App\Enums\EnumOrderStatus;
use App\Enums\EnumPaymentMethods;
use App\Enums\EnumPaymentStatus;
use App\Enums\EnumPaymentTypes;
use App\Models\Order;
use App\Models\Setting;
use App\Repositories\SettingsRepository;
use App\Traits\PaymentTrait;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Payment\Facade\Payment as ShetaBitPayment;
use Shetabit\Multipay\Invoice;

class PaymentController extends Controller
{
    use PaymentTrait;

    public $settings;

    public function __construct(SettingsRepository $setting) {
        $this->settings = $setting;
    }

    public function createOrder()
    {
        $price = $this->settings->getByKey('membership_fee');
        return Order::create([
            'user_id' => Auth::id(),
            'track_number' => $this->generateUniqueCode(Order::class, 'track_number'),
            'tax' => 0,
            'discount_amount' => 0,
            'order_amount' => $price ?: 0,
            'payable_amount' => $price ?: 0,
            'payment_type' => EnumPaymentTypes::FULL,
            'payment_method' => EnumPaymentMethods::ONLINE,
            'gateway' => EnumGateway::ZARINPAL,
        ]);
    }

    public function payment()
    {
        try {
            DB::beginTransaction();
            $order = $this->createOrder();
            
            $price = (int)$order->payable_amount;
            $gateway = strtolower($order->gateway);
            $invoice = (new Invoice)->amount($price);
            $paymentMethod = $order->payment_method;
            // $config = $this->getPaymentConfig($gateway);
            $config = [
                'merchantId' => $this->settings->getByKey('zarinpal_merchant_id') ?: env('ZARINPAL_MERCHANT_ID'),
                'currency' => env('ZARINPAL_CURRENCY'),
                'mode' => $this->settings->getByKey('zarinpal_mode') ?: env('ZARINPAL_MODE'),
                'description' => "payment using zarinpal",
            ];
                // dd($gateway, $config, $price, $order, route("payment.verify"));
            $res = ShetaBitPayment::via($gateway)->config($config)->callbackUrl(route("payment.verify"))->purchase(
                $invoice,
                function ($driver, $transactionId) use ($price, $order, $gateway, $paymentMethod) {
                    $order->transctions()->create([
                        'transaction_id' => (string)$transactionId,
                        'amount' => $price,
                        'gateway' => $gateway,
                        'status' => EnumPaymentStatus::CREATED,
                        'payment_method' => $paymentMethod,
                        'user_id' => Auth::id(),
                    ]);
                }
            )->pay()->render();
            DB::commit();
            return $res;
            
        } catch (ValidationException $exception) {
            return view('front.payments.failed')->with(['error' => $exception->getMessage(), 'order' => $order]);
        } catch (InvalidPaymentException $exception) {
            return view('front.payments.failed')->with(['error' => $exception->getMessage(), 'order' => $order]);
        } catch (\Exception $exception) {
            return view('front.payments.failed')->with(['error' => $exception->getMessage(), 'order' => $order]);
        }
    }

    public function verify(Request $request)
    {
        // dd($request->all());
        // $paymentDetails = $this->getPaymentDetails($request);
        $paymentDetails = [
            'payment' => Transaction::where('transaction_id', $request->Authority)->first(),
            'responseCode' => $request->Status,
            'transactionId' => $request->Authority
        ];
        $payment = $paymentDetails['payment'];
        $order = $payment->order;
        if (!$payment) {
            return view('front.payments.failed', compact('order'))->with('error' , 'اطلاعات کافی برای درگاه پرداخت وجود ندارد. با پشتیبانی تماس بگیرد. تشکر از صبوری شما');
        }
        try {
            if($paymentDetails['responseCode'] == "OK"){
                DB::beginTransaction();
                $receipt = ShetaBitPayment::amount((int)$payment->amount)->transactionId($paymentDetails['transactionId'])->verify();
                $payment->update(['status' => EnumPaymentStatus::COMPLETED]);
                $order = $payment->order;

                if($order){
                    $order->update(['status' => EnumOrderStatus::COMPLETED]);
                    $user = $order->user;
                    $user?->givePermissionTo(['active_user']);
                    $user?->update(['is_active' => true]);
                }
                DB::commit();
                return view('front.payments.success', compact('payment', 'order'))->with('success', 'پرداخت با موفقیت انجام شد.');
            }else{
                // $payment->update(['status_id' => Status::where('name', 'failed')->payment()->first()?->id ?: 7]);
                $payment->update(['status' => EnumPaymentStatus::FAILED]);
                return view('front.payments.failed', compact('order'))->with('error' , 'پرداخت موفقیت آمیز نبود.');
            }
        } catch (Exception $exception) {
            $payment->update(['status' => EnumPaymentStatus::FAILED]);
            return view('front.payments.failed', compact('order'))->with('error' , $exception->getMessage());
        } catch (InvalidPaymentException $exception) {
            $payment->update(['status' => EnumPaymentStatus::FAILED]);
            return view('front.payments.failed', compact('order'))->with('error' , $exception->getMessage());
        }
    }

    protected function getPaymentDetails(Request $request)
    {
        $paymentDetails = session()->get('paymentDetails');
        switch ($paymentDetails['gateway']) {
            case 'zarinpal':
                $transactionId = $request->Authority;
                $responseCode = $request->Status == "OK";
                break;
            case 'behpardakht':
                $transactionId = $request->RefId;
                $responseCode = $request->ResCode == 0;
                break;
            case 'zibal':
                $transactionId = $request->trackId;
                $responseCode = $request->success == 1;
                break;

            default:
                $transactionId = $request->trackId;
                $responseCode = $request->success == 1;
                break;
        }

        return [
            'payment' => Transaction::where('transaction_id', $transactionId)->first(),
            'responseCode' => $responseCode,
            'transactionId' => $transactionId
        ];
    }
}
