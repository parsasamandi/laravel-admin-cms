<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Refree;
use App\Models\Experience;

class RefreeController extends Controller
{
    // new Refree Page
    public function new()
    {
        return view('refree.newRefree');
    }
    // store new Refree
    public function store(REquest $request)
    {
        $refree = new Refree();
        $refree->name = request('name');
        $refree->desc = request('desc');
        $refree->link = request('link');
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $file= rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $file);
            $refree->image = $file;
        }

        $refree->save();
        return back()->with('success', 'You have successfully sumbitted data');
    }

    // Show Refree
    public function index(REquest $request)
    {
        $refree = Refree::all();
        return view('refree/refreeList', [
            'refree' => $refree
        ]);
    }

    // Delete Refree
    public function destroy($id)
    {
        $refree = Refree::findOrFail($id);
        
        $imageDelete = public_path("images/$refree->image");
        if(File::exists($imageDelete))
        {
            File::delete($imageDelete); 
        }

        $refree->delete();
        return redirect('refree/refreeList');
    }

    // Show refree
    public function show($id)
    {
        $refree = Refree::findOrFail($id);
        return view('refree.eachRefree', ['eachRefree' => $refree]);
    }

    // Edit refree
    public function edit($id)
    {
        $refree = Refree::findOrFail($id);
        return view('refree.editRefree', ['eachRefree' => $refree]);
    }

    // Update refree
    public function update($id,Request $request)
    {
        $refree = Refree::findOrFail($id);
        $refree->name = request('name');
        $refree->desc = request('desc');
        $refree->link = request('link');
        if($request->hasFile('image'))
        {
            $imageDelete = public_path("images/$refree->image"); // get previous image from folder
            if(File::exists($imageDelete)) { // unlink or remove previous image from folder
                File::delete($imageDelete); 
            }
            $image = $request->file('image');
            $file= rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $file);
            $refree->image = $file;
        }

        $refree->save();
        return redirect('refree/refreeList');
    }
  
    
    
}
