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

    class ProfileUpdateRequest extends FormRequest
    {
        use InputValidateTrait;
        /**
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function authorize()
        {
            return true;
        }
    
        /**
         * The model this Request Validation uses.
         */
        public $model = "User";
    
        /**
         * The model's input fields to undergo validation checks (modify as applicable).
         */
        public $fields = [
            'firstname',
            'lastname',
            'displayname',
            'avatar'
        ];
        
        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules()
        {
            // Laravel Validation Rule-based Messages
            $rules = $this->ValidationInputRules($this->model, $this->fields);
            return $rules;
        }
        
        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function messages()
        {
            // Laravel Validation Rule-based Messages
            $messages = $this->ValidationOutputMessages($this->model, $this->fields);
            return $messages;
        }
        
        /**
         *  Sanitizes input values.
         *
         * @return array
         */
        public function filters()
        {
            // Sanitizes field values
            $sanitizes = $this->FieldSanitize($this->model, $this->fields);
            return $sanitizes;
        }
    }