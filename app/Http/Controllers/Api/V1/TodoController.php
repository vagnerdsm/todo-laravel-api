<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TodoResource::collection(Todo::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title"=> "required",
            "description" => "required",
            "done"=> "required",
        ]);
        if ($validator->fails()) {
            return response()->json(["message"=> $validator->errors()->first()],422);
        } 
        $created = Todo::create($validator->validated());

        if ($created) {
            return response()->json(["message"=> "Tarefa cadastrada com sucesso!"],200);
        }

        if (!$created) {
            return response()->json(["message"=> "Ops, algo deu errado."],402);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new TodoResource(Todo::find($id));
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
        $deleted = Todo::find($id)->delete();
        if ($deleted) {
            return response()->json(["message"=> "Tarefa deletada com sucesso!"],200);
        } else {
            return response()->json(["message"=> "Algo deu errado"],400);
        }
    }
}
