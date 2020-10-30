<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Interest;

class InterestController extends Controller
{
    // Interest Page
    public function new()
    {
        return view("interest.newInterest");
    }
    // Store Interest
    public function store(Request $request)
    {
        $interest = new Interest();
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $file= rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $file);
            $interest->image = $file;
        }

        if($request->hasFile('image2'))
        {
            $image2 = $request->file('image2');
            $file2= rand() . '.' . $image2->getClientOriginalExtension();
            $image2->move(public_path('images'), $file2);
            $interest->image2 = $file2;
        }

        if($request->hasFile('image3'))
        {
            $image3 = $request->file('image3');
            $file3 = rand() . '.' . $image3->getClientOriginalExtension();
            $image3->move(public_path('images'), $file3);
            $interest->image3 = $file3;
        }

        $interest->desc = request('desc');
        $interest->desc2 = request('desc2');
        $interest->desc3 = request('desc3');
        $interest->desc4 = request('desc4');

        $interest->save();
        return back()->with('success', 'You have successfully sumbitted data');
    }
    // Interest Page
    public function index()
    {
        $interest = Interest::all();      
        return view('interest/interestList', [
            'interest' => $interest
        ]);
    }
    // Delete interest
    public function destroy($id)
    {
        $interest = Interest::findOrFail($id);

        $imageDelete = public_path("images/$interest->image");
        if(File::exists($imageDelete))
        {
            File::delete($imageDelete); 
        }

        $imageDelete2 = public_path("images/$interest->image2");
        if(File::exists($imageDelete2))
        {
            File::delete($imageDelete); 
        }

        $imageDelete3 = public_path("images/$interest->image3");
        if(File::exists($imageDelete3))
        {
            File::delete($imageDelete); 
        }

        $imageDelete4 = public_path("images/$interest->image4");
        if(File::exists($imageDelete4))
        {
            File::delete($imageDelete); 
        }

        $interest->delete();
        return redirect('interest/interestList');
    }

    // Delete interest
    public function edit($id)
    {
        $interest = Interest::findOrFail($id);
        return view('interest/editInterest', [
            'interest' => $interest
        ]);
    }

    // Update interest
    public function update($id,Request $request)
    {
        $interest = Interest::findOrFail($id);
        if($request->hasFile('image'))
        {
            $imageDelete = public_path("images/$interest->image");
            if(File::exists($imageDelete))
            {
                File::delete($imageDelete); 

            }

            $image = $request->file('image');
            $file= rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $file);
            $interest->image = $file;
        }

        if($request->hasFile('image2'))
        {
            $imageDelete2 = public_path("images/$interest->image2"); // get previous image from folder
            if(File::exists($imageDelete2)) { // unlink or remove previous image from folder
                unlink($imageDelete2);
            }

            $image2 = $request->file('image2');
            $file2= rand() . '.' . $image2->getClientOriginalExtension();
            $image2->move(public_path('images'), $file2);
            $interest->image2 = $file2;
            
        }

        if($request->hasFile('image3'))
        {
            $imageDelete3 = public_path("images/$interest->image3"); // get previous image from folder
            if(File::exists($imageDelete3)) { // unlink or remove previous image from folder
                unlink($imageDelete3);
            }

            $image3 = $request->file('image3');
            $file3 = rand() . '.' . $image3->getClientOriginalExtension();
            $image3->move(public_path('images'), $file3);
            $interest->image3 = $file3;
        }

        $interest->desc = request('desc');
        $interest->desc2 = request('desc2');
        $interest->desc3 = request('desc3');
        $interest->desc4 = request('desc4');
        $interest->save();
        return back()->with('success', 'You have successfully sumbitted data');
    }

    // Show each interest
    public function show($id)
    {
        $eachInterest = Interest::findOrFail($id);
        return view('interest.eachInterest', ['eachInterest' => $eachInterest]);
    }
    
    // Serach for Interest Table
    public function search(Request $request)
    {
        if(!empty($request->input('desc')))
        {
            $desc = $request->get('desc');
            $interest = Interest::where('desc','LIKE','%'.$desc.'%')->paginate(5);
            if(count($interest) > 0)
                return view('/interest/interestList',['interest' => $interest]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
        if(!empty($request->input('desc2')))
        {
            $desc2 = $request->get('desc2');
            $interest = Interest::where('desc2','LIKE','%'.$desc2.'%')->paginate(5);
            if(count($interest) > 0)
                return view('/interest/interestList',['interest' => $interest]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
        if(!empty($request->input('desc3')))
        {
            $desc3 = $request->get('desc3');
            $interest = Interest::where('desc3','LIKE','%'.$desc3.'%')->paginate(5);
            if(count($interest) > 0)
                return view('/interest/interestList',['interest' => $interest]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
        else{
            return back()->with('faliure', 'There were no results. please try again');
        }
    }
    
}
