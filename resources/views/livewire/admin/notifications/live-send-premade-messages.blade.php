<div class="container-fluid">
    <livewire:admin.components.live-breadcrumb :items="[['title' => __('global.notifications'), 'route' => route('admin.notifications.index')], ['title' => $title]]" />
    <div class="card">
        <div class="card-body">
            <h3 class="">{{ $title }}</h3>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">پروفایل تکمیل شده</h5>
                        <p class="card-text">با سلام #USERNAME# گرامی، پروفایل شما تکمیل است. اکنون می‌توانید از تمامی امکانات سایت استفاده کنید.
                            https://iranianpilotsassociation.ir/fa/login</p>
                        <button type="button" class="btn btn-primary" wire:click="sendMessage('completedProfile')">{{ __('global.send') }}</button>
                      </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">تکمیل پروفایل</h5>
                        <p class="card-text">با سلام #USERNAME# گرامی، لطفاً اطلاعات پروفایل خود را در وبسایت انجمن خلبانان ایران تکمیل نمایید تا بتوانید از خدمات انجمن بهره‌مند شوید.
                            https://iranianpilotsassociation.ir/fa/login</p>
                        <button type="button" class="btn btn-primary" wire:click="sendMessage('notCompletedProfile')">{{ __('global.send') }}</button>
                      </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">تکمیل عضویت اخطار اول</h5>
                        <p class="card-text">#USERNAME# گرامی ، عضویت شما در انجمن خلبانان ایران تکمیل نشده است. لطفا جهت فعال‌سازی حساب و بهره‌مندی از خدمات، هرچه سریع‌تر حق عضویت را پرداخت نمایید.
                            https://iranianpilotsassociation.ir/fa/login</p>
                        <button type="button" class="btn btn-primary" wire:click="sendMessage('membershipFirstWarning')">{{ __('global.send') }}</button>
                      </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">تکمیل عضویت اخطار دوم</h5>
                        <p class="card-text">با سلام #USERNAME# گرامی، شما #HOUR# ساعت مهلت دارید تا حق عضویت خود را در وبسایت انجمن خلبانان ایران پرداخت نمایید. در غیر اینصورت، حساب شما حذف خواهد شد.
                            https://iranianpilotsassociation.ir/fa/login</p>
                        <button type="button" class="btn btn-primary" wire:click="sendMessage('membershipSecondWarning')">{{ __('global.send') }}</button>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>