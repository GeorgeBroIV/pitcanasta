<?php
    
    namespace App\Http\Controllers;
    
    use App\Http\Requests\ModelUpdateRequest;
    use App\Models\Auth\User;
    use App\Traits\RolesTrait;
    use App\Traits\InputValidateTrait;
    use App\Traits\ModelUpdateTrait;
    use App\Traits\UploadTrait;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;

    class AccountController extends Controller
    {
        use UploadTrait, InputValidateTrait, RolesTrait, ModelUpdateTrait;
    
        /**
         * The model's input fields to undergo validation checks (modify as applicable).
         */
        public $modelName = "User";
    
        /**

        /**
         * The model's input fields to undergo validation checks (modify as applicable).
         */
        public $fieldsUnique = [
            'username',
            'email',
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
         * @param Request
         * @param integer $id
         * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|RedirectResponse
         */
        public function edit($id)
        {
            $user = User::find($id);
    
            if($user->id != Auth()->user()->id) {
                return redirect()->route('home');
            }
            return view('account.edit', compact('user'));
        }

        /**
         * Method to update profile, where the $request is passed to ModelUpdateRequest class for sanitization and
         * validation when this method is called (and before executing the first statement within the method).
         *
         * @param  ModelUpdateRequest $request
         * @return RedirectResponse
         */
        public function update(ModelUpdateRequest $request)
        {
            $model = User::find(Auth()->user()->id);
            $this->updateModel($this->modelName,$model, $request);
        
            // And then return user back and show a flash message
            return redirect()->route('home');
        }
    }