<?php

namespace App\core;

defined("ROOTPATH") or exit("access Denied");


trait Validation
{
    public function is_valid($data)
    {
        $this->errors = [];

        if (empty($data['email'])) {
            $this->errors['email'] = "Email is required";
        } else
		if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Email is not valid";
        }

        if (empty($data['password'])) {
            $this->errors['password'] = "Password is required";
        }

        if (empty($data['terms'])) {
            $this->errors['terms'] = "Please accept the terms and conditions";
        }

        if (empty($this->errors)) {
            return true;
        }

        return false;
    }
}
