<?php
    
    
    namespace App\Traits;
    
    
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Http\Request;

    trait UpdateModelTrait {
        
        /**
         * Method to update profile, where the $request is passed to AccountUpdateRequest class for sanitization and
         * validation when this method is called (and before executing the first statement within the method).
         *
         * @param Model $model
         * @param array $fields
         * @param Request $request
         */
        public function updateModel(Model $model, array $fields, Request $request)
        {
            foreach($fields as $field)
            {
                // If user changes first name (i.e. different than what is stored in database)
dd($request);
                if($request->$field == "avatar") {

                    // If user deletes avatar (i.e. different than what is stored in database)
                    if(!empty($request->file('avatar'))) {
                        // Get image file
                        $image = $request->file('avatar');
        
                        // Make a image name based on user name and current timestamp
                        $name = $model->username.'_'.time();
dd($name);
                        // Define folder path
                        $folder = '/uploads/images/avatar_profile/';
        
                        // Make a file path where image will be stored [ folder path + file name + file extension]
                        $filePath = $folder.$name.'.'.$image->getClientOriginalExtension();
        
                        // Add Code to test if an avatar is present.  If so, delete the local file
                        if(isset($model->avatar)) {
                            $this->deleteOne($model->avatar);
                        }
        
                        // Upload image
                        $this->uploadOne($image, $folder, 'public', $name);
        
                        // Set user profile image path in database to filePath
                        $model->avatar = $filePath;
                    } elseif(isset($model->avatar) && $request->avatarDelete == "on") {
                        // If the user wishes to delete the avatar, delete the local file and remove the avatar from database
                        $this->deleteOne($model->avatar);
                        $model->avatar = null;
                    }
                } else
                    if($request->$field != $model->$field) {
                        $model->$field = $request->$field;
                    }
                }

dd($model->avatar);
            
            // Save the updates to the database table
            $model->save();

            return;
        }
    }