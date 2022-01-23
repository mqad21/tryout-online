<?php

namespace App\Http\Controllers;

use App\DataTables\EventsDataTable;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    
    public function daftar_event(EventsDataTable $datatable)
    {
        return $datatable->render('pages.event.daftar-event');
    }

    public function buat_event()
    {
        return view('pages.event.buat-event');
    }

    public function buat_event_post(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'start_date' => 'required',
            'poster_file' => 'file|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->file('poster_file')) {
            $photo = $request->file('poster_file');
            $filename = uniqid() . "_event." . $photo->getClientOriginalExtension();
            $photo->move("poster_event", $filename);
            $request['poster_url'] = asset('poster_event/' . $filename);
        }

        $request['user_id'] = Auth::user()->id;
        $event = collect($request)->only('title', 'start_date', 'end_date', 'place', 'description', 'poster_url', 'user_id')->toArray();
        Event::create($event);

        return redirect('/event')->with('alert', [
            'type' => 'success',
            'message' => 'Berhasil membuat event',
            'title' => 'Berhasil'
        ]);
    }

    public function edit_event($id)
    {
        $event = Event::own()->findOrFail($id);
        return view('pages.event.buat-event', compact('event'));
    }

    public function edit_event_post(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'start_date' => 'required',
            'poster_file' => 'file|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->file('poster_file')) {
            $photo = $request->file('poster_file');
            $filename = uniqid() . "_event." . $photo->getClientOriginalExtension();
            $photo->move("poster_event", $filename);
            $request['poster'] = asset('poster_event/' . $filename);
        }

        $request['user_id'] = Auth::user()->id;
        $event = collect($request)->only('title', 'start_date', 'end_date', 'place', 'description', 'poster_url', 'user_id')->toArray();
        Event::own()->findOrFail($id)->update($event);

        return redirect('/event')->with('alert', [
            'type' => 'success',
            'message' => 'Berhasil mengedit event',
            'title' => 'Berhasil'
        ]);
    }

    public function hapus_event(Request $request, $id)
    {
        Event::own()->findOrFail($id)->delete();
        return redirect()->back()->with('alert', [
            'type' => 'success',
            'message' => 'Berhasil menghapus event',
            'title' => 'Berhasil'
        ]);
    }
}
