<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\RegisterEvent;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::where('status', 2)->get();
        return view('welcome', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::find($id);
        return view('detail-event', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Register event.
     */
    public function registerEvent(Request $request)
    {
        $event = Event::find($request->event_id);

        // Check jika user sudah terdaftar
        $check = $event->registerEvents()->where('user_id', Auth::user()->id)->first();
        if ($check) {
            session()->flash('error', 'Anda sudah terdaftar dalam acara ini.');
            return redirect()->route('detail-event', $request->event_id);
        }

        // Lakukan pendaftaran
        RegisterEvent::create([
            'code' => 'REG-' . time(),
            'user_id' => Auth::user()->id,
            'event_id' => $request->event_id,
            'status' => 1,
            'virtual_account' => $request->virtual_account
        ]);

        session()->flash('success', 'Pendaftaran berhasil.');
        return redirect()->route('detail-event', $request->event_id);
    }
}
