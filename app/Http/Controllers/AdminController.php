<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Book;
use App\Models\Franchise;
use App\Models\ImageGallery;
use App\Models\VideoGallery;
use DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function dashboard()
    {
        $data['data'] = array();
        return view('admin.dashboard', $data);
    }
    public function book()
    {
        $data['book'] = Book::get();
        return view('admin.book', $data);
    }
    public function franchise()
    {
        $data['franchise'] = Franchise::get();
        return view('admin.franchise', $data);
    }
    public function ImageGallery()
    {
        $data['gallery'] = ImageGallery::get();
        return view('admin.imagegallery', $data);
    }
    public function VideoGallery()
    {
        $data['gallery'] = VideoGallery::get();
        return view('admin.videogallery', $data);
    }
    public function add_image()
    {
        return view('admin.addimage');
    }
   public function updateimage($id)
    {
        $data['image'] = ImageGallery::find($id); // Fetch the image by ID
        if (!$data['image']) {
            return redirect()->back()->with('error', 'Image not found.');
        }
        return view('admin.updateimage', $data);
    }
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Multiple images validation
        ]);
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension(); // Unique name for each image
                $file->move(public_path('imagegallery'), $filename); // Save to the public/imagegallery folder
                
                // Save in the database
                ImageGallery::create([
                    'image' => $filename,
                ]);
            }
        }
    
        return redirect()->route('admin.imagegallery')->with('success', 'Images uploaded successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Only accept images with a size limit of 2MB
        ]);
    
        $gallery = ImageGallery::findOrFail($id);
    
        // Delete the old image from the directory
        if (file_exists(public_path('imagegallery/' . $gallery->image))) {
            unlink(public_path('imagegallery/' . $gallery->image));
        }
    
        // Generate a new custom name for the image
        $imageName = 'gallery_' . time() . '.' . $request->image->extension();
    
        // Move the new image to the directory
        $request->image->move(public_path('imagegallery'), $imageName);
    
        // Update the database record
        $gallery->update([
            'image' => $imageName,
        ]);
    
        return back()->with('success', 'Image updated successfully!');
    }
    public function delete($id)
    {
        $gallery = ImageGallery::findOrFail($id);
    
        if (file_exists(public_path('imagegallery/' . $gallery->image))) {
            unlink(public_path('imagegallery/' . $gallery->image));
        }
    
        $gallery->delete();
    
        return back()->with('success', 'Image deleted successfully!');
    }
    public function addVideo()
    {
        return view('admin.add_video');
    }
    
    public function storeVideo(Request $request)
    {
        // Validate the request inputs
        $request->validate([
            'type' => 'required|in:youtube,upload',
            'video' => $request->type == 'youtube' 
                ? 'required|url' 
                : 'required|mimes:mp4,avi,mkv|max:20480',
        ]);
    
        // Initialize the video URL
        $url = '';
    
        // Check if the type is 'upload'
        if ($request->type == 'upload') {
            $file = $request->file('video');
    
            // Generate a unique name for the video
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
    
            // Move the video file to the desired location
            $file->move(public_path('videogallery'), $fileName);
    
            // Set the URL for the saved video
            $url = $fileName;
        } else {
            // For YouTube, simply store the provided URL
            $url = $request->video;
        }
    
        // Save the video details to the database
        VideoGallery::create([
            'type' => $request->type,
            'video' => $url,
        ]);
    
        return redirect()->route('admin.VideoGallery')->with('success', 'Video added successfully');
    }

    public function editVideo($id)
    {
        $video = VideoGallery::findOrFail($id);
        return view('admin.edit_video', compact('video'));
    }
    
   public function updateVideo(Request $request, $id)
    {
        // Validate the inputs
        $request->validate([
            'type' => 'required|in:youtube,upload',
            'video' => $request->type == 'youtube' 
                ? 'required|url' 
                : 'nullable|mimes:mp4,avi,mkv|max:20480', // Video is optional in case only type changes
        ]);
    
        // Find the video record by ID
        $video = VideoGallery::findOrFail($id);
    
        // Initialize video URL
        $url = $video->video;
    
        // Handle file upload if type is 'upload' and a new file is provided
        if ($request->type == 'upload' && $request->hasFile('video')) {
            $file = $request->file('video');
    
            // Generate unique name for the video
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
    
            // Move the video file to the desired location
            $file->move(public_path('videogallery'), $fileName);
    
            // Delete the old video file if it exists and is not a YouTube URL
            if ($video->type == 'upload' && file_exists(public_path($video->video))) {
                unlink(public_path($video->video));
            }
    
            // Set the new video URL
            $url = $fileName;
        } elseif ($request->type == 'youtube') {
            // Update the URL for YouTube type
            $url = $request->video;
        }
    
        // Update the video record
        $video->update([
            'type' => $request->type,
            'video' => $url,
        ]);
    
        return redirect()->route('admin.VideoGallery')->with('success', 'Video updated successfully');
    }
    public function deleteVideo($id)
    {
        $video = VideoGallery::findOrFail($id);
    
        if ($video->type == 'upload') {
            $filePath = public_path('videogallery/' . $video->video); // Construct full file path
        
            if (file_exists($filePath)) { // Check if the file exists
                unlink($filePath); // Delete the file
            }
        }
    
        $video->delete();
    
        return redirect()->route('admin.VideoGallery')->with('success', 'Video deleted successfully');
    }
    


}

