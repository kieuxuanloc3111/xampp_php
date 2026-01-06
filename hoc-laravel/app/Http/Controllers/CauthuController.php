<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCauthuRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cauthu;
use App\Http\Requests\UpdateCauthuRequest;

class CauthuController extends Controller
{
    public function index()
    {
        $cauthu = Cauthu::orderBy('id', 'desc')->get();

        return view('cauthu.index', compact('cauthu'));
    }

    public function create()
    {
        return view('cauthu.create');
    }

    public function store(StoreCauthuRequest $request)
    {
        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/cauthu'), $imageName);
        }

        Cauthu::create([
            'name'   => $request->name,
            'age'    => $request->age,
            'salary' => $request->salary,
            'image'  => $imageName,
        ]);

        return redirect('/cauthu');
    }


    public function edit($id)
    {
        $cauthu = Cauthu::find($id);

        return view('cauthu.edit', compact('cauthu'));
    }

    public function update(UpdateCauthuRequest $request, $id)
    {
        $cauthu = Cauthu::findOrFail($id);

        $imageName = $cauthu->image;

        if ($request->hasFile('image')) {
            $imageName = time().'_'.$request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/cauthu'), $imageName);
        }

        $cauthu->update([
            'name'   => $request->name,
            'age'    => $request->age,
            'salary' => $request->salary,
            'image'  => $imageName,
        ]);

        return redirect('/cauthu');
    }


    public function destroy($id)
    {
        Cauthu::find($id)->delete();

        return redirect('/cauthu');
    }
}
