<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Task;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    function index(){
        $tasks = DB::table('tasks')->get();
        return view('index', compact('tasks'));
    }

    function store(Request $request){
        $task = new Task();
        $task->title = $request->get('title');
        $task->start_date = $request->get('start-date');
        $task->end_date = $request->get('end-date');
        $task->status = $request->get('status');
        if($request->file('file')) {
            $path = $request->file('file')->store('uploads', 'public');
            $task->image = $path;
        }
        $task->save();
        return redirect()->route('tasks.index');
    }

    function destroy(Request $request){
        DB::table('tasks')->delete($request->id);
        return redirect()->route('tasks.index');
    }

    function create(){
        return view('add');
    }

    
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->title = $request->input('title');
        $task->start_date = $request->input('start-date');
        $task->end_date = $request->input('end-date');
        $task->status = $request->get('status');
        //cap nhat anh
        if ($request->hasFile('image')) {
            //xoa anh cu neu co
            $currentImg = $task->image;
            if ($currentImg) {
                Storage::delete('/public/' . $currentImg);
            }
            // cap nhat anh moi
            $image = $request->file('file');
            $path = $image->store('uploads', 'public');
            $task->image = $path;
        }

        $task->save();
        //tao moi xong quay ve trang danh sach task
        return redirect()->route('tasks.index');
    }

    function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('edit', compact('task'));
    }
}