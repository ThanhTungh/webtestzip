<?php

namespace App\Http\Controllers\MarketingCoordinator;

use App\Models\Comment;
use ZipArchive;
use App\Models\Idea;
use App\Models\Faculty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CoordinatorController extends Controller
{
    // Login view
    public function login_view()
    {
        return view('coordinator.auth.login');
    }

    // Login submit
    public function login_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required|min:6',
        ]);

        $credenticals = [
            "email" => $request->email,
            "password" => $request->password,
        ];


        if (Auth::guard('coordinator')->attempt($credenticals)) {
            return redirect()->route('coordinator_home');
        } else {
            return redirect()->route('coordinator_login')->with('error', 'Information is not correct');
        }
    }

    // Logout
    public function logout()
    {
        Auth::guard('coordinator')->logout();
        return redirect()->route('coordinator_login');
    }

    // Homepage
    public function home()
    {
        return view('coordinator.Website.home');
    }

    // Profile view
    public function profile()
    {
        return view('coordinator.Website.profile');
    }

    // List faculties view
    public function list_faculties()
    {
        $faculties = Faculty::where('coordinator_id', Auth::guard('coordinator')->user()->id)->get();
        return view('coordinator.Website.list_faculties', compact('faculties'));
    }

    // List ideas view
    public function list_ideas($id)
    {
        $single_faculty = Faculty::where('id', $id)->first();
        return view('coordinator.Website.list_ideas', compact('single_faculty'));
    }

    // Download file (Docx, image)
    public function download_file($file)
    {
        $filePath = public_path('/storage/files/' . $file);

        // Check if the file exists
        if (file_exists($filePath)) {
            // Get the mime type of the file
            $mimeType = mime_content_type($filePath);

            // Set appropriate headers for image files
            if (str_starts_with($mimeType, 'image/')) {
                // Serve the image file directly
                return response()->stream(function () use ($filePath) {
                    readfile($filePath);
                }, 200, ['Content-Type' => $mimeType]);
            } else {
                // For other file types, force download
                return response()->download($filePath);
            }
        } else {
            // File not found
            abort(404, 'The requested file does not exist.');
        }
    }


    // Download file (Zip)
    // public function download_file($file)
    // {
    //     try
    //     {
    //         $zip = new ZipArchive();
    //         $fileName = 'mananger' . '.zip';

    //         if ($zip->open($fileName, ZipArchive::CREATE)) {
    //             $multi_files = File::files(public_path('/storage/files'));
    //             foreach ($multi_files as $files) 
    //             {
    //                 // $single_file = public_path("/storage/files/" . $file);
    //                 $nameInZipFile = basename($files);
    //                 $zip->addFile($files, $nameInZipFile);
    //             }

    //         }
    //         $zip->close();
    //         return response()->download($fileName);
    //         // return Storage::download($fileName);
    //     }
    //     catch (\Exception $e)
    //     {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }

    //     // $zipFileName = 'chayde_' . now()->format('YmdHis') . '.zip';
    //     // $zipFilePath = public_path($zipFileName);

    //     // // Khởi tạo đối tượng ZipArchive
    //     // $zip = new ZipArchive();
    //     // if ($zip->open($zipFilePath, ZipArchive::CREATE) === true) {
    //     //     // Thêm các tệp đã tải lên vào tập tin ZIP
    //     //     $fileNames = explode(',', $file);
    //     //     foreach ($fileNames as $fileName) {
    //     //         $filePath = public_path('storage/files/' . $fileName);
    //     //         if (File::exists($filePath)) {
    //     //             $zip->addFile($filePath, $fileName);
    //     //         }
    //     //     }
    //     //     $zip->close();
    //     // }
    //     // return response()->download($zipFilePath, $zipFileName)->deleteFileAfterSend(true);
    // }

    // Comment submit
    public function comment_submit(Request $request, $id)
    {
        $request->validate([
            'content' => 'nullable'
        ]);
        $current_idea = Idea::where('id', $id)->first();
        $check_comment = Comment::where('idea_id', $id)->first();

        if ($current_idea) {
            if ($check_comment) {
                $check_comment->content = $request->content;
                $check_comment->idea_id = $current_idea->id;
                $check_comment->coordinator_id = Auth::guard('coordinator')->user()->id;
                $check_comment->update();

                return redirect()->route('coordinator_list_ideas', $current_idea->faculty_id)->with('success', 'Updated a comment successfully!');
            }
            $comment = new Comment;
            $comment->content = $request->content;
            $comment->idea_id = $current_idea->id;
            $comment->coordinator_id = Auth::guard('coordinator')->user()->id;
            $comment->save();

            return redirect()->route('coordinator_list_ideas', $current_idea->faculty_id)->with('success', 'Added a comment successfully!');
        }
    }

    // List outstanding ideas view
    public function list_outstanding_ideas()
    {
        $ideas = Idea::where('status', 1)->get();
        return view('coordinator.Website.list_outstanding_ideas', compact('ideas'));
    }

    // Choose typical idea submit
    public function choose_typical_idea($id)
    {
        $idea = Idea::where('id', $id)->first();
        if ($idea->status == 0) {
            $idea->status = 1;
            $idea->update();
        } else {
            return redirect()->back()->with('error', 'This idea is already in the featured ideas section!');
        }
        return redirect()->back()->with('success', 'This idea has been added to the list of featured ideas!');
    }

    // Remove typical idea submit
    public function remove_typical_idea($id)
    {
        $idea = Idea::where('id', $id)->first();
        if ($idea->status == 1) {
            $idea->status = 0;
            $idea->update();
        }
        return redirect()->back()->with('success', 'This idea has been removed from the list of featured ideas!');
    }
}
