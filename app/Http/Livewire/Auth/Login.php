<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $username = '', $password = '', $remember;

    public $captcha, $captchaImg;

    public function mount()
    {
        $this->captchaImg = captcha_img('default');
    }

    public function render()
    {
        if (Auth::check()) {
            redirect()->route('admin.dashboard');
        }

        if ($this->getErrorBag()->has('captcha')) {
            $this->captchaImg = captcha_img('default');
            $this->captcha = null;
        }

        return view('livewire.auth.login')
            ->layout('admin.layouts.blank')
            ->layoutData([
                'title' => 'Login',
                'description' => 'Login to your account',
                'keywords' => 'login, account',
            ]);
    }

    public function reloadCaptcha()
    {
        $this->captchaImg = captcha_img('default');
        $this->captcha = null;
        $this->resetErrorBag('captcha');
    }

    public function loginAttemp()
    {
        $validasi = $this->validate([
            'username' => 'required|alpha_dash',
            'password' => 'required',
            'captcha' => 'required|captcha',
        ], [], ['captcha' => 'Captcha']);

        if ($validasi) {
            if (Auth::attempt([
                'username' => $this->username,
                'password' => $this->password,
            ], $this->remember)) {
                return redirect()->route('admin.dashboard');
            } else {
                $this->reloadCaptcha();
                $this->showToastr('error', 'Error', 'Login gagal.');
            }
        }
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'username' => 'required|alpha_dash|exists:users,username',
        ], [
            'username.exists' => 'Username tidak ditemukan.',
        ]);
    }

    // SWEETALERT
    public function showAlert($icon, $title, $text)
    {
        $this->emit('swal:modal', [
            'icon'  => $icon,
            'title' => $title,
            'text'  => $text,
        ]);
    }

    // TOASTR
    public function showToastr($icon, $title, $text)
    {
        $this->emit('swal:alert', [
            'icon'    => $icon,
            'title'   => $title,
            'text'  => $text,
            'timeout' => 10000000
        ]);
    }
}
