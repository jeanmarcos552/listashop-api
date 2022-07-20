<?php

namespace App\Http\Controllers;

use App\Events\Notifications\SendNotification;
use App\Models\Notifications;
use App\Models\User;
use BeyondCode\LaravelWebSockets\Dashboard\Http\Controllers\SendMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::find(auth()->user()->id)
            ->notifications()
            ->with("user_send", "user_receiver", "lista")
            ->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'description' => 'required',
            'user_send' => 'required',
            'user_receiver' => 'required',
            'lista' => 'required',
        ]);

        $usuario = User::where("email", "=", $input['user_receiver'])->first();

        $input['user_receiver'] = $usuario->id;

        // event(new SendNotification($input, $input['user_receiver']));

        $notifications = Notifications::create($input);

        return $notifications;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Notifications::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Notifications::find($id);
        $item->update($request->all());
        return $item;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Notifications::find($id);
        return $item->delete($id);
    }
}