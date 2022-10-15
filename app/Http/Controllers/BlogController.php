<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    const ROUTE_VIEW_PATH = 'blogs';
    const DESTINATION_FOLDER = 'blog-image/';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $blog = Blog::searchByRouteName(
            $request->input('q'),
            $request->input('id')
        )->filterByContentType(
            $request->input('content_type')
        )->orderBy('id', 'desc')->paginate(10);

        return view(self::ROUTE_VIEW_PATH . '.index', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(self::ROUTE_VIEW_PATH . '.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $route = $request->input('route');

        $validatedData = $request->validate([
            'title' => 'required|min:2|max:255',
            'description' => 'required',
            'file' => 'required',
        ]);

        if ($request->hasFile('file')) {
            //get filename with extension
            $fileNameWithExtension = $request->file->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);

            //get file extension
            $extension = strtolower(pathinfo($fileNameWithExtension, PATHINFO_EXTENSION));

            $uniqueName = Str::slug($filename) . "-" . uniqid() . "." . $extension;

            $uploadedFile = $request->file('file');

            Storage::disk(disk_type())->putFileAs(
                self::DESTINATION_FOLDER,
                $uploadedFile,
                $uniqueName,
                'public'
            );
        }

        $blog = new Blog;
        $blog->title = $request->input('title');
        $blog->route = $request->input('route');
        $blog->description = $request->input('description');
        $blog->file = $request->hasFile('file') != null ? $uniqueName : null;
        $blog->created_by = auth()->id();
        $blog->status = $request->input('status');

        $blog->save();

        return redirect()->route('custom-pages.index')->with('success', 'Page has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('blog');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view(self::ROUTE_VIEW_PATH . '.edit', compact('blog'));
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
        $blog = Blog::findOrFail($id);

        if ($blog->forceDelete()) {

            if (Storage::disk(disk_type())->exists(self::DESTINATION_FOLDER . $blog->file)) {
                Storage::disk(disk_type())->delete(self::DESTINATION_FOLDER . $blog->file);
            }

            return redirect()->back()->withSuccess('Page has been deleted successfully');
        }

        return redirect()->back()->withError('Something went wrong, Please try again.');
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBlogs(Request $request)
    {
        $blogs = Blog::orderBy('id', 'desc')->paginate(10);

        return view('blog', compact('blogs'));
    }
}
