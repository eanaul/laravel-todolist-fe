<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TodoListController extends Controller
{
    public function getAllTodo()
    {
        $client = new Client();
        try {
            $response = $client->get('http://localhost:9898/todo');
            $data = json_decode($response->getBody(), true);
            return view('home', ['data' => $data]);
        } catch (\Exception $e) {
            return view('error/api_error', ['error' => $e->getMessage()]);
        }
    }

    public function add()
    {
        return view('add');
    }

    public function store(Request $request)
    {
        $client = new Client();
        try {
            $response = $client->post('http://localhost:9898/todo', [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    "thing_to_do" => $request->thing_to_do,
                    "completed" => false,
                ],
            ]);
            $data = json_decode($response->getBody(), true);
            return view('add', ['message' => 'Data successfully stored!']);
        } catch (\Exception $e) {
            return view('error/api_error', ['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $client = new Client();
        try {
            $response = $client->get('http://localhost:9898/todo/' . $id);
            $data = json_decode($response->getBody());
            return view('edit', ['data' => $data]);
        } catch (\Exception $e) {
            return view('error/api_error', ['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $client = new Client();
        try {
            $completed = $request->input('completed') === 'true';
            $response = $client->put('http://localhost:9898/todo/update/' . $id, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    "thing_to_do" => $request->thing_to_do,
                    "completed" => $completed,
                ],
            ]);
            return redirect()->back()->with('message', 'Data successfully edited!');
        } catch (\Exception $e) {
            return view('error/api_error', ['error' => $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        $client = new Client();
        try {
            $response = $client->delete('http://localhost:9898/todo/' . $id);
            return redirect()->back()->with('message', 'Data successfully deleted!');
        } catch (\Exception $e) {
            return view('error/api_error', ['error' => $e->getMessage()]);
        }
    }
}
