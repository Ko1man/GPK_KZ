<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait UserScope
{
    public function scopeFilter(Builder $query)
    {
        $name = request()->name;
        $phone = request()->phone;
        $email = request()->email;
        $last_name = request()->last_name;
        $second_name = request()->second_name;
        $address = request()->address;
        $role = request()->role;
        $date_of_admission = request()->date_of_admission;
        $date_of_birth = request()->date_of_birth;

        $query->when($name, function (Builder $q, $name) {
            $q->where('name', 'like', '%' . $name . '%');
        })->when($phone, function (Builder $q, $phone) {
            $q->where('phone', 'like', '%' . $phone . '%');
        })->when($email, function (Builder $q, $email) {
            $q->where('email', 'like', '%' . $email . '%');
        })->when($role, function (Builder $q, $role) {
            $q->where('role', 'like', '%' . $role . '%');
        })->when($address, function (Builder $q, $address) {
            $q->where('address', 'like', '%' . $address . '%');
        })->when($last_name, function (Builder $q, $last_name) {
            $q->where('last_name', 'like', '%' . $last_name . '%');
        })->when($second_name, function (Builder $q, $second_name) {
            $q->where('second_name', 'like', '%' . $second_name . '%');
        })->when($date_of_admission, function (Builder $q, $date_of_admission) {
            $q->where('date_of_admission', 'like', '%' . $date_of_admission . '%');
        })->when($date_of_birth, function (Builder $q, $date_of_birth) {
            $q->where('date_of_birth', 'like', '%' . $date_of_birth . '%');
        });
        return $query;
    }
}
