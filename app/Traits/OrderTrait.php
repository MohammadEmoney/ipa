<?php

namespace App\Traits;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Morilog\Jalali\Jalalian;

trait OrderTrait
{
    public $orderNumber;
    public $ageRange;
    public $renewalNumber;

    public function generateContractNumber($gender, $semester)
    {
        $course = $semester->course;
        $ages = [
            'baby' => 'P',
            'children' => 'K',
            'youth' => 'T',
            'adults' => 'A',
        ];
        $types = [
            'public' => 'PU',
            'private' => 'PR',
            'semi_private' => 'SE',
        ];
        if($course){
            $gender = $gender === "female" ? "F" : "M";
            $ageRange= $this->ageRange = $ages[$course->age] ?? "NA";
            $order = Order::where('age_range', $ageRange)->where('type', 'tuition')->latest()->first();
            $number = $this->orderNumber = $order?->order_number ? $order->order_number + 1 : 1;
            $courseType= $types[$course->type] ?? "NA";
            $year= Jalalian::fromDateTime($semester->date_start)->format('Y');
            $renewalNumber = $this->renewalNumber ? "*T$this->renewalNumber" : "";
            return "$gender-$ageRange-$courseType-$year/$number" . $renewalNumber;
        }
        return "-";
    }

    public function generateBookContractNumber($book)
    {
        $ages = [
            'baby' => 'P',
            'children' => 'K',
            'youth' => 'T',
            'adults' => 'A',
        ];
        if($book){

            $ageRange= $this->ageRange = $ages[$book->age] ?? "NA";
            $randomLetter = collect(range('A', 'Z'))->random(1)->first();
            $random2Letter = collect(range('A', 'Z'))->random(2)->implode('');
            $order = Order::where('age_range', $ageRange)->where('type', 'book')->latest()->first();
            $number = $this->orderNumber = $order?->order_number ? $order->order_number + 1 : 1;
            $year= Jalalian::fromDateTime(now())->format('Y');
            $type = "*B";
            return "$randomLetter-$ageRange-$random2Letter-$year/$number" . $type;
        }
        return "-";
    }

    public function generateRenewalNumber($user)
    {
        $order = Order::where('user_id', $user->id)->latest()->first();
        if($order){
            $this->renewalNumber = $order->renewal_number ? $order->renewal_number++ : 1;
        }
        $this->renewalNumber = null;
    }

    public function getOrderNumber($userId, $type = 'book')
    {
        $order = Order::where('user_id', $userId)->where('type', $type)->latest()->first();
        return $order?->order_number ?: 1;
    }
}