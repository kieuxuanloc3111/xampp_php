<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User; // QUAN TRỌNG
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        $countries = DB::table('countries')->get();

        return view('admin.profile', compact('user', 'countries'));
    }
    public function update(UpdateProfileRequest $request)
    {
        $data = [
            'name'       => $request->name,
            'phone'      => $request->phone,
            'address'    => $request->address,
            'id_country' => $request->id_country,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
            $fileName = time() . '_' . $request->avatar->getClientOriginalName();
            $request->avatar->move(public_path('uploads/avatars'), $fileName);

            $data['avatar'] = 'uploads/avatars/' . $fileName;
        }

        DB::table('users')
            ->where('id', Auth::id())
            ->update($data);

        return redirect()->route('admin.profile');
    }

}