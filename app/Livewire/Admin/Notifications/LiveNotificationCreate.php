<?php

namespace App\Livewire\Admin\Notifications;

use App\Enums\EnumNotificationMethods;
use App\Enums\EnumUserRoles;
use App\Mail\EmailUserNotification;
use App\Models\User;
use App\Models\UserNotification;
use App\Notifications\UserNotification as Notification;
use App\Rules\EmailsValidation;
use App\Services\SmsMessage;
use App\Traits\AlertLiveComponent;
use App\Traits\MediaTrait;
use App\Traits\NotificationTrait;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class LiveNotificationCreate extends Component
{
    use AlertLiveComponent, WithFileUploads, MediaTrait, NotificationTrait;

    public $sendVia = ['email'];
    public $data = [];
    public $title;

    public function mount()
    {
        $this->title = __('global.create_notification');
        $this->data['roles'] = ['user'];
        $this->data['from'] = 'info@iranianpilotsassociation.ir';
        // $this->alert(__('messages.under_development'))->warning()->redirect('admin.dashboard');
    }

    public function validations()
    {
        $this->validate(
            [
                'data.roles' => 'required|array',
                'data.roles.*' => 'required|in:' . EnumUserRoles::asStringValues(),
                'data.send_via' => 'required|array',
                'data.send_via.*' => 'required|in:' . EnumNotificationMethods::asStringValues(),
                'data.users' => 'nullable|array',
                'data.users.*' => 'nullable|exists:users,id',
                'data.message' => 'required|string',
            ],
            [],
            [
                'data.roles' => __('global.roles'),
                'data.send_via' => __('global.send_via'),
                'data.users' => __('global.users'),
                'data.summary' => __('global.summary'),
                'data.message' =>__('global.message'),
            ]
        );
    }

    public function updated()
    {
        // dd('asdasd');
        // $this->dispatch('loadJs');
    }

    public function getUsers()
    {
        $activeUsers = User::query()->active()->whereHas('roles', function($query){
            $query->whereIn('name', ['users']);
        })->count();
        $notActiveUsers = User::query()->whereHas('roles', function($query){
            $query->whereIn('name', ['users']);
        })->notActive()->count();
        $usersNotCompletedProfile = User::query()->active()->whereHas('roles', function($query){
            $query->whereIn('name', ['users']);
        })->where(function (Builder $query) {
            // Check for required fields in User model
            $query->whereNull('first_name')
                  ->orWhereNull('last_name')
                  ->orWhereNull('phone')
                  ->orWhereNull('phone_verified_at');
        })
        ->orWhereDoesntHave('media', function (Builder $query) {
            // Check for media for nationalCard and license
            $query->whereIn('name', ['nationalCard', 'license']);
        })
        ->orWhereDoesntHave('userInfo', function (Builder $query) {
            // Check for required fields in userInfo
            $query->whereNull('situation')
                  ->orWhere(function (Builder $query) {
                      $query->where('situation', 'employed')
                            ->whereNull('airline_id');
                  });
        })
        ->count();
        $usersCompletedProfile = User::query()->active()->whereHas('roles', function($query){
            $query->whereIn('name', ['users']);
        })->whereNot(function (Builder $query) {
            // Check for required fields in User model
            $query->whereNull('first_name')
                  ->orWhereNull('last_name')
                  ->orWhereNull('phone')
                  ->orWhereNull('phone_verified_at');
        })
        ->whereHas('media', function (Builder $query) {
            // Ensure media for nationalCard and license exists
            $query->whereIn('collection_name', ['nationalCard', 'license']);
        })
        ->whereHas('userInfo', function (Builder $query) {
            // Ensure required fields in userInfo are filled
            $query->whereNotNull('situation')
                  ->where(function (Builder $query) {
                      $query->where('situation', '!=', 'employed')
                            ->orWhereNotNull('airline_id');
                  });
        })
        ->count();
        
    }

    public function selectAll()
    {
        $this->dispatch('loadJs');
        foreach($this->users() as $user)
            $this->data['users'][] =  $user->id;
    }

    public function users()
    {
        // dd($this->data['roles']);
        return User::query()->whereHas('roles', function($query){
            $query->whereIn('name', $this->data['roles']);
        })->get();
    }

    public function submit()
    {
        $this->validations();
        try {
            DB::beginTransaction();

            // new Notification($this->data['send_via']);
            if(in_array(EnumNotificationMethods::SMS, $this->data['send_via'])){
                $mobiles = User::whereIn('id', $this->data['users'])->pluck('phone')->toArray();
                // dd($mobiles);
                $sendMessage = app(SmsMessage::class)
                    ->mobiles($mobiles)
                    ->messageText($this->stripTagsPreservingNewlines($this->data['message']))
                    ->bulkSend();
            }
            if(in_array(EnumNotificationMethods::EMAIL, $this->data['send_via'])){

                $this->validate([
                    'data.subject' => 'required|string|max:255',
                    'data.emails' => [ Rule::requiredIf(empty($this->data['users'])), 'nullable', 'string', new EmailsValidation],
                    'data.users' => [
                        Rule::requiredIf(empty($this->data['emails'])),
                        'array',
                    ],
                    'data.users.*' => 'exists:users,id'
                ],[
                    'data.emails.required_if' => __('messages.emails_required'),
                ],[
                    'data.subject' => __('global.subject'),
                    'data.emails' => __('global.email'),
                ]);

                $emails = [];
                $userEmails = [];

                if(!empty($this->data['emails'])){
                    $emails = explode(',', $this->data['emails']);
                }
                if(!empty($this->data['users'])){
                    $userEmails = User::whereIn('id', $this->data['users'])->whereNotNull('email')->pluck('email')->toArray();
                }

                $recipientsArray = array_merge($emails, $userEmails);

                foreach ($recipientsArray as $recipient) {
                    Mail::to(trim($recipient))->send(new EmailUserNotification($this->data['subject'], $this->data['message']));
                }
            }

            $userNotification = UserNotification::create([
                'user_id' => Auth::id(),
                'title' => $this->data['subject'] ?? null,
                'from' => $this->data['from'] ?? null,
                'to' => $this->data['emails'] ?? null,
                'roles' => $this->data['roles'] ?? null,
                'send_via' => $this->data['send_via'] ?? null,
                'users' => $this->data['users'] ?? null,
                'message' => $this->data['message'] ?? null,
            ]);
            
            DB::commit();
            $this->alert(__('messages.message_sent_successfully'))->success();
            // return redirect()->to(route('admin.posts.index'));
        } catch (Exception $e) {
            $this->alert($e->getMessage())->error();
        }
    }

    public function render()
    {
        $roles = EnumUserRoles::getTranslatedAll();
        $sendMethods = EnumNotificationMethods::getTranslatedAll();

        $users = $this->users();
        $this->dispatch('loadJs');
        return view('livewire.admin.notifications.live-notification-create', compact('roles', 'users', 'sendMethods'))->extends('layouts.admin-panel')->section('content');
    }
}
