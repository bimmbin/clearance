<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Log;

class ReportList extends Component
{
    public $reports;

    public function mount()
    {
        $this->reports = Log::latest()->get();
    }

    public function render()
    {
        return view('livewire.report-list');
    }
}
