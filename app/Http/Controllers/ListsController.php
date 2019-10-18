<?php

namespace App\Http\Controllers;

use App\lists;
use App\Card;

use Illuminate\Http\Request;

class ListsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = Lists::orderBy('created_at','asc')->get();
        return view('list.index',[
            'lists' => $lists,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('list.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation rules
        $rules = [
            'title' => 'required|string|min:2|max:191',
            'description'  => 'required|string|min:5|max:1000',
        ];
        //custom validation error messages
        $messages = [
            'title.required' => 'Title required', //syntax: field_name.rule
        ];
        //First Validate the form data
        $request->validate($rules,$messages);
        //Create a Todo
        $list = new Lists;
        $list->title = $request->title;
        $list->description = $request->description;
        $list->save(); // save it to the database.
        //Redirect to a specified route with flash message.
        return redirect()
            ->route('list.index')
            ->with('status','Created a new List!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $list = Lists::findOrFail($id);
        return view('list.show',[
            'list' => $list,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Find a Todo by it's ID
        $list = Lists::findOrFail($id);
        return view('list.edit',[
            'list' => $list,
        ]);
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
        //validation rules
        $rules = [
            'title' => "required|string|min:2|max:191", //Using double quotes
            'description'  => 'required|string|min:5|max:1000',
        ];
        //custom validation error messages
        $messages = [
            'title.required' => 'Title required',
        ];
        //First Validate the form data
        $request->validate($rules,$messages);
        //Update the Todo
        $list        = Lists::findOrFail($id);
        $list->title = $request->title;
        $list->description  = $request->description;
        $list->save(); //Can be used for both creating and updating
        //Redirect to a specified route with flash message.
        return redirect()
            ->route('list.index')
            ->with('status','Updated the selected Todo!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete the Todo
        $list = Lists::findOrFail($id);
        $list->delete();
        //Redirect to a specified route with flash message.
        return redirect()
            ->route('list.index')
            ->with('status','Deleted the selected Todo!');
    }
}
