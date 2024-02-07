<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Calendars\EventResource;
use App\Mail\InviteMemberMail;
use App\Models\Event;
use App\Models\EventMember;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CalendarApiController extends Controller
{

    public function index(Request $request)
    {
        $events = Event::dateRange($request->start, $request->end)->get();
        return EventResource::collection($events);
    }

    public function store(Request $request)
    {
        DB::transaction(function() use($request){
            $event = new Event;
            $event->user_id = Auth::id();
            if ($request->all_day_flag) {
                $event->start_time = Carbon::parse($request->date)->startOfDay();
                $event->end_time = Carbon::parse($request->date)->startOfDay();
            } else {
                list($hours, $minutes) = explode(':', $request->start_time);
                $event->start_time = Carbon::parse($request->date)->setTime($hours, $minutes);
                list($hours, $minutes) = explode(':', $request->end_time);
                $event->end_time = Carbon::parse($request->date)->setTime($hours, $minutes);
            }
            $event->fill($request->all())->save();
            $this->addEventMembers($event, $request->users);
        });
        return $request->all();
    }

    public function update(Request $request, Event $event)
    {
        DB::transaction(function() use($request, $event){
            if ($request->all_day_flag) {
                $event->start_time = Carbon::parse($request->date)->startOfDay();
                $event->end_time = Carbon::parse($request->date)->startOfDay();
            } else {
                list($hours, $minutes) = explode(':', $request->start_time);
                $event->start_time = Carbon::parse($request->date)->setTime($hours, $minutes);
                list($hours, $minutes) = explode(':', $request->end_time);
                $event->end_time = Carbon::parse($request->date)->setTime($hours, $minutes);
            }
            $event->fill($request->all())->save();
            $event->eventMembers()->delete();
            $this->addEventMembers($event, $request->users);
        });
    }

    public function show(Event $event)
    {
        $event->load('eventMembers.user');
        return new EventResource($event);
    }

    public function destroy(Event $event)
    {
        $event->delete();
    }

    private function addEventMembers(Event $event, array $userIds)
    {
        foreach ($userIds as $userId) {
            $eventMember = new EventMember;
            $eventMember->event_id = $event->id;
            $eventMember->user_id = $userId;
            $eventMember->save();
            $mail = new InviteMemberMail($event);
            $user = User::find($userId);
            Mail::to($user->email)->send($mail);
        }
    }
}
