<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Message;

class HistoryTable extends Component
{
    public $pageSize = 10;
    public $search = '';
    public $orderBy = 'created_at';
    public $orderDirection = 'desc';

    public function render()
    {
        return view('livewire.history-table', [
            'messages' => Message::search($this->search)
                ->currentUser()
                ->orderBy($this->orderBy, $this->orderDirection)
                ->simplePaginate($this->pageSize)
        ]);
    }
}
