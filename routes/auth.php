<?php
// Authentication Routes...
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;

$this->get('login', LoginController::class . '@showLoginForm')->name('login');
$this->post('login', LoginController::class . '@login');
$this->post('logout', LoginController::class . '@logout')->name('logout');

$this->get('register', RegisterController::class . '@showRegistrationForm')->name('register');
$this->post('register', RegisterController::class . '@register');

// Password Reset Routes...
$this->get('password/reset', ForgotPasswordController::class . '@showLinkRequestForm')->name('password.request');
$this->post('password/email', ForgotPasswordController::class . '@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', ResetPasswordController::class . '@showResetForm')->name('password.reset');
$this->post('password/reset', ResetPasswordController::class . '@reset')->name('password.update');
