<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\SlugHelper;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of blogs in admin.
     */
    public function index()
    {
        $blogs = Blog::orderBy('id', 'DESC')->get();
        return view('admin.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new blog.
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created blog in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'content'   => 'required',
            'category'  => 'nullable|string|max:100',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_active' => 'required|boolean',
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slug = SlugHelper::generateUniqueSlug(Blog::class, $request->title);
        $blog->category = $request->category;
        $blog->content = $request->content;
        $blog->is_active = (bool) $request->is_active;
        $blog->published_at = $request->published_at ? Carbon::parse($request->published_at) : now();

        if ($request->hasFile('image')) {
            $uploadDir = public_path('uploads/blogs');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $file = $request->file('image');
            $fileName = time() . '_' . SlugHelper::imageSlugName($file);
            $file->move($uploadDir, $fileName);
            $blog->image = 'uploads/blogs/' . $fileName;
        }

        $blog->save();

        return redirect()->route('admin.blog.index')->with('success', 'Blog yazısı başarıyla oluşturuldu.');
    }

    /**
     * Show the form for editing the specified blog.
     */
    public function edit(string $id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blog.edit', compact('blog'));
    }

    /**
     * Update the specified blog in storage.
     */
    public function update(Request $request, string $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'title'     => 'required|string|max:255',
            'content'   => 'required',
            'category'  => 'nullable|string|max:100',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_active' => 'required|boolean',
        ]);

        if ($blog->title !== $request->title) {
            $blog->slug = SlugHelper::generateUniqueSlug(Blog::class, $request->title);
        }

        $blog->title = $request->title;
        $blog->category = $request->category;
        $blog->content = $request->content;
        $blog->is_active = (bool) $request->is_active;

        if ($request->filled('published_at')) {
            $blog->published_at = Carbon::parse($request->published_at);
        }

        if ($request->hasFile('image')) {
            $uploadDir = public_path('uploads/blogs');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            if ($blog->image && file_exists(public_path($blog->image)) && str_starts_with($blog->image, 'uploads/blogs/')) {
                @unlink(public_path($blog->image));
            }

            $file = $request->file('image');
            $fileName = time() . '_' . SlugHelper::imageSlugName($file);
            $file->move($uploadDir, $fileName);
            $blog->image = 'uploads/blogs/' . $fileName;
        } elseif ($request->input('remove_image') === '1') {
            if ($blog->image && file_exists(public_path($blog->image)) && str_starts_with($blog->image, 'uploads/blogs/')) {
                @unlink(public_path($blog->image));
            }
            $blog->image = null;
        }

        $blog->save();

        return redirect()->route('admin.blog.index')->with('success', 'Blog yazısı başarıyla güncellendi.');
    }

    /**
     * Remove the specified blog from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->image && file_exists(public_path($blog->image)) && str_starts_with($blog->image, 'uploads/blogs/')) {
            @unlink(public_path($blog->image));
        }

        $deleted = $blog->delete();

        if ($deleted) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Blog yazısı başarıyla silindi!',
            ]);
        }

        return response()->json([
            'status'  => 'error',
            'message' => 'Kayıt silinemedi!',
        ]);
    }
}
