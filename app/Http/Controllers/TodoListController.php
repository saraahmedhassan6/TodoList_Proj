<?php

namespace App\Http\Controllers;
use App\Models\TodoList;
use MongoDB\Client;


use Illuminate\Http\Request;

class TodoListController extends Controller
{
    protected $TodoList;

    public function __construct()
    {
        $this->TodoList = new TodoList();
    }

    public function index()
    {
        $data = $this->TodoList->getAllData();

        return view('index', compact('data'));
    }

    public function store(Request $request)
    {
        $data = [
            'List' => $request->input('List'),
        ];

        $this->TodoList->insertData($data);

        return redirect()->back();
    }

    public function delete($id)
    {
        $this->TodoList->remove($id);
        return redirect()->back();
    }
    public function update(Request $request)
    {
        $id = $request->id;
        $data = [
            'List' => $request->input('List'),
        ];

        $this->TodoList->updateData($id, $data);

        return redirect()->back();
    }


 
    
}
