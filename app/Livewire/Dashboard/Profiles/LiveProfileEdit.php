<?php

namespace App\Livewire\Dashboard\Profiles;

use App\Enums\EnumEducationTypes;
use App\Enums\EnumInitialLevels;
use App\Enums\EnumMilitaryStatus;
use App\Traits\StaffTrait;
use App\Traits\StudentTrait;
use App\Models\Course;
use App\Models\JobReference;
use App\Models\User;
use App\Rules\JDate;
use App\Rules\ValidNationalCode;
use App\Traits\AlertLiveComponent;
use App\Traits\DateTrait;
use App\Traits\JobsTrait;
use App\Traits\MediaTrait;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Morilog\Jalali\Jalalian;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class LiveProfileEdit extends Component
{
    use AlertLiveComponent;
    use WithFileUploads;
    use DateTrait;
    use JobsTrait;
    use MediaTrait;
    use StudentTrait;
    use StaffTrait;

    public $step = "personalInfo";
    public $stepNumber = 1;
    public $progressValue = 0;
    public $user;
    public $data;
    public $edit = true;
    // public $editPage = true;
    // public $haveJobReference = true;
    public $type;
    
    public $firstname;
    public $currentTab = 'student';
    public $disabledCreate = true;
    public $disabledEdit = true;

    public function updated()
    {
        // $this->dispatch('select2');
        // $this->loadScripts();
    }

    public function loadScripts()
    {
        $this->dispatch('persianDate');
    }

    public function mount()
    {
        $this->user = $user = auth()->user();
        $this->type = $user->userInfo?->type ?: 'student';
        $this->data['first_name'] = $user->first_name;
        $this->data['last_name'] = $user->last_name;
        $this->data['national_code'] = $user->national_code;
        $this->data['gender'] = $this->user->userInfo->gender;
        $this->data['email'] = $user->email;
        $this->data['phone'] = $user->phone;
        $this->data['father_name'] = $user->userInfo->father_name;
        $this->data['birth_date'] = Jalalian::fromDateTime($this->user->userInfo->birth_date)->format('Y-m-d');
        $this->data['register_date'] = Jalalian::fromDateTime($this->user->userInfo->register_date)->format('Y-m-d');
        $this->data['landline_phone'] = $user->userInfo->landline_phone;
        $this->data['mobile_1'] = $user->userInfo->mobile_1;
        $this->data['mobile_2'] = $user->userInfo->mobile_2;
        $this->data['address'] = $user->userInfo->address;
        $this->data['job'] = $user->userInfo->job;
        $this->data['education'] = $user->userInfo->education;
        $this->data['preferd_course'] = $user->userInfo->preferd_course;
        $this->data['initial_level'] = $user->userInfo->initial_level;
        $this->data['email'] = $user->userInfo->email;
        $this->data['refferal_name'] = $user->userInfo->refferal_name;
        $this->data['refferal_national_code'] = $user->userInfo->refferal_national_code;
        $this->data['refferal_phone'] = $user->userInfo->refferal_phone;
        $this->data['mariage_status'] = $user->userInfo->mariage_status;
        $this->data['military_status'] = $user->userInfo->military_status;

        $this->data['national_card_image'] = $this->user->getFirstMedia('national_card');
        $this->data['personal_image'] = $this->user->getFirstMedia('personal_image');
        $this->data['id_first_page_image'] = $this->user->getFirstMedia('id_first_page');
        $this->data['id_second_page_image'] = $this->user->getFirstMedia('id_second_page');
        $this->data['document_image_1'] = $this->user->getFirstMedia('document_1');
        $this->data['document_image_2'] = $this->user->getFirstMedia('document_2');
        $this->data['document_image_3'] = $this->user->getFirstMedia('document_3');
        $this->data['document_image_4'] = $this->user->getFirstMedia('document_4');
        $this->data['document_image_5'] = $this->user->getFirstMedia('document_5');
        $this->data['document_image_6'] = $this->user->getFirstMedia('document_6');
        $this->data['document_image_7'] = $this->user->getFirstMedia('document_7');
        $this->data['document_image_8'] = $this->user->getFirstMedia('document_8');

        foreach($this->user->jobReferences as $job)
            $this->tempJobs[$job->id] = [
                "id" => $job->id,
                "user_id" => $job->user_id,
                "company_name" => $job->company_name,
                "role" => $job->role,
                "date_start" => Jalalian::fromDateTime($job->date_start)->format('Y-m-d'),
                "date_end" => Jalalian::fromDateTime($job->date_end)->format('Y-m-d'),
                "description" => $job->description,
            ];
            // $this->tempJobs[$job->id] = $job->toArray();

        if(!$this->user->register_complete){
            $this->alert($this->user->first_name . ' عزیز لطفا برای استفاده از خدمات وبسایت ابتدا اطلاعات کاربری خود را تکمیل نمایید.')->error();
        }
    }

    public function setStep ( $step, $stepNumber )
    {
        $this->step = $step;
        $this->stepNumber = $stepNumber;
        $this->progressValue = ($stepNumber - 1) * 100 / 2;
        $this->loadScripts();
    }

    public function completeRegistration (  )
    {
        $user = $this->user;
        if(
            $user &&
            $user->userInfo->type === "staff" &&
            $user->user_info->gender &&
            $user->user_info->father_name &&
            $user->user_info->birth_date &&
            $user->user_info->mobile_1 &&
            $user->user_info->mobile_2 &&
            $user->user_info->address &&
            $user->user_info->job &&
            $user->user_info->education &&
            $user->user_info->email &&
            $user->user_info->mariage_status &&
            $user->getFirstMedia('national_card') &&
            $user->getFirstMedia('personal_image') &&
            $user->getFirstMedia('id_first_page') &&
            $user->getFirstMedia('id_second_page') &&
            $user->getFirstMedia('document_1') &&
            $user->getFirstMedia('document_2') &&
            $user->getFirstMedia('document_3')
        ){
            $user->update(['register_complete' => true]);
        }
    }

    public function render()
    {
        $educations = EnumEducationTypes::getTranslatedAll();
        $courses = Course::active()->get();
        $initialLevels = EnumInitialLevels::getTranslatedAll();
        $militaryStatuses = EnumMilitaryStatus::getTranslatedAll();
        return view('livewire.dashboard.profiles.live-profile-edit', compact('initialLevels', 'courses', 'educations', 'militaryStatuses'));
    }
}
