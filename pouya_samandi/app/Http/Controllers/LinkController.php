<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Link;
use App\Description;

class LinkController extends Controller
{
    // New Link Page
    public function new()
    {
        $desc = Description::all();
        return view('link.newLink',[
            'desc' => $desc
        ]);
    }
    // Stroing Link
    public function store()
    {
        $link = new Link();
        $link->text = request('text');
        $link->link = request('link');

        $link->desc_id = request('descriptionBox');

        $link->save();
        return back()->with('success', 'You have successfully sumbitted data'); 
    }
    // Storing Link
    public function index()
    {
        $link = Link::all();
        return view('link/linkList', [
            'link' => $link
        ]);
    }
    // Edit Link Page
    public function edit($id)
    {
        $desc = Description::all();
        $link = Link::where('id', $id)->first();
        return view('link/editLink', [
            'link' => $link,
            'desc' => $desc,
        ]);
    }

    // Edit Link Page
    public function update($id)
    {
        Link::where('id', $id)->update(array(
            'text' => request('text'),
            'link' => request('link'),
            'desc_id' => request('descriptionBox')
        ));

        return redirect('link/linkList');
    }

    // Delete Link
    public function destroy($id)
    {
        $link = Link::where('id', $id);
        $link->delete();

        return redirect('link/linkList');
    }

    // Search For Link
    public function search(Request $request)
    {
        if(!empty($request->input('link')))
        {
            $link_column = $request->get('link');
            $link = Link::where('link','LIKE','%'.$link_column.'%')->paginate(5);
            if(count($link) > 0)
                return view('/link/linkList',['link' => $link]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
        if(!empty($request->input('text')))
        {
            $text = $request->get('text');
            $link = Link::where('text','LIKE','%'.$text.'%')->paginate(5);
            if(count($link) > 0)
                return view('/link/linkList',['link' => $link]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
    }

    
}
