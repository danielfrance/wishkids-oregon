<?php

namespace App\Http\Controllers;

use App\Content;
use App\Exports\GrantersExport;
use App\Granters;
use App\GrantersKidsRel;
use App\Kids;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class VolunteerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $volunteers = Granters::all();

        return view('admin.volunteers')->with('volunteers', $volunteers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //        dd($request->input());
        $this->validate($request, [
            'name'      => 'required',
            'email'     =>  'required|email',
            'child'     =>  'required'
        ]);

        if ($request->honeypot != null) {
            return back()->withError('Bad spam bot');
        }

        $search = Granters::where('email', $request->email)->first();

        if (!$search) {
            $vol = Granters::create($request->all());
        } else {
            $vol = $search;
        }

        $rel = Kids::find($request->input('child'))->granters()->attach($vol->id, ['granter_type' => $request->granter_type]);


        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $volunteer = Granters::find($id);

        $commitments = $volunteer->commitments;

        $volunteer->delete();

        foreach ($commitments as $commitment) {
            $commitment->delete();
        }

        Session::flash('messages', 'Volunteer has been deleted');

        return  Redirect::action('VolunteerController@index');
    }

    /**
     * Export List of Volunteers.
     *
     ** @return \Illuminate\Http\Response
     */


    public function export()
    {

        return Excel::download(new GrantersExport, 'volunteers.xlsx');
        
    }
}
