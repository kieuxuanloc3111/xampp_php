<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        $countries = Country::all();

        return view('admin.profile', compact('user', 'countries'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();

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

        $user->update($data);

        return redirect()->route('admin.profile');
    }
}
