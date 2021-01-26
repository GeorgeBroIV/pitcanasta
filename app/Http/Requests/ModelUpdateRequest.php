<?php
    
    namespace App\Http\Requests;
    
    /**
     * Code Author
     * George T. Brotherston IV
     * StackOverflow: https://stackoverflow.com/users/13029167/george-brotherston
     * Github: https://github.com/GeorgeBroIV
     *
     * Concept Author
     * "The Smart Way To Handle Request Validation In Laravel"
     * https://medium.com/@kamerk22/the-smart-way-to-handle-request-validation-in-laravel-5e8886279271
     *
     * This 'Form Request' class is intended to be called from a controller method that processes form
     * input values (Single Purpose Class paradigm).  This class identifies the input fields that
     * will undergo data validation, perform the validation (via a call to the 'InputValidateTrait')
     * and return the resulting array to the controller method.
     */

    use App\Traits\InputValidateTrait;
    use Illuminate\Foundation\Http\FormRequest;

    class ModelUpdateRequest extends FormRequest
    {
        use InputValidateTrait;
    
        public $fieldsUnique;
        public $fields;
        public $modelName;
        
        /**
         * Occurs first when ModelUpdateRequest is invoked
         * Step 1: Prepare the data for validation (sanitize, etc.)
         * https://laravel.com/docs/8.x/validation#preparing-input-for-validation
         *
         * @return void
         */
        protected function prepareForValidation()
        {
            // Identify fields that are to undergo validation / sanitation (e.g. non-unique)
            $return = $this->fieldsToProcess();
            $this->fieldsUnique = $return[0];
            $this->fields = $return[1];
            $this->modelName = $return[2];
dd($return);
            // Sanitize the Request Input Data
            // $this->sanitizeData();
        }
    
        /**
         * Helper Method
         * To be called within prepareForValidation()
         * Identify fields that are to undergo validation / sanitation (e.g. non-unique)
         *
         * @return array
         */
        protected function fieldsToProcess()
        {
            // Get request field/value pairs.
            $arrs = $this->request->all();
            $requestFields = [];
            foreach($arrs as $key => $value)
            {
                // Don't include $request fields that start with '_'
                if ($key[0] != "_") {
                    // Option 1: multi-dimensional array with numeric keys
                    // array_push($fields, [$key, $value]);
                    // Option 2: one-dimension array with key/value pairs
                    array_push($requestFields,$key);
                }
            }
            // Get method action, model's fields whose values are unique
            $methodAction = $this->route()->getActionMethod();

            // If this is a new record, no need to identify unique field values
            if($methodAction == "store")
            {
                $fields = [];
                foreach($requestFields as $requestField)
                {
                    array_push($fields, $requestField);
                }
                $fieldsUnique = "";
                $model = $this->route()->uri();
                // Test to see if the route URI contains a /.  If so, extract everything after the last occurrence
                if(str_contains($model, '/'))
                {
                    $model = substr($model, strrpos($model, '/') + 1);
                }
                $model = rtrim(ucfirst($model), 's');
                $return = [$fieldsUnique, $fields, $model];
                return $return;
            }
            elseif($methodAction == "update")
            {
                $fields = [];
                foreach($requestFields as $requestField) {
                    if($requestField != "avatarDelete") {
                        array_push($fields, $requestField);
                    }
                }
                $fieldsUnique = $this->route()->controller->fieldsUnique;
                $model = ucfirst(key($this->route()->parameters()));
                if($model == "Account")
                {
                    $model = "User";
                }
                $return = [$fieldsUnique, $fields, $model];
                return $return;
            }
        }
    
        /**
         * Called after prepareForValidation()
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function authorize()
        {
            return true;
        }

        /**
         * Called after authorise()
         * Step 2: Get the validation rules that apply to the request.
         * https://laravel.com/docs/8.x/validation#available-validation-rules
         *
         * @return array
         */
        public function rules()
        {
            // This requires unique fields to be non-editable in the View form
            // Laravel Validation Rule-based Messages
            $rules = $this->ValidationInputRules($this->modelName, $this->fields);
            return $rules;
        }
        
        /**
         * Obtain the validation error messages for each rule.
         *
         * @return array
         */
        public function messages()
        {
            // Laravel Validation Rule-based Messages
            $messages = $this->ValidationOutputMessages($this->modelName, $this->fields);
            return $messages;
        }
        
        /**
         *  Retrieves Field Sanitize rules array for each $field.
         *
         * @param array $fields
         * @return array
         */
        
        public function filters($fields)
        {
            // Sanitizes field values
            $filters = $this->FieldSanitize($this->route()->controller->modelName, $this->route()->controller->fields);
            return $filters;
        }
    
        /**
         * Helper Method
         * To be called within prepareForValidation()
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function sanitizeData()
        {
            /*
             * TODO: Develop Data Sanitization Functionality
             * STEPS for Developing this functionality
             
                        1.  Identify the fields we wish to sanitize
                                (this trait's property: $this->fields)
            
                        2.  Run it through the 'InputValidateTrait->FieldSanitizes
                                $filters = $this->filters($this->fields);
                                this will be an array ['name' => 'trim|capitalize|escape']
            
                        3.  Develop (or find) a method to iterate through each field and apply the PHP function associated with the
                            filter name, returning an array where the field values are sanitized (e.g. $sanitized)
                                --> Dev/Code Library/PHP/sanitizer-master/src/Sanitizer.php
                                TO DEVELOP
                                https://github.com/Waavi/Sanitizer -> has cool filters (Code Library->PHP)
                                It might be helpful to develop a Trait that associates a filter name
                                with the built-up PHP functions that achieve the intended filter result
                                https://www.php.net/manual/en/filter.filters.sanitize.php (consider the usage array_filter()
                                and other common PHP methods like (toString), https://www.php.net/manual/en/function.ucfirst.php
            
                        4.  Merge the sanitized data back in
                                $this->merge($sanitized); // where $sanitized = ['firstname' => 'new value'] etc.
            
                        HINT: to access the request fields, use $this->firstname (and not $this->request->firstname)
            */
            //  START - TESTING AREA //
            /*
                            // START - Test 1 - Merge Test
            
                                $objClone = clone $this;    // Creates a copy "by Value, not by Reference" of the object to a new object
                                $newFirstName = lcfirst($this->firstname);  // Makes the first character of array string value of array key 'firstname' lowercase
                                $this->merge(['firstname' => $newFirstName]);   // Merges updated array key's value back into the object
                                dd($this->firstname, $objClone->firstname);    // Prints original object's 'firstname' key value and cloned object's key value
            
                            // END - Test 1
            */
            //  END - TESTING AREA //
        }
    }