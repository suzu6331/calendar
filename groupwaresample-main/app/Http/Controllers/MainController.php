<?php
//ユーザー設定、背景色変更
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function welcome(): View
    {
        $users = User::get();
        return view('welcome', compact('users'));
    }

    public function home(): View
    {
        $users = User::get();
        return view('home', compact('users'));
    }

    public function setting(): View
    {
        return view('setting');
    }

    public function updateSetting(Request $request)
    {
        $user = Auth::user();
        $user->calendar_background = $request->calendar_background;
        $user->calender_bordercolor = $request->calender_bordercolor;
        $user->calendar_textcolor = $request->calendar_textcolor;
        $user->save();
        return redirect()->route('setting')->with([
            'message' => '個人設定を更新しました。',
        ]);
    }
}
