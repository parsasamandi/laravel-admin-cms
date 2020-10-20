<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Media_text;
use App\Media;

class MediaTextController extends Controller
{
    // Media Text Page
    public function new()
    {
        $media = Media::select('media_url')->get();
        return view('media.newMediaText', ['media' => $media]);
    }
    // Store Media Text
    public function store()
    {
        $media_text = new Media_text();
        $media_text->mediaText = request('media_text');

        $media_text->save();
        return back()->with('success', 'You have successfully sumbitted data'); 
    }

    // Media Text List
    public function index()
    {
        $mediaText = Media_text::all();
        return view('media/mediaTextList', [
            'mediaText' => $mediaText
        ]);
    }

    // Edit Media Text Page
    public function edit($id)
    {
        $mediaText = Media_text::where('id', $id)->first();
        return view('media/editMediaText',[
            'mediaText' => $mediaText
        ]);
    }
    // Update Media Text
    public function update($id)
    {
        $mediaText = Media_text::where('id', $id)->update(array(
            'mediaText' => request('media_text')
        ));

        return redirect('media/mediaTextList');
    }

    // Delete Media Text
    public function destroyMediaText($id)
    {
        $media = Media_text::where('id', $id);
        $media->delete();

        return redirect('media/mediaTextList');
    }
    // Search For Media
    public function search(Request $request)
    {
        if(!empty($request->input('media_text')))
        {
            $media_text = $request->get('media_text');
            $media = Media_text::where('mediaText','LIKE','%'.$media_text.'%')->paginate(5);
            if(count($media) > 0)
                return view('/media/mediaTextList',['mediaText' => $media]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
    }
    
}
