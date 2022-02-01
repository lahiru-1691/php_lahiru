<?php

namespace App\Http\Controllers;

use App\WorkingRoutes;
use App\Person;
use Illuminate\Http\Request;
use DB;

/**
 * SalesPersonController Class
 * @author Lahiru Perera
 * 
 */

class SalesPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $salesPerson = Person::with('route')->latest()->paginate(10);
        

        return view('SalesPerson.list')->with(compact('salesPerson'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $workingRoutes = WorkingRoutes::all();
        return view('SalesPerson.add')->with(compact('workingRoutes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'email'       => 'required|email',
            'telephone'   => 'required',
            'date'        => 'required',
            'route'       => 'required'
        ]);

        DB::transaction(function () use($request) {
            Person::create([
                'name'              => $request->name,
                'email'             => $request->email,
                'telephone'         => $request->telephone,
                'joined_date'       => $request->date,
                'working_route_id'  => $request->route,
                'working_route_id'  => $request->route,
                'comment'           => $request->comments,
            ]);
        });

        return redirect()->route('add')
            ->with('success', 'Sales Person created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $salesPerson = Person::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
