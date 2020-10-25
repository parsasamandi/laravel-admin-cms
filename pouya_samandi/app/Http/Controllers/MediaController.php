<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Media_text;
use App\Media;
use App\Project;
use App\Description;

class MediaController extends Controller
{
    // Media Page
    public function new()
    {
        $media_text = Media_text::select('mediaText','id')->get();
        $projects = Project::select('name','project_id')->get();
        $description = Description::all();
        return view('media.newMedia',[
            'media_text' => $media_text,
            'projects' => $projects,
            'description' => $description
        ]);
    }
    // Show All Media
    public function index()
    {
        $media = Media::all();
        return view('media/mediaList', [
            'media' => $media,
        ]);
    }

    // Store Media
    public function store(Request $request)
    {

       $validator = $request->validate([
           'youtube_url' => 'required_without:image',
           'descriptionBox' => 'required_without:projectBox',
       ]);

        $media = new Media();
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $file= rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $file);
            $media->media_url = $file;
            $media->type = 0;
        }
        else if(!empty($request->input('youtube_url')))
        {
            $media->type = 1;
            $media->media_url = request('youtube_url');
        }
        if(!(request('descriptionBox') == ''))
        {
            $media->desc_id = request('descriptionBox');
        }
        else if(request('descriptionBox') == '')
        {
            $media->desc_id = null;
        }
        if(!(request('mediaTextBox') == 'mediaText_null'))
        {
            $media->mediaText_id = request('mediaTextBox');
        }
        else if(request('mediaTextBox') == 'mediaText_null')
        {
            $media->mediaText_id = null;
        }

        if(!(request('projectBox') == ''))
        {
            $media->project_id = request('projectBox');
            $media->twoInRow = 1;
        }
        else if(request('projectBox') == '')
        {
            $media->project_id = null;
        }

        $media->save();
        return back()->with('success', 'You have successfully sumbitted data');
    }
    // Each Media
    public function edit($id)
    {
        $media = Media::where('id', $id)->first();
        $media_text = media_text::all();
        $description = Description::select('desc','id')->get();
        $project = Project::select('name','project_id')->get();
        return view('media.editMedia', [
            'media' => $media,
            'media_text' => $media_text,
            'projects' => $project,
            'description' => $description
        ]);
    }
    // Update Media
    public function update($id,Request $request)
    {
        $validator = $request->validate([
            'youtube_url' => 'required_without:image',
            'descriptionBox' => 'required_without:projectBox',
        ]);

        $media = Media::findOrFail($id);
        if($request->hasFile('image'))
        {
            if($media->type == 0)
            {
                $imageDelete = public_path("images/$media->media_url");
                if(File::exists($imageDelete))
                {
                    File::delete($imageDelete); 
                }
            }

            $image = $request->file('image');
            $file= rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $file);
            $media->media_url = $file;
            // Image File
            $media->type = 0;
        }
        else if(!empty($request->input('youtube_url')))
        {
            // Yotube Embeded Link
            $media->type = 1;
            $media->media_url = request('youtube_url');
        }
        if(!(request('descriptionBox') == ''))
        {
            $media->desc_id = request('descriptionBox');
        }
        else if(request('descriptionBox') == '')
        {
            $media->desc_id = null;
        }
        if(!(request('mediaTextBox') == 'mediaText_null'))
        {
            $media->mediaText_id = request('mediaTextBox');
        }
        else if(request('mediaTextBox') == 'mediaText_null')
        {
            $media->mediaText_id = null;
        }
        if(!(request('projectBox') == ''))
        {
            $media->project_id = request('projectBox');
            $media->twoInRow = 1;
        }
        else if(request('projectBox') == '')
        {
            $media->project_id = null;
        }

        

        $media->save();
        return redirect('media/mediaList');
    }
    // Search For Media
    public function search(Request $request)
    {
        if(!empty($request->input('media_url')))
        {
            $media_yi = $request->get('media_yi');
            $media = Media::where('media_url','LIKE','%'.$media_yi.'%');
            if(count($media) > 0)
                return view('/media/mediaList',['media' => $media]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
    }
    // Delete Media
    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        if($media->type == 0)
        {
            $imageDelete = public_path("images/$media->media_url");
            if($imageDelete)
            {
                File::delete($imageDelete); 
            }
        }
        $media->delete();


        return redirect('/media/mediaList');
    }
    
}
