<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Publication;

class PublicationController extends Controller
{
    // Insert publication
    public function new()
    {
        return view('publication.newPublication');
    }
    // Store publication
    public function store()
    {
        $public = new Publication();
        $public->title = request('Title');
        $public->desc = request('desc1');
        $public->desc2 = request('desc2');
        $public->desc3 = request('desc3');
        $public->desc4 = request('desc4');
        $public->desc5 = request('desc5');

        $public->save();
        return back()->with('success', 'You have successfully sumbitted data');
    }
    // Show publication
    public function index()
    {
        $publication = Publication::all();      
        return view('publication/publicationList', [
            'publication' => $publication
        ]);
    }
    // Show each publication
    public function show($id)
    {
        $publication = Publication::findOrFail($id);      
        return view('publication.eachPublication', [
            'publication' => $publication
        ]);
    }
    // Edit publication page
    public function edit($id)
    {
        $publication = Publication::findOrFail($id);      
        return view('publication.editPublication', [
            'publication' => $publication
        ]);
    }
    // Update publication 
    public function update($id)
    {
        $public = Publication::findOrFail($id);      
        $public->title = request('Title');
        $public->desc = request('desc1');
        $public->desc2 = request('desc2');
        $public->desc3 = request('desc3');
        $public->desc4 = request('desc4');
        $public->desc5 = request('desc5');

        $public->save();
        return redirect('/publication/publicationList');
    }
    public function destroy($id)
    {
        $publication = Publication::findOrFail($id);
        $publication->delete();
        return redirect('publication/publicationList');
    }
    // Search for publication
    public function search(Request $request)
    {   
        if(!empty($request->input('title')))
        {
            $title = $request->get('title');
            $publication = Publication::where('title','LIKE','%'.$title.'%')->paginate(5);
            if(count($publication) > 0)
                return view('/publication/publicationList',['publication' => $publication]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
        if(!empty($request->input('desc1')))
        {
            $desc1 = $request->get('desc1');
            $publication = Publication::where('desc','LIKE','%'.$desc1.'%')->paginate(5);
            if(count($publication) > 0)
                return view('/publication/publicationList',['publication' => $publication]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
        if(!empty($request->input('desc2')))
        {
            $desc2 = $request->get('desc2');
            $publication = Publication::where('desc2','LIKE','%'.$desc2.'%')->paginate(5);
            if(count($publication) > 0)
                return view('/publication/publicationList',['publication' => $publication]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
        else{
            return back()->with('faliure', 'There were no results. please try again');
        }
    }
}
