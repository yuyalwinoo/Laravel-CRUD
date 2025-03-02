<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }
         $validatedData = $validator->validated();
         $user = User::create($validatedData);
        return redirect()->route('users.index')->with('success', 'User created successfully!');
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
    public function edit($id)
    {
        $user = User::findOrFail($id);
        // dd($user);
        return view('users.create',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => [
                    'required','string','email','max:255',
                    Rule::unique('users', 'email')->ignore($id),
                ]
            ]);
        
            if ($validator->fails()) {
                return redirect()->back()
                                ->withErrors($validator)
                                ->withInput();
            }
        
        $validatedData = $validator->validated();
      
        try{
            $user = User::findOrFail($id);
            $user->update($validatedData);
            return redirect()->route('users.index')->with('success', 'User updated successfully!');

        }catch (ModelNotFoundException $e) {

            return redirect()->route('users.index')->withErrors('errors', 'Data not found');
        }catch (\Exception $e) {

            return redirect()->route('users.index')->withErrors('errors', $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $user = User::findOrFail($id);
            $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
        }catch(\Exception $e){
            dd($e);
        }
    }

    // Login

    public function loginIndex()
    {
        return view('users.login');
    }

    public function login(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'email' => ['required','string','email','max:255'],
            'password' =>'required'
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }
    
        $validatedData = $validator->validated();
        
        $token = null;
        //dd($validatedData['email']);
        $user = User::where('email', $validatedData['email'])->firstOrFail();
        
        if($user && Hash::check($validatedData['password'], $user->password)) {
            $token = $user->createToken('user')->plainTextToken;
   
            return redirect()->route('posts.index');
        }else{
            return redirect()->route('users.login-index')->withErrors(['errors' => 'Provide a valid user.']);
        }
        
    }
}
