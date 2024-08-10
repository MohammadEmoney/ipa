<div class="container-fluid">
    <livewire:admin.components.live-breadcrumb :items="[['title' => 'نقش های کاربران']]" />

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h5 class="card-title fw-semibold mb-4">دوره ها</h5>
                <button class="btn btn-sm btn-ac-info" wire:click="create">ایجاد دوره</button>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">عنوان نقش</th>
                            {{-- <th scope="col">عملیات</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <th scope="row">{{  ($roles->currentpage()-1) * $roles->perpage() + $key + 1 }}</th>
                                <td class="d-flex">
                                    <a href="javascript:void(0)" wire:click="edit({{ $role->id }})">{{ __('admin/globals.role_names.' . $role->name) }}</a>
                                    <i class="cursor-pointer ti ti-pencil text-warning me-3" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="edit({{ $role->id }})" title="ویرایش"></i>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $roles->links() }}
            </div>
        </div>
    </div>

</div>
