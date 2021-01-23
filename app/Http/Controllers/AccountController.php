<?php
    
    namespace App\Http\Controllers;
    
    use App\Http\Requests\AccountUpdateRequest;
    use App\Models\Auth\User;
    use App\Traits\RolesTrait;
    use App\Traits\InputValidateTrait;
    use App\Traits\UpdateModelTrait;
    use App\Traits\UploadTrait;
    use Illuminate\Http\RedirectResponse;
    
    class AccountController extends Controller
    {
        use UploadTrait, InputValidateTrait, RolesTrait, UpdateModelTrait;

        /**
         * The model this Request Validation uses.
         */
        public $modelName = "User";
    
        /**
         * The model's input fields to undergo validation checks (modify as applicable).
         */
        public $fields = [
            'firstname',
            'lastname',
            'displayname',
            'avatar',
            'visible'
        ];
        
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
            // Update the Model from the Request
            $model = new User;
            $model = $model->find(Auth()->user()->id);
            $this->updateModel($model, $this->fields, $request);
dd($this->fields);

            // And then return user back and show a flash message
            return redirect()->back()->with(['status' => 'Account updated successfully.']);
        }
    }