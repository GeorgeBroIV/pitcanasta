<?php
    
    namespace App\Http\Controllers\Admin;
    
    use App\Http\Controllers\Controller;
    use App\Models\Auth\User;
    use App\Traits\RolesTrait;
    use Illuminate\Http\Request;
    use Illuminate\Support\Arr;
    use Illuminate\Support\Facades\Auth;
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
     * This controller handles routed HTTP requests for the 'users' models, and returns
     * associated views based on the application logic contained herein (MVC paradigm).
     **/
    
    class UserController extends Controller
    {
        use RolesTrait;
        
        /**
         * Controller Constructor
         *   - applies middleware
         */
        public function __construct() {
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
         * @return \Illuminate\Contracts\Support\Renderable
         */
        public function show($id)
        {
            /* Data to populate User Role view 'rendered table' column header values */
            // Query the database to obtain Role names
            $roles = DB::table('roles')
                       ->select('name', 'Description', 'active')
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
         * @return \Illuminate\Contracts\Support\Renderable
         */
        public function edit($id)
        {
            /* Data to populate User Role view 'rendered table' column header values */
            // Query the database to obtain Role names
            $roles = DB::table('roles')
                       ->select('name', 'Description', 'active')
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
            return view('admin.user.edit', compact('roles', 'user', 'userRoles'));
        }
        
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            //
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
