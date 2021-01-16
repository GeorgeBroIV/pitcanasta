<?php
    
    namespace App\Traits;

    /**
     * Code Author
     * George T. Brotherston IV
     * StackOverflow: https://stackoverflow.com/users/13029167/george-brotherston
     * Github: https://github.com/GeorgeBroIV
     *
     * This 'UploadTrait' trait is intended to be called from a controller method that stores or deletes files from
     * file storage folder.
     */
    
    use Illuminate\Support\Str;
    use Illuminate\Http\UploadedFile;
    use Illuminate\Support\Facades\Storage;
    
    trait UploadTrait
    {
        public function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
        {
            /*
             * This method uploads a single file to Storage
             *
             * @return false|string
             */
            $name = !is_null($filename) ? $filename : Str::random(25);
            $file = $uploadedFile->storeAs($folder, $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);
            return $file;
        }

        /*
         * This method deletes a single file from Storage
         *
         * @return null
         */
        public function deleteOne($filename, $disk = 'public')
        {
            Storage::disk($disk)->delete($filename);
            return null;
        }
    }