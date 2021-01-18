<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileGameUpdateRequest;
use App\Models\Profilegame;
use Illuminate\Http\Request;

use App\Traits\HasRolesAndPermissionsTrait;
use App\Traits\InputValidateTrait;
use App\Traits\UploadTrait;
use Illuminate\Http\RedirectResponse;

class ProfileGameController extends Controller
{
    use UploadTrait, InputValidateTrait, HasRolesAndPermissionsTrait;
    
    /**
     * Authenticate via middleware
     */
    public function __construct()
    {
        $this->middleware('verified');
    }
    
    /**
     * View profile view
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $user = Auth()->user();
        $profileGames = Profilegame::get();
        return view('profilegame', compact(['user', 'profileGames']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profilegame  $profilegame
     * @return \Illuminate\Http\Response
     */
    public function show(Profilegame $profilegame)
    {
        //
    }
    
    /**
     * Method to update game profile, where the $request is passed to ProfileGameUpdateRequest class for validation
     * when this method is called (and before executing the first statement within the method).
     *
     * @param  ProfileGameUpdateRequest $request
     * @param  \App\Models\Profilegame  $profilegame
     * @return RedirectResponse
     */
    public function edit(ProfileGameUpdateRequest $request)
    {
        /* Validation passed if we arrive here */
        
        // Get current user
        $user = Auth()->user();
        
        /* First Name */
        // If user changes first name (i.e. different than what is stored in database)
        if($request->firstname != $user->firstname) {
            $user->firstname = $request->firstname;
        }
        
        /* Last Name */
        // If user changes last name (i.e. different than what is stored in database)
        if($request->lastname != $user->lastname) {
            $user->lastname = $request->lastname;
        }
        
        /* Display Name */
        // If user changes display name (i.e. different than what is stored in database)
        if($request->displayname  != $user->displayname) {
            $user->displayname = $request->displayname;
        }
        
        /* Avatar */
        // If user deletes avatar (i.e. different than what is stored in database)
        if(!empty($request->file('avatar'))) {
            // Get image file
            $image = $request->file('avatar');
            
            // Make a image name based on user name and current timestamp
            $name = $user->username.'_'.time();
            
            // Define folder path
            $folder = '/uploads/images/avatar_profile/';
            
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder.$name.'.'.$image->getClientOriginalExtension();
            
            // Add Code to test if an avatar is present.  If so, delete the local file
            if(isset($user->avatar)) {
                $this->deleteOne($user->avatar);
            }
            
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            
            // Set user profile image path in database to filePath
            $user->avatar = $filePath;
            
        } elseif(isset($user->avatar) && $request->avatarDelete == "on") {
            // If the user wishes to delete the avatar, delete the local file and remove the avatar from database
            $this->deleteOne($user->avatar);
            $user->avatar = null;
        }
        
        // Save the updates to the database table
        $user->save();
        
        // And then return user back and show a flash message
        return redirect()->back()->with(['status' => 'Profile updated successfully.']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profilegame  $profilegame
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profilegame $profilegame)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profilegame  $profilegame
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profilegame $profilegame)
    {
        //
    }
}
