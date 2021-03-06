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

            $tags = \Adnotare\Tag::where('tag', 'LIKE', '%' . $request['q'] . '%')->get();
            if(count($tags) != 0){
                foreach ($tags as $tag) {
                    $idArray[] = $tag->file_id;
                }
            }

            foreach ($files as $file) {
                if (strpos($file->name, $request['q']) !== false) {
                    $idArray[] = $file->id;
                    //break;
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

        $tags = explode(",", $request['tags']);
        foreach ($tags as $tag) {
            $t = new \Adnotare\Tag;
            $t->file_id = $file->id;
            $t->tag = $tag;
            $t->save();
        }

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

        $fileContent = file_get_contents(storage_path() . '/app/' . $file->path);
            //$fileContent = preg_replace('/(\w+)/i', '<wordtag>$1<wordtag>', $fileContent);
            $fileContent = preg_replace('/(\w+)/u', '<wordtag>$1<wordtag>', $fileContent);
        $author = $file->user->name;

        // echo $file->rank;
        // echo '<br>';
        // //echo "Nume: $file->name <br> Id: $file->id";
        // echo file_get_contents(storage_path() . '/app/' . $file->path);
     
        //return response()->file(storage_path() . '/app/' . $file->path);
        return view('files.show', compact("file", 'fileContent', 'author'));
   
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
     // public function detail($id){
     //   $file = \Adnotare\File::find($id);
        
     //     return response()->file(storage_path() . '/app/' . $file->path);
     //   // return view('files.show', compact("file", 'fileContent', 'author'));
     //   }

    public function getComments(Request $request)
    {
        $comments = \Adnotare\Comment::where('file_id', $request['file_id'])->where('word_id', $request['word_id'])->get();

        return $comments->toJson();
    }

    public function getCommentsIds(Request $request)
    {
        $comments = \Adnotare\Comment::where('file_id', $request['file_id'])->distinct('word_id')->pluck('word_id')->toJson();

        return $comments;
    }
}
