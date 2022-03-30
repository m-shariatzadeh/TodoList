<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\SendMailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{
    public function index()
    {
        return view('notification.index');
    }

    public function store(Request $request)
    {
        $subject = $request->subject;
        $description = $request->description;

        $users = User::where('id','!=',Auth::id())->get();
        Notification::send($users,new SendMailNotification($subject,$description));

        Session::flash('sent','اطلاعیه با موفقیت ارسال شد');
        return to_route('notification.index');
    }
}
