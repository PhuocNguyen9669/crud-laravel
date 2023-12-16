<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    protected $user;
    public function __construct(User $user){
        $this->user =$user;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->user->latest('id')->paginate(5);
        return view('users.index', compact('users'));
   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $dataCreateUser = $request->all();
        $user = $this->user->create($dataCreateUser);

        return redirect()->route('users.index')->with(['message' => "Create $user->name successfully!"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = $this->user->findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = $this->user->findOrFail($id);
        $dataUserUpdate = $request->except('password');
        if($request->password){
            $dataUserUpdate['password'] = Hash::make($request->password);
        } 
        $user->update($dataUserUpdate);

        return redirect()->route('users.index')->with(['message' => 'Update user successfully!']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->user->findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with(['message' => "Deleted user successfully"]);
    }
}
