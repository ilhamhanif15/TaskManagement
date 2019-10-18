<?php

namespace App\Http\Controllers;

use App\Card;
use App\Lists;

use Illuminate\Http\Request;

class CardController extends Controller
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
        $card = Card::orderBy('created_at','desc')->paginate(0);
        return view('card.index',[
            'card' => $card,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($list_id)
    {
        $list = Lists::findOrFail($list_id);
        return view('card.create',[
            'list_id' => $list_id,
        ]);
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
            'body'  => 'required|string|min:5|max:1000',
            'list_id' => 'required|integer'
        ];
        //custom validation error messages
        $messages = [
            'title.required' => 'Title required', //syntax: field_name.rule
        ];
        
        //First Validate the form data
        $request->validate($rules,$messages);
        
        //Find If List_id exist
        $list = Lists::findOrFail($request->list_id);

        //Create a Todo
        $card = new Card;
        $card->title = $request->title;
        $card->body = $request->body;
        $card->list_id = $request->list_id;
        $card->save(); // save it to the database.
        //Redirect to a specified route with flash message.
        return redirect()
            ->route('list.index')
            ->with('status','Created a new Todo!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $card = Card::findOrFail($id);
        return view('card.show',[
            'card' => $card,
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
        $card = Card::findOrFail($id);
        return view('card.edit',[
            'card' => $card,
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
            'body'  => 'required|string|min:5|max:1000',
        ];
        //custom validation error messages
        $messages = [
            'title.required' => 'Title required',
        ];
        //First Validate the form data
        $request->validate($rules,$messages);
        //Update the Todo
        $card        = Card::findOrFail($id);
        $card->title = $request->title;
        $card->body  = $request->body;
        $card->save(); //Can be used for both creating and updating
        //Redirect to a specified route with flash message.
        return redirect()
            ->route('card.show',$id)
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
        $card = Card::findOrFail($id);
        $card->delete();
        //Redirect to a specified route with flash message.
        return redirect()
            ->route('card.index')
            ->with('status','Deleted the selected Todo!');
    }
    
}
