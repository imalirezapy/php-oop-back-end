<?php
function fa_validation()
{
    return [
        'required' => "فیلد {name} ضروری است",
        'int' => " در فیلد {name} فقط عدد وارد کنید",
        'min' => "فیلد {name} نمیتواند کمتر از {num} کاراکتر باشد",
        'max' => "فیلد {name} نمیتواند بیشتر از {num}کاراکتر باشد",
    ];
}