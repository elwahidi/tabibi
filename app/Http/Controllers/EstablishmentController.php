<?php

namespace App\Http\Controllers;

use App\Category;
use App\Establishment;
use App\Http\Requests\Establishment\EstablishmentCreateRequest;
use Illuminate\Http\Request;

class EstablishmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('establishment.create',[
            'categories'    => Category::where('category','doctor')->orWhere('category','owner')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Establishment $establishment
     * @return \Illuminate\Http\Response
     */
    public function store(EstablishmentCreateRequest $request, Establishment $establishment)
    {
        // face
        $face = $request->file('face')->store('public/face');
        // address
        $address= $request->address_establishment . ', ' . $request->build . ', ' . $request->floor . ', ' . $request->apt_nbr;

        // request to array
        $data = $request->all();
        $data['face'] = $face;
        $data['address'] = $address;
        dd($data);
        // store

        $establishment = $establishment->onStore($data);
        // imgs
        if($request->imgs){
            foreach ($request->fille('imgs') as $img) {
                $img = $img->store('public/establishment');
                $establishment->imgs()->create(['img' => $img]);
            }
        }


        // return

        return redirect()->route('establishment.show',compact('establishment'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function show(Establishment $establishment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function edit(Establishment $establishment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Establishment $establishment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Establishment $establishment)
    {
        //
    }
}
