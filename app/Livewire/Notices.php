<?php

namespace App\Livewire;

use App\Models\Notice;
use Livewire\Component;

class Notices extends Component
{
    public $createNotice;

    public string $selectedTab = 'all-tab';

    public $notices;
    public $unreadNotices = [];
    public $readNotices = [];

    public function markAsRead($noticeId)
    {
        $notice = Notice::where('id', $noticeId)->first();
        $notice->update(['status' => 'read']);

        // refresh the page
        redirect()->route('notices');
    }

    private function getNotices()
    {
        $notices = auth()->user()->receivedNotices()->get();
        if (auth()->user()->isTeacher() || auth()->user()->isAdmin()) {
            $createdNotices = auth()->user()->notices()->get();

            // merge the two collections
            $this->notices = $notices->merge($createdNotices);

            // filter the notices into unread and read
            foreach ($this->notices as $notice) {
                if ($notice->status === 'unread') {
                    $this->unreadNotices[] = $notice;
                } else {
                    $this->readNotices[] = $notice;
                }
            }
        }

//        if (auth()->user()->isAdmin()) {
//            $notices = Notice::latest()->get();
//        }
    }

    public function render()
    {
        $this->getNotices();

        return view('livewire.notices', [
            'notices' => $this->notices,
            'unreadNotices' => $this->unreadNotices,
            'readNotices' => $this->readNotices,
        ]);
    }
}
