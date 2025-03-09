<?php

declare(strict_types=1);

namespace App\Livewire\Frontend;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.frontend.index')
            ->layout('components.layouts.landing');
    }
}
