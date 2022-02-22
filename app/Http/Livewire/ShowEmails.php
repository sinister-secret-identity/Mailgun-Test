<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use Livewire\Component;
use Livewire\WithPagination;

class ShowEmails extends Component
{
    use WithPagination;

    public $search = '';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.show-emails', [
            'emails' => Message::where([
                ['user_id', '=', Auth::id()],
                ['to', 'like', '%'.$this->search.'%']
            ])
            ->latest()
            ->paginate(10)
        ]);
    }
}
