<?php

namespace App\Http\Controllers;

use App\Content;
use App\GrantersKidsRel;
use App\Kids;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ChildrenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function volunteerView()
    {
        $kids = Kids::orderBy('name', 'ASC')->get();

//        dd($kids[0]->leadGranter());

        $content = Content::find(1);
        
        return view('volunteer')->with('kids', $kids)->with('content', $content);
    }
    
    public function index()
    {
        $kids = Kids::where('deleted_at', null)->orderBy('name', 'ASC')->get();
        
        $content = Content::find(1);

        return view('admin.children.children')->with('kids', $kids)->with('content', $content);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.children.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->flash();

        $this->validate($request, [
            'name'               => 'required',
            'age'                => 'required',
            'sex'                => 'required',
            'illness'            => 'required',
            'city'               => 'required',
            'language'           => 'required',
            'bio'                => 'required'

        ]);


        $kid =  Kids::create($request->all());

        if ($request->hasFile('image')) {
            $today = new Carbon();

            $path = public_path();
            $destinationPath = $path . '/assets/images/kids/';
            $filename = $kid->id . '-' . $kid->name . '-photo'.$today->toDateString().'.jpg';
            $request->file('image')->move($destinationPath, $filename);

            $kid->image = $filename;
            $kid->save();
        }

        if ($request->has('order')) {
            $kid->order = $request->input('order');
            $kid->save();
        }



        Session::flash('messages', 'New Child was saved successfully');

    
        return redirect('children/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $kid = Kids::find($id);

        if ($kid->sex == 'male') {
            $sex = [
                'male'=> 'selected',
                'female' => ''
            ];
        } else {
            $sex = [
                'female'=> 'selected',
                'male' => ''
            ];
        }

        return view('admin.children.edit')->with('kid', $kid)->with('sex', $sex);
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
        $kid = Kids::findOrFail($id);



        $this->validate($request, [
            'name'               => 'required',
            'age'                => 'required',
            'sex'                => 'required',
            'illness'            => 'required',
            'city'               => 'required',
            'language'           => 'required',
            'bio'                => 'required'

        ]);

        $input = $request->all();

        $kid->fill($input)->save();

        $kid->save();

        if ($request->hasFile('image')) {
            $today = new Carbon();

            $path = public_path();
            $destinationPath = $path . '/assets/images/kids/';
            $filename = $kid->id . '-' . $kid->name . '-photo'.$today->toDateString().'.jpg';
            $request->file('image')->move($destinationPath, $filename);

            $kid->image = $filename;
            $kid->save();
        }

        Session::flash('messages', $kid->name . ' was saved successfully');

        return Redirect::back();
    }

    public function updateOrder(Request $request, $id)
    {
        $kid = Kids::findOrFail($id);

        $kid->order = $request['order'];

        $kid->save();

        Session::flash('messages', $kid->name . ' was saved successfully');

        return Redirect::back();
    }

    public function softDelete($id)
    {
        $child = Kids::find($id);

        Session::flash('messages', $child->name. " has been deleted");

        $child->delete();

        return  Redirect::action('ChildrenController@index');
    }

    public function unhookGranter($id)
    {
        $rel = GrantersKidsRel::where('granters_id', $id);

        $rel->delete();

        Session::flash('messages', 'Volunteer has been removed from this Child');

        return Redirect::back();
    }
}
