<?php
    
    namespace App\Http\Controllers;
    
    use App\Http\Requests\ProfileUpdateRequest;
    use App\Traits\RolesTrait;
    use App\Traits\InputValidateTrait;
    use App\Traits\UploadTrait;
    use Illuminate\Http\RedirectResponse;
    
    class ProfileController extends Controller
    {
        use UploadTrait, InputValidateTrait, RolesTrait;
        
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
            return view('profile', compact('user'));
        }
        
        /**
         * Method to update profile, where the $request is passed to ProfileUpdateRequest class for validation
         * when this method is called (and before executing the first statement within the method).
         *
         * @param  ProfileUpdateRequest $request
         * @return RedirectResponse
         */
        public function edit(ProfileUpdateRequest $request)
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
    }