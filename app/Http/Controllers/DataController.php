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
        $dir    = '../storage/app/public/';
        $files = scandir($dir, 1);
        $dataall = array();
        for($i=0;$i<sizeof($files);$i++){
            if(strpos($files[$i],'.txt')==true){
                array_push($dataall,$files[$i]);
            }
        }
        return view('data-list',['datas'=>$dataall]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data-create');
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
        $file=fopen('../storage/app/public/'.$fileName.'.txt','w');
        fputcsv($file,$data);
        fclose($file);
        return redirect()->back()->with('message', 'Terima kasih telas mengisi form');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file=fopen('../storage/app/public/'.$id,'r');
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
        $dir = '../storage/app/public/'.$id;
        $file=fopen($dir,'r');
        $dataCsv = (fgetcsv($file));
        $data = new \stdClass();
        $data->name = $dataCsv[0];
        $data->email = $dataCsv[1];
        $data->birth_date = $dataCsv[2];
        $data->phone_number = $dataCsv[3];
        $data->gender = $dataCsv[4];
        $data->address = $dataCsv[5];
        fclose($file);
        return view('data-edit',['data' => $data,'file'=>$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
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
        $file=fopen('../storage/app/public/'.$id,'w');
        fputcsv($file,$data);
        fclose($file);
        return redirect()->back()->with('message', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file='../storage/app/public/'.$id;
        if (!unlink($file))
        {
            echo ("Error deleting $file");
        }
        else
        {
            echo ("Deleted $file");
        }
        return redirect()->route('data.index');
    }
}
