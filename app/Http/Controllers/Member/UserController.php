<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $search = $request->search;
        $data = User::where( function ($query) use ($search){
            if($search){
                $query->where('name', 'like', '%' . $search . '%')->orWhere('email', 'like', '%' . $search . '%');
            }
        })->orderBy('id','asc')->paginate(10)->withQueryString();
        return view('member.user.index', compact('data','search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {  
        $permission = Permission::get();
        return view('member.user.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
        'name' => 'required',
        'email' => 'required|email:dns,rfc|unique:users,email',
        'password' => 'required|min:8|max:20',
        'password_confirmation' => 'same:password'
       ],[
        'name.required' => 'Nama harus di isi',
        'email.required' => 'Email harus di isi',
        'email.email' => 'Format email tidak valid',
        'email.unique' => 'Email sudah terdaftar',
        'password.required' => 'Password harus di isi',
        'password.min' => 'Password minimal 8 karakter',
        'password.max' => 'Password maksimal 20 karakter',
        'password_confirmation.same' => 'Konfirmasi password tidak sesuai'
       ]);

           $email_verified_at = $request->email_verified_at ? Carbon::now() : null;

           $data = [
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => $email_verified_at,
            'password' => bcrypt($request->password),
           ];

           $user = User::create($data);
           $user->syncPermissions($request->permission);

            return redirect()->route('member.user.index')->with('success', 'Data berhasil di tambahkan');


            
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {   
        $permission = Permission::get();
        $userPermission = $user->getPermissionNames()->toArray();

        return view('member.user.edit', compact('user','permission', 'userPermission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns:rfc|unique:users,email,' . $user->id,
            'new_password' => 'nullable|min:6|max:20|same:new_password_confirmation|required_with:new_password_confirmation',
            'new_password_confirmation' => 'required_with:new_password',
        ],[
            'name.required' => 'Name harus di isi',
            'email.required' => 'Email harus di isi',
            'email.email' => 'Email harus di isi dengan format email yang benar',       
            'email.unique' => 'Email sudah terdaftar',
            'new_password.required_with' => 'Password harus di isi',
            'new_password_confirmation.required_with' => 'Konfirmasi Password harus di isi',
            'new_password.same' => 'Password dan konfirmasi password tidak sama',
            'new_password.min' => 'Password harus di isi minimal 6 karakter',
            'new_password.max' => 'Password harus di isi maksimal 20 karakter',
        ]);
            
        $email_verified_at = $user->email_verified_at ? $user->email_verified_at : Carbon::now();
    
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => $email_verified_at,
            'password'=> $request->new_password ? bcrypt($request->new_password) : $user->password,
        ];
        
        User::where('id', $user->id)->update($data);
        
        $user->syncPermissions($request->permission);

        return redirect()->route('member.user.index')->with('success', 'Data berhasil di update');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('member.user.index')->with('success', 'Data berhasil di hapus');
    }

    public function toggleBlock(User $user){

        $pesan = '';
        if($user->blocked_at == null){
            $data = [
                'blocked_at' => now()
            ];
            $pesan = "User " . $user->name . " telah di block";
        }else{
            $data = [
                'blocked_at' => null
            ];
            $pesan = "User " . $user->name . " telah di un-block";
        }

        User::where('id', $user->id)->update($data);

        return redirect()->back()->with('success', $pesan);
    }
}
