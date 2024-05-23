<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\User;

class NoticesController extends Controller
{
    public function index()
    {

        $notices = auth()->user()->receivedNotices()->get();
        $createdNotices = [];

        if (auth()->user()->isTeacher() || auth()->user()->isAdmin()) {
            $createdNotices = auth()->user()->notices()->get();
        }

        if (auth()->user()->isAdmin()) {
            $notices = Notice::latest()->get();
        }

        return view('notices.index', [
            'notices' => $notices,
            'createdNotices' => $createdNotices,
        ]);
    }

    public function store()
    {
        if (!auth()->user()->isTeacher() || !auth()->user()->isAdmin()) {
            abort(401);
        }

        $validate = request()->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'recipientsIds' => ['required', 'array']
        ]);

        $users = User::whereIn('id', $validate->recipientsIds)->get();

        $notice = Notice::create([
            'user_id' => auth()->id(),
            'title' => $validate->title,
            'content' => $validate->content,
            'status' => 'unread',
            'type' => 'notice'
        ]);

        foreach ($users as $user) {
            $notice->recipients()->attach($user->id);
        }


        return redirect('/notices');
    }

    public function create()
    {
        if (!auth()->user()->isTeacher() || !auth()->user()->isAdmin()) {
            abort(401);
        }

        return view('notices.create');
    }
}
