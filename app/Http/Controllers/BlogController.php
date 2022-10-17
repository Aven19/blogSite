<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    const ROUTE_VIEW_PATH = 'cms/blog';
    const DESTINATION_FOLDER = 'blog-image/';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $blogs = Blog::where('created_by', auth()->id())->with([
            'author' => function ($q) {
                $q->select(['id', 'first_name', 'last_name']);
            }
        ])
            ->searchByRouteName(
                $request->input('q'),
                $request->input('id')
            )->orderBy('id', 'desc')->paginate(10);

        return view(self::ROUTE_VIEW_PATH . '.index', compact('blogs'));
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
        $route = Str::slug($request->input('title'));

        $validatedData = $request->validate([
            'title' => 'required|unique:blogs|min:2|max:255',
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
        $blog->route = $route;
        $blog->description = $request->input('description');
        $blog->file = $request->hasFile('file') != null ? $uniqueName : null;
        $blog->created_by = auth()->id();

        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Page has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);

        return view(self::ROUTE_VIEW_PATH . '.show', compact('blog'));
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
        $route = Str::slug($request->input('title'));

        $validatedData = $request->validate([
            'title' => 'required|unique:blogs,title,'.$id,
            'description' => 'required',
        ]);

        $blog = Blog::findOrFail($id);

        $uniqueName = $blog->file;

        if ($request->file('file') != null) {
            //get filename with extension
            $fileNameWithExtension = $request->file->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);

            //get file extension
            $extension = strtolower(pathinfo($fileNameWithExtension, PATHINFO_EXTENSION));

            $uniqueName = Str::slug($filename) . "-" . uniqid() . "." . $extension;

            if (Storage::disk(disk_type())->exists(self::DESTINATION_FOLDER . $blog->file)) {
                Storage::disk(disk_type())->delete(self::DESTINATION_FOLDER . $blog->file);
            }

            $uploadedFile = $request->file('file');

            Storage::disk(disk_type())->putFileAs(
                self::DESTINATION_FOLDER,
                $uploadedFile,
                $uniqueName,
                'public'
            );
        }

        $blog->update([
            'title' => $request->input('title'),
            'route' => $route,
            'description' => $request->input('description'),
            'file' => $uniqueName
        ]);

        return redirect()->route('blogs.index', ['content_type' => $blog->content_type, 'q' => $blog->route, 'id' => $blog->id])
            ->with('success', 'Blog has been updated successfully.');
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
        $blogs = Blog::with([
            'author' => function ($q) {
                $q->select(['id', 'first_name', 'last_name']);
            }
        ])->orderBy('id', 'desc')->paginate(10);

        return view('blog', compact('blogs'));
    }
}
