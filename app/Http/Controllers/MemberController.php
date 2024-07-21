<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $members = Member::all();
        return view('dashboard.members.index', [
            'members' => $members,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'userName' => 'required|unique:members,userName',
            'fullName' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $member = new Member();
        $member->userName = $request->userName;
        $member->fullName = $request->fullName;
        $member->role = $request->role;

        $member->password = Hash::make($request->password);

        if ($request->isActive != null) {
            $member->isActive = 1;
        }else{
            $member->isActive = 0;
        }

        $member->save();
        return redirect()->route('member.index')->with('success', 'member added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        return view('dashboard.members.show',[
            'member' => $member,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
        return view('dashboard.members.edit',[
            "member" => $member,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        //
    }


    public function isActive(Member $member)
    {
        if($member->isActive == 0){
            $member->isActive = 1;
        }
        else{
            $member->isActive = 0;
        }

        $member->save();
        return redirect()->route('member.index')
                        ->with('success','Member Active Status Changed successfully');
    }


    public function verifyLogin(Request $request) {
        $request->validate([
            'userName' => 'required',
            'password' => 'required',
        ]);

        $loginUser = Member::where("userName", "=", $request->userName)->where("isActive" , "=", 1)->first();

        if($loginUser){
            if (Hash::check($request->password, $loginUser->password)) {

                Session::put('userId', $loginUser->id);
                Session::put('fullName', $loginUser->fullName);
                Session::put('role', $loginUser->role);

                return redirect()->route('product.index');
            }
            else {
                return redirect()->back()->with("failed", "Login Failed");
            }
        }
        else {
            return redirect()->back()->with("failed", "Login Failed");
        }

    }

    public function logout() {
        Session::flush();

        return redirect()->route('login')->with("logout", "You logged out, Good bye !!!");
    }
}
