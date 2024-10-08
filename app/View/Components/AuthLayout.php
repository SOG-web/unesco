<?php

namespace App\View\Components;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AuthLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        $user = User::find(auth()->id());

        $notices = $user->unreadNotices()->latest()->get();

        $pNotices = $notices->take(3);

        $activities = $user->unreadActivities()->latest()->take(3)->get();

        return view('layouts.auth-layout', [
            'notices' => $pNotices,
            'noticeCount' => $notices->count(),
            'activities' => $activities,
        ]);
    }
}
