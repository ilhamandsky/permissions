<?php

namespace App\Http\Controllers;
use App\Models\Room;
use Illuminate\Http\Request;
class RoomController extends Controller {
    public function index() {
        return view('admin.rooms', ['rooms' => Room::all()]);
    }
    public function store(Request $request) {
        Room::create($request->all());
        return back();
    }
    public function update(Request $request, $id) {
        Room::findOrFail($id)->update($request->all());
        return back();
    }
    public function destroy($id) {
        Room::findOrFail($id)->delete();
        return back();
    }
}