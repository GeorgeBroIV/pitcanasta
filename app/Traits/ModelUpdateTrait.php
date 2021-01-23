<?php
    
    
    namespace App\Traits;
    
    
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Http\Request;
    use function PHPUnit\Framework\isNull;

    trait ModelUpdateTrait {
        
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
                if ($field != 'avatar')
                {
                    if (isset($request->$field) && $request->field != $model->$field)
                    {
                        $model->$field = $request->$field;
                    }
                }
                if(isset($model->avatar) && $request->avatarDelete == "on") {
                    // If the user wishes to delete the avatar, delete the local file and remove the avatar from database
                    $this->deleteOne($model->avatar);
                    $model->avatar = null;
                }
    
                // If user deletes avatar (i.e. different than what is stored in database)
                elseif(!empty($request->avatar)) {
                    // Get image file
                    $image = $request->avatar;
    
                    // Make a image name based on user name and current timestamp
                    $name = $model->username.'_'.time();
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
                }
            }
            $model->updated_by = Auth()->user()->id;
            // Save the updates to the database table
            $model->save();

            return;
        }
    }