<?php
    
    
    namespace App\Traits;
    
    
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Http\Request;

    trait ModelUpdateTrait {
    
        /**
         * Method to update profile, where the $request is passed to ModelUpdateRequest class for sanitization and
         * validation when this method is called (and before executing the first statement within the method).
         *
         * @param string $modelName
         * @param Model $model
         * @param Request $request
         * @return void
         */
        public function updateModel(string $modelName, Model $model, Request $request)
        {
            // For Controller->update on unique fields, a button to "Change" unique fields, where it sets a flag for
            // "changed" values
            // e.g. users->username, users->email, profile->name
            // any changes to users->e-mail notiify the user that they will need to verify
            // the new e-mail address, and that the old e-mail address will get a notice that email was changed
            // Get request field/value pairs.

            $arrs = $request->all();
            $fields = [];
            foreach($arrs as $key => $value)
            {
                // Don't include $request fields that start with '_'
                // Also, when a user ticks the 'avatarDelete' checkbox, it will add this field to the $request
                // which is not in the model.  Handle this deletion below.
                if ($key[0] != "_") {
                    if ($key != "avatarDelete") {
                        // Option 1: multi-dimensional array with numeric keys
                        // array_push($fields, [$key, $value]);
                        // Option 2: one-dimension array with key/value pairs
                        array_push($fields, $key);
                    }
                    else {
                        $avatarDelete = true;
                    }
                }
            }
            $id = Auth()->user()->id;

            // Loop through each field value and check for updated values
            foreach($fields as $field)
            {
                // Test if the field name is 'avatar'.  If not, update the model with the request inputs
                if ($field != 'avatar')
                {
                    // Test if the request field value exists and is different than the model.  If so, update the model
                    if (isset($request->$field) && $request->$field != $model->$field)
                    {
                        $model->$field = $request->$field;
                    }
                }

                // If the user wishes to delete the avatar, delete the local file and remove the avatar from database
                if(isset($model->avatar) && $request->avatarDelete == "on") {
                    $this->deleteOne($model->avatar);
                    $model->avatar = null;
                }
    
                // If the user adds an avatar
                elseif(!empty($request->avatar)) {
                    // Get image file
                    $image = $request->avatar;

// TODO: get rid of $modelName from here, the method parameters, and the controller's invoke method parameters
//  and test to see if $model->username exists, if so set filename to $model->username else $model->name
//  else $model->id
                    // Set the name and file path depending on the model
                    if($modelName == "User") {
                        // Make a image name based on user name and current timestamp
                        $name = $id . '-' . $model->username;
                        // Define folder path
                        $folder = '/users/' . $id . '/avatars/account/';
                    } elseif($modelName == "Profile") {
                        // Make a image name based on user name and current timestamp
                        $name = $id . '-' . $model->name;
                        // Define folder path
                        $folder = '/users/' . $id . '/avatars/profiles/';
                    }
                    // Make a file path where image will be stored [ folder path + file name + file extension]
                    $filePath = $folder.$name . '.' . $image->getClientOriginalExtension();
    
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

            // Update the 'user_id' foreign key
// TODO Identify a clean way to test if this field exists in the model instead of hardcoding a model name
            if($modelName == "Profile" && !isset($model->user_id)) {
                $model->user_id = $id;
            }
            
// TODO Why is this here?  And should the value be set to $id???
            if(!isset($model->active)) {
                $model->active = $id;
            }
            
            // Update the 'created_by' foreign key
// TODO Identify a clean way to test if this field exists in the model instead of hardcoding a model name
            if($modelName != "User" && !isset($model->created_by)) {
                $model->created_by = $id;
            }
            
            // Update the 'updated_by' field
            $model->updated_by = $id;
            
            // Save all updates
            $model->save();

            return;
        }
    }