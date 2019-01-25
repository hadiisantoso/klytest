<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
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
    public function store(Request $req)
    { 
     
        // dd($req->all());
        $req->validate([
            'name' => 'required',
            'email' => 'required',
            'birth_date' => 'required',
            'phone_number' => 'required|numeric',
            'gender' => 'required | not_in:0',
            'address' => 'required'
        ]);
        $data = array(
            $req->name,
            $req->email,
            $req->birth_date,
            $req->phone_number,
            $req->gender,
            $req->address
        );
        $fileName = $req->name.'-'.date("dmYHis");
        $file=fopen('../storage/app/'.$fileName,'w');
        fputcsv($file,$data);
        fclose($file);
        return redirect()->back()->with('message', 'Data telah berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file=fopen('../storage/app/'.$id,'r');
        $dataCsv = (fgetcsv($file));
        $data = new \stdClass();
        $data->name = $dataCsv[0];
        $data->email = $dataCsv[1];
        $data->birth_date = $dataCsv[2];
        $data->phone_number = $dataCsv[3];
        $data->gender = $dataCsv[4];
        $data->address = $dataCsv[5];
        fclose($file);
        return view('data-view',['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
