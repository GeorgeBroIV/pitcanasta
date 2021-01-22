<?php
    
    namespace App\Http\Controllers;
    
    use App\Http\Requests\AccountUpdateRequest;
    use App\Traits\RolesTrait;
    use App\Traits\InputValidateTrait;
    use App\Traits\UploadTrait;
    use Illuminate\Http\RedirectResponse;
    
    class AccountController extends Controller
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
            return view('account', compact('user'));
        }
        
        /**
         * Method to update profile, where the $request is passed to AccountUpdateRequest class for sanitization and
         * validation when this method is called (and before executing the first statement within the method).
         *
         * @param  AccountUpdateRequest $request
         * @return RedirectResponse
         */
        public function edit(AccountUpdateRequest $request)
        {
/*
 * TODO: Pull this logic into a separate DRY class
 */
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
    
            /* Visible */
            // If user changes visibility (i.e. different than what is stored in database)
            if(!isset($request->visible)) {
                $request->visible = 0;
            }

            if($request->visible  != $user->visible) {
                $user->visible = $request->visible;
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
            
/*
 * END - To Do
*/
            // And then return user back and show a flash message
            return redirect()->back()->with(['status' => 'Account updated successfully.']);
        }
    }