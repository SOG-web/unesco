<?php

namespace App\Livewire;

use Livewire\Component;

class Notices extends Component
{
    public $createNotice;

//    public function markAsRead($noticeId)
//    {
//        $notice = auth()->user()->notices()->where('id', $noticeId)->first();
//        $notice->update(['read' => true]);
//        $this->notices = auth()->user()->notices()->get();
//    }


    public function render()
    {

        return view('livewire.notices', [
            'notices' => auth()->user()->notices()->get(),
        ]);
    }
}
