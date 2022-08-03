<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $todo = Todo::all();
    return view('index')->with('todos', $todo);
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
 public function store(){

        $this->validate(request(), [
            'name' => ['required'],
            'description' => ['required']
        ]);


    $data = request()->all();

 
    


    $todo = new Todo();
    //On the left is the field name in DB and on the right is field name in Form/view
    $todo->name = $data['name'];
    $todo->description = $data['description'];
  
    $todo->save();

    session()->flash('success', 'Todo created succesfully');

    return redirect('/');

}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
       
        return view('details')->with('todos', $todo);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        //
        return view('edit')->with('todos', $todo);;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Todo $todo)
    {
        
            $this->validate(request(), [
                'name' => ['required'],
                'description' => ['required'],
           
            ]);
        

        $data = request()->all();

    

       
        $todo->name = $data['name'];
        $todo->description = $data['description'];
        $todo->save();

        session()->flash('success', 'Todo updated successfully');

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Todo $todo){

        $todo->delete();

        return redirect('/');

    }
}
