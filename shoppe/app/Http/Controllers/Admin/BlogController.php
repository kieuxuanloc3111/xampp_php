<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = DB::table('blogs')->get();

        return view('admin.blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        DB::table('blogs')->insert([
            'title'       => $request->title,
            'image'       => $request->image,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.blog.index');
    }

    public function edit($id)
    {
        $blog = DB::table('blogs')->where('id', $id)->first();

        return view('admin.blog.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        DB::table('blogs')
            ->where('id', $id)
            ->update([
                'title'       => $request->title,
                'image'       => $request->image,
                'description' => $request->description,
            ]);

        return redirect()->route('admin.blog.index');
    }

    public function destroy($id)
    {
        DB::table('blogs')->where('id', $id)->delete();

        return redirect()->route('admin.blog.index');
    }
}
