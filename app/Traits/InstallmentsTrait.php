<?php

namespace App\Traits;

use App\Enums\EnumOrderPaymentStatus;
use App\Enums\EnumPaymentMethods;
use App\Models\Installment;
use App\Rules\JDate;

trait InstallmentsTrait
{
    public $haveInstallment = false;
    public $editPage = false;
    public $installments = [];
    public $tempInstallments = [];
    public $editingInstallmentId;
    public $installmentsDatePicker;
    public $stillWorking = false;

    public function mountInstallmentsTrait()
    {
        $this->loadData();
    }

    public function loadInstallments($order)
    {
        foreach($order->installments as $installment)
            $this->tempInstallments[$installment->id] = $installment->toArray();
    }

    public function loadData()
    {
        if($count = count($this->tempInstallments)){
            $this->installments['title'] = "قسط $count";
            $this->installments['installment_number'] = $count;
            $this->installments['amount'] = $this->calculateInstallment();
        }else{
            $this->installments['title'] = "پیش پرداخت";
            $this->installments['pre_paid'] = true;
            $this->installments['amount'] = $this->data['paid_amount'] ?? null;
        }
    }

    public function addInstallment()
    {
        $this->installmentsValidation();
        $this->tempInstallments[] = $this->installments;
        $this->installments = [];
        $this->loadDatePicker();
        $this->loadData();
    }

    public function deleteInstallment($key)
    {
        unset($this->tempInstallments[$key]);
    }

    public function editInstallment($key)
    {
        $this->installments = $this->tempInstallments[$key];
        $this->installments['pre_paid'] = $this->tempInstallments[$key]['pre_paid'] === 1 ? true : false;
        $this->editingInstallmentId = $key;
    }

    public function updateInstallment()
    {
        $this->installmentsValidation();
        $this->tempInstallments[$this->editingInstallmentId] = $this->installments;
        $this->installments = [];
        $this->editingInstallmentId = null;
        $this->loadDatePicker();
    }

    public function loadDatePicker()
    {
        $this->dispatch('selectInstallments');
    }

    public function installmentsValidation()
    {
        $this->validate([
            'installments.title' => 'required|string|max:255',
            'installments.amount' => 'required|numeric|min:0',
            'installments.installment_number' => 'required_without:installments.pre_paid|numeric|max:255',
            'installments.date_paid' => ['required', 'string', 'max:255', new JDate()],
            'installments.description' => 'nullable|string',
            'installments.documents' => 'nullable|image',
            'installments.pre_paid' => 'nullable|boolean',
            'installments.payment_method' => 'required_if:data.payment_type,full|in:' . EnumPaymentMethods::asStringValues(),
            'installments.payment_status' => 'required|in:' . EnumOrderPaymentStatus::asStringValues(),
            'installments.documents' => 'required_if:installments.payment_method,credit_card,cheque',
        ],[
            'installments.installment_number.required_without' => 'شماره قسط الزامی است',
            'installments.payment_method.required_if' => 'فیلد نحوه پرداخت الزامیست.',
            'installments.documents.required_if' => 'فیلد بارگذاری مدارک در صورت انتخاب کارت به کارت و چک الزامیست.',
        ],[
            'installments.title' => 'عنوان قسط',
            'installments.installment_number' => 'شماره قسط',
            'installments.date_paid' => 'تاریخ پرداخت',
            'installments.amount' => 'مبلغ پرداخت شده',
            'installments.documents' => 'مدارک',
            'installments.description' => 'توضیحات',
            'installments.pre_paid' => 'پیش پرداخت',
            'installments.payment_method' => 'نحوه پرداخت',
            'installments.payment_status' => 'وضعیت پرداخت',
            'installments.documents' => 'بارگذاری مدارک',
        ]);
    }

    public function saveInstallments($order)
    {
        foreach($this->tempInstallments as $installment){
            $prePaid = $installment['pre_paid'] ?? 0;
            $installment = $order->installments()->create([
                'title' => $installment['title'],
                'amount' => $installment['amount'],
                'user_id' => $order->user_id,
                'installment_number' => $installment['installment_number'] ?? null,
                'payment_method' => $installment['payment_method'] ?? null,
                'payment_status' => $installment['payment_status'] ?? null,
                'date_paid' => isset($installment['date_paid']) ? $this->convertToGeorgianDate($installment['date_paid']) : null,
                'description' => $installment['description'] ?? null,
                'pre_paid' => $prePaid,
            ]);
            $this->createInstallmentDocument($installment);
        }
    }

    public function updateInstallments($order)
    {
        foreach($this->tempInstallments as $key => $installment){
            $installment = Installment::where('id', $key)->where('order_id', $order->id)->first();
            if($installment){
                $prePaid = $installment['pre_paid'] ?? 0;
                $installment->update([
                    'title' => $installment['title'],
                    'amount' => $installment['amount'],
                    'user_id' => $order->user_id,
                    'installment_number' => $installment['installment_number'] ?? null,
                    'payment_method' => $installment['payment_method'] ?? null,
                    'payment_status' => $installment['payment_status'] ?? null,
                    'date_paid' => isset($installment['date_paid']) ? $this->convertToGeorgianDate($installment['date_paid']) : null,
                    'description' => $installment['description'] ?? null,
                    'pre_paid' => $prePaid,
                ]);
            }else{
                $prePaid = $installment['pre_paid'] ?? 0;
                $installment = $order->installments()->create([
                    'title' => $installment['title'],
                    'amount' => $installment['amount'],
                    'user_id' => $order->user_id,
                    'installment_number' => $installment['installment_number'] ?? null,
                    'payment_method' => $installment['payment_method'] ?? null,
                    'payment_status' => $installment['payment_status'] ?? null,
                    'date_paid' => isset($installment['date_paid']) ? $this->convertToGeorgianDate($installment['date_paid']) : null,
                    'description' => $installment['description'] ?? null,
                    'pre_paid' => $prePaid,
                ]);
            }
            $this->createInstallmentDocument($installment);

        }
    }

    public function calculateInstallment()
    {
        if(isset($this->order) && $this->order){
            $totalAmount = $this->order->order_amount ?: 0;
            $totalInstallmentCount = $this->order->total_installments ?: 0;
            if($totalAmount && $totalInstallmentCount)
                return $totalAmount / $totalInstallmentCount;
        }
        return null;
    }
}