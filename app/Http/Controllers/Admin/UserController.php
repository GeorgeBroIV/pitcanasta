<?php
    
    namespace App\Http\Controllers\Admin;
    
    use App\Http\Controllers\Controller;
    use App\Http\Requests\ModelUpdateRequest;
    use App\Models\Auth\User;
    use App\Traits\InputValidateTrait;
    use App\Traits\ModelUpdateTrait;
    use App\Traits\RolesTrait;
    use App\Traits\UploadTrait;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    
    /**
     * Framework Author
     * Laravel
     * https://laravel.com/
     *
     * Customized Code Author
     * George T. Brotherston IV
     * StackOverflow: https://stackoverflow.com/users/13029167/george-brotherston
     * Github: https://github.com/GeorgeBroIV
     *
     * This controller handles routed HTTP requests for the 'User' model, and returns
     * associated views based on the application logic contained herein (MVC paradigm).
     **/
    
    class UserController extends Controller
    {
        use UploadTrait, InputValidateTrait, RolesTrait, ModelUpdateTrait;
    
        /**
         * The Model Name.
         */
        public $modelName = "User";
    
        /**
         * The model's input fields to undergo validation checks (modify as applicable).
         */
        public $fieldsUnique = [
            'username',
            'email',
        ];
        
        /**
         * Controller Constructor
         */
        public function __construct() {
            // Applies custom middleware 'EnsureUserHasRole'
            // Role parameter values in 'name' field in 'roles' table
            // Middleware ALSO applied to route
            $this->middleware('role:Admin');
        }
        
        /**
         * Display a listing of User information.
         *
         * Note: the RESTFUL controller methods 'Show', 'Create' and 'Store' are not needed
         *   since these are handled by Laravel's 'authentication' which has been scaffolded
         *
         * Programmatic type-hinting information
         * @return \Illuminate\Contracts\Support\Renderable
         */
        public function index()
        {
            $users=User::all();
            return view('admin.user.index', compact('users'));
        }
    
        /**
         * Display a listing of User information.
         *
         * Note: the RESTFUL controller methods 'Show', 'Create' and 'Store' are not needed
         *   since these are handled by Laravel's 'authentication' which has been scaffolded
         *
         * Programmatic type-hinting information
         * @param int $id
         * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
         */
        public function show($id)
        {
            /* Data to populate User Role view 'rendered table' column header values */
            // Query the database to obtain Role names
            $userProtect = User::find($id);
            $roles = DB::table('roles')
                       ->orderBy('order')
                       ->get();
    
            $user = User::with('roles')
                        ->where('users.id', '=', $id)
                        ->get();
            $user = $user[0];
    
            // User Roles
            $arrs=User::find($id)->roles()->select('name')->orderBy('order')->get();
            $userRoles = [];
            foreach($arrs as $arr) {
                $q = $arr->name;
                array_push($userRoles,$q);
            }
                return view('admin.user.show', compact('roles', 'user', 'userRoles'));
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @return \Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Support\Renderable
         */
        public function edit($id)
        {
            return redirect()->route('users.index');
        }
    
        /**
         * Update the specified resource.
         *
         * @param ModelUpdateRequest $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function update(ModelUpdateRequest $request)
        {
            $model = new User;
            $model = $model->find($request->id);
            $id = $request->id;
            $this->updateModel($this->modelName, $model, $request);
            // Once the model is updated, redirect the user to the Show view
            return redirect()->route('users.show', [$model]);
        }
        
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            //
        }
    }
