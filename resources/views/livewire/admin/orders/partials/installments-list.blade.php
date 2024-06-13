<div class="row">
    <div class="col-md-12 table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">عنوان قسط</th>
                <th scope="col">شماره قسط</th>
                <th scope="col">تاریخ پرداخت</th>
                <th scope="col">مبلغ پرداخت شده(تومان)</th>
                <th scope="col">نحوه پرداخت</th>
                <th scope="col">وضعیت پرداخت</th>
                <th scope="col">توضیحات</th>
                <th scope="col">عملیات</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($tempInstallments as $key => $installment)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $installment['title'] }}</td>
                        <td>{{ $installment['installment_number'] ?? "-" }}</td>
                        <td>{{ $installment['date_paid'] }}</td>
                        <td>{{ $installment['amount'] }}</td>
                        <td>{{ __('admin/enums/EnumPaymentMethods.' . $installment['payment_method']) }}</td>
                        <td>{{ __('admin/enums/EnumOrderPaymentStatus.' . $installment['payment_status']) }} <i class="ti {{ $installment['payment_status'] === 'clear' ? "ti-checkbox text-success" : "ti-x text-danger" }}"></i></td>
                        <td>{{ $installment['description'] ?? "" }}</td>
                        <td>
                            <i class="cursor-pointer ti ti-trash text-danger ms-2" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="deleteInstallment({{ $key }})" title="حذف"></i>
                            <i class="cursor-pointer ti ti-pencil text-warning ms-2" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="editInstallment({{ $key }})" title="ویرایش"></i>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>