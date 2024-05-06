<?php

namespace App\Services;

use App\Models\User;
use App\Services\Notifications\NotificationService;

class TFAService
{
    protected $user;

    protected $notifier;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->notifier = new NotificationService($user);
    }

    public function generate_code()
    {
        $code = rand(1000, 9999);
        $code = $this->user->code ? $this->user->code()->update(['code' => $code]) : $this->user->code()->create(['code' => $code]);
        $user = User::findOrFail($this->user->id);
        $this->notifier->send('2fa-notification', 'email', $user->variables);

        return $code;
    }

    public function validate_code($code)
    {
        $validatecode = $this->user->code()->where('code', $code)->where('updated_at', '>=', now()->subMinutes(10))->first();

        $isvalidcode = !is_null($validatecode) ? true : false;
        if ($isvalidcode) {
            $this->user->code()->delete();
        }

        return $isvalidcode;
    }

    public function is_2fa_required()
    {
        return ($this->user->user_type->slug == 'staff') ? true : false;
    }
}
