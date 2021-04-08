<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return Application|Factory|View|\Illuminate\View\View
     */
    public function render()
    {
        if (Auth::check()) {
            return view('layouts.app');
        }
        return view('layouts.guest');
    }
}
