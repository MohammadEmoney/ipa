<?php

namespace App\Livewire\Admin\Orders;

use App\Enums\EnumOrderPaymentStatus;
use App\Enums\EnumOrderType;
use App\Enums\EnumPaymentMethods;
use App\Enums\EnumPaymentTypes;
use App\Models\Book;
use App\Models\Order;
use App\Models\Semester;
use App\Models\User;
use App\Rules\JDate;
use App\Traits\AlertLiveComponent;
use App\Traits\DateTrait;
use App\Traits\InstallmentsTrait;
use App\Traits\MediaTrait;
use App\Traits\OrderTrait;
use Livewire\Component;
use Livewire\WithFileUploads;
use Morilog\Jalali\Jalalian;

class LiveOrderEdit extends Component
{
    use AlertLiveComponent;
    use OrderTrait;
    use DateTrait;
    use WithFileUploads;
    use InstallmentsTrait;
    use MediaTrait;

    public $data = [];
    public $type = 'tuition';
    public $order;

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->type = $order->type;
        $this->data['book_id'] = $order->orderable_id;
        $this->data['tuition_id'] = $order->orderable_id;
        $this->data['student_id'] = $order->user_id;
        $this->data['register_date'] = Jalalian::fromDateTime($order->register_date)->format('Y-m-d');
        $this->data['contract_type'] = $order->contract_type;
        $this->data['contract_number'] = $order->contract_number;
        $this->data['payment_type'] = $order->payment_type;
        $this->data['payment_method'] = $order->payment_method;
        $this->data['payment_status'] = $order->payment_status;
        $this->data['discount_amount'] = $order->discount_amount;
        $this->data['tax'] = $order->tax;
        $this->data['order_amount'] = $order->order_amount;
        $this->data['paid_amount'] = $order->paid_amount;
        $this->data['total_installments'] = $order->total_installments;
        $this->data['installment_amount'] = $order->installment_amount;
        $this->data['installment_date'] = Jalalian::fromDateTime($order->installment_date)->format('Y-m-d');
        $this->data['documents'] = $order->getFirstMedia('documents');
        $this->ageRange = $order->age_range;

        $this->loadInstallments($order);
    }

    public function validations()
    {
        $this->validate(
            [
                'type' => 'required|in:' . EnumOrderType::asStringValues(),
                'data.semester_id' => 'nullable|required_if:type,tuition|numeric|exists:semesters,id',
                'data.book_id' => 'nullable|required_if:type,book|numeric|exists:books,id',
                'data.student_id' => 'required|numeric|exists:users,id',
                'data.register_date' => ['required', 'string', 'max:255', new JDate()],
                'data.installment_date' => ['nullable', 'required_if:data.payment_type,installment', 'string', 'max:255', new JDate()],
                'data.total_installments' => ['nullable', 'required_if:data.payment_type,installment', 'numeric'],
                'data.installment_amount' => ['nullable', 'required_if:data.payment_type,installment', 'numeric'],
                'data.contract_number' => 'nullable|required_if:type,tuition|string|unique:orders,contract_number,' . $this->order->id,
                'data.discount_amount' => 'nullable|min:0',
                'data.tax' => 'nullable|min:0',
                'data.order_amount' => 'required|min:0',
                'data.paid_amount' => 'required|min:0',
                'data.payment_type' => 'required|in:' . EnumPaymentTypes::asStringValues(),
                'data.payment_method' => 'nullable|required_if:data.payment_type,full|in:' . EnumPaymentMethods::asStringValues(),
                'data.payment_status' => 'required|in:' . EnumOrderPaymentStatus::asStringValues(),
                'data.documents' => 'nullable|required_if:data.payment_method,credit_card,cheque'
            ],
            [
                'data.register_date.date_format' => 'فرمت تاریخ ثبت سفارش معتبر نمی باشد.',
                'data.semester_id.required_if' => 'فیلد کلاس الزامیست.',
                'data.book_id.required_if' => 'فیلد کتاب الزامیست.',
                'data.contract_number.required_if' => 'فیلد شماره قرارداد الزامیست.',
                'data.installment_date.required_if' => 'فیلد تاریخ موعد هر قسط الزامیست.',
                'data.installment_date.installment_amount' => 'فیلد مبلغ هر قسط الزامیست.',
                'data.total_installments.required_if' => 'فیلد تعداد کل اقساط الزامیست.',
                'data.payment_method.required_if' => 'فیلد نحوه پرداخت الزامیست.',
                'data.documents.required_if' => 'فیلد بارگذاری مدارک در صورت انتخاب کارت به کارت و چک الزامیست.',
            ],
            [
                'type' => 'نوع سفارش',
                'data.semester_id' => 'کلاس',
                'data.book_id' => 'کتاب',
                'data.student_id' => 'دانش آموز',
                'data.register_date' => 'تاریخ ثبت سفارش',
                'data.installment_date' => 'تاریخ موعد هر قسط',
                'data.installment_amount' => 'مبلغ هر قسط',
                'data.total_installments' => 'تعداد کل اقساط',
                'data.contract_number' => 'شماره قرارداد',
                'data.discount_amount' => 'مبلغ تخفیف',
                'data.tax' => 'مالیات',
                'data.order_amount' => 'مبلغ کل',
                'data.paid_amount' => 'مبلغ پرداخت شده',
                'data.payment_method' => 'نحوه پرداخت',
                'data.payment_type' => 'نوع پرداخت',
                'data.payment_status' => 'وضعیت پرداخت',
                'data.documents' => 'بارگذاری مدارک',
            ]
        );
    }

    public function updated($field, $value)
    {
        if($field == 'type'){
            $this->dispatch('select2Initiation');
        }
        if($field == 'data.semester_id'){
            $semester = Semester::find($this->data['semester_id'] ?? null);
            $this->data['order_amount'] = $semester?->tuition_fee;
        }
        if($field == 'data.book_id'){
            $book = Book::find($value ?? null);
            $this->data['order_amount'] = $book?->price;
        }
        // if(isset($this->data['student_id']) && isset($this->data['semester_id'])){
        //     $student = User::find($this->data['student_id']);
        //     $semester = Semester::find($this->data['semester_id'] ?? null);
        //     if($student && $semester){
        //         $this->generateRenewalNumber($student);
        //         $this->data['contract_number'] = $this->generateContractNumber($student->userInfo?->gender, $semester);
        //     }
        // }
        if($field === 'data.payment_type' && $value === "installment"){
            $this->loadDatePicker();
        }
        // $this->disabledCreate = true;
        // $this->validations();
        // $this->disabledCreate = false;
    }

    public function submit()
    {
        $this->validations();
        // $orderNumber = $this->orderNumber ?: $this->getOrderNumber($this->data['student_id']);
        $this->order->update([
            // 'orderable_id' => $this->type == 'tuition' ? $this->data['semester_id'] : $this->data['book_id'],
            // 'orderable_type' => $this->type == 'tuition' ? Semester::class : Book::class,
            // 'order_number' => $orderNumber,
            // 'type' =>  $this->type,
            // 'user_id' =>  $this->data['student_id'],
            'register_date' => $this->convertToGeorgianDate($this->data['register_date']),
            'contract_type' =>  $this->data['contract_type'] ?? null,
            // 'contract_number' =>  $this->data['contract_number'] ?? null,
            'payment_type' =>  $this->data['payment_type'] ?? null,
            'payment_method' =>  $this->data['payment_method'] ?? null,
            'payment_status' =>  $this->data['payment_status'] ?? null,
            'discount_amount' =>  $this->data['discount_amount'] ?? 0,
            'tax' =>  $this->data['tax'] ?? 0,
            'order_amount' =>  $this->data['order_amount'] ?? 0,
            'paid_amount' =>  $this->data['paid_amount'] ?? 0,
            'total_installments' =>  $this->data['total_installments'] ?? null,
            'installment_amount' =>  $this->data['installment_amount'] ?? null,
            'installment_date' => isset($this->data['installment_date']) ? $this->convertToGeorgianDate($this->data['installment_date']) : null,
            'age_range' =>  $this->ageRange ?? null,
        ]);
        $this->createDocument($this->order);
        $this->saveInstallments($this->order);
        $this->alert('سفارش با موفقیت ویرایش شد.')->success();
        return redirect()->to(route('admin.orders.index'));
    }

    public function render()
    {
        $types = EnumOrderType::getTranslatedAll();
        $students = User::whereRelation('userInfo', 'type', 'student')->get();
        $semesters = Semester::with(['course', 'teacher'])->get();
        $books = Book::active()->get();
        $paymentMethods = EnumPaymentMethods::getTranslatedAll();
        $paymentTypes = EnumPaymentTypes::getTranslatedAll();
        $paymentStatuses = EnumOrderPaymentStatus::getTranslatedAll();
        return view('livewire.admin.orders.live-order-edit', compact('types', 'students', 'semesters', 'books', 'paymentMethods', 'paymentStatuses', 'paymentTypes'))
            ->extends('layouts.admin-panel')
            ->section('content');
    }
}
