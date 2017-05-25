<?php

namespace Adnotare\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request['q'])){
            //$files = \Adnotare\File::where('name', 'LIKE', '%' . $request['q'] . '%')->get();
            $files = \Adnotare\File::all();
            $idArray = [];

            foreach ($files as $file) {
                if (strpos($file->name, $request['q']) !== false) {
                    $idArray[] = $file->id;
                    break;
                }

                $fileContent = file_get_contents(storage_path() . '/app/' . $file->path);
                if (strpos($fileContent, $request['q']) !== false) {
                    $idArray[] = $file->id;
                }
            }
            $files = \Adnotare\File::whereIn('id', $idArray)->orderBy('rank', 'DESC')->get();
        } else {
            $files = \Adnotare\File::orderBy('rank', 'DESC')->get();
        }

        return view('files.index', compact("files"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('files.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = new \Adnotare\File;
        $file->user_id = Auth::id();
        $file->name = $request['name'];

        $path = $request->file('file')->store('files');
        
        $file->path = $path;
        $file->save();

        return redirect()->route('file.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file = \Adnotare\File::find($id);
        $file->rank = $file->rank+1;
        $file->update();

        // echo $file->rank;
        // echo '<br>';
        // //echo "Nume: $file->name <br> Id: $file->id";
        // echo file_get_contents(storage_path() . '/app/' . $file->path);
     
        return response()->file(storage_path() . '/app/' . $file->path);
   
    }

    public function tag($id)
    {
        $file = \Adnotare\File::find($id);
        
        echo "Nume: $file->name <br> Id: $file->id";
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
        $file = \Adnotare\File::find($id);
        \Storage::delete($file->path);
        $file->delete();

        return redirect()->back();
    }

    public function download($id){
        $file = \Adnotare\File::find($id);
        
        return response()->file(storage_path() . '/app/' . $file->path);
    }
}