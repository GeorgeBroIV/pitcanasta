<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModelUpdateRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Models\Auth\Role;
use App\Traits\InputValidateTrait;
use App\Traits\RolesTrait;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use App\Traits\ModelUpdateTrait;

/**
 * Code Author
 * George T. Brotherston IV
 * StackOverflow: https://stackoverflow.com/users/13029167/george-brotherston
 * Github: https://github.com/GeorgeBroIV
 *
 * This controller handles routed HTTP requests for the 'Role' model, and returns
 * associated views based on the application logic contained herein (MVC paradigm).
 **/

class RoleController extends Controller
{
    use UploadTrait, InputValidateTrait, RolesTrait, ModelUpdateTrait;
    
    /**
     * The Model Name.
     */
    public $modelName = "Role";
    
    public $rolesMax = 10;
    
    /**
     * The model's input fields to undergo validation checks (modify as applicable).
     */
    public $fieldsUnique = [
        'name',
    ];

    public function __construct() {
        $this->middleware('role:Admin');
    }
    
    /**
     * Display a listing of resources.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $roles = Role::all();
        $rolesMax = $this->rolesMax;
        return view('admin.role.index', compact('rolesMax','roles'));
    }
    
    /**
     * Show the specified resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show(Request $request)
    {
        // Passthrough to '$this->edit' method via route
        return redirect()->route('roles.edit', $request->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        // Get the requested role and display in the view
        $role = Role::find($id);
        $user = Auth()->user();
        return view('admin.role.edit', compact('user', 'role'));
    }
    
    /**
     * Update the specified resource.
     *
     * @param ModelUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ModelUpdateRequest $request)
    {
        $model = new Role;
        $model = $model->find($request->id);
        $this->updateModel($this->modelName, $model, $request);

        // Once the model is updated, redirect the user to see the list of all Roles
        return redirect()->route('roles.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
    
        $roles=Role::all();
        $rolesCount = count($roles);
        if($rolesCount < $this->rolesMax)
        {
            return view('admin.role.create');
        }
        else
        {
            return redirect()->route('roles.index');
        }
    }
    
    /**
     * Create a new resource.
     *
     * @param ModelUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ModelUpdateRequest $request)
    {
// TODO: Refactor the below to utilize ModelUpdateTrait->updateModel()
        // Create a new Model
        $role = new Role;

        // Set Display Order
        $order = Role::all()
            ->pluck('order')
            ->max() + 1;

        // Get current User
        $userId = Auth()->user()->id;

        // Populate Model properties
        $role->name = $request->name;
        $role->order = $order;
        $role->description = $request->description;
        $role->active = $request->active;


//        $role->protected = $request->protected;
        $role->protect = 0;

        
        $role->notes = $request->notes;
        $role->created_by = $userId;

        // Persist Model to the Table
        $role->save();
        
        // Once the Table is updated, redirect the user to see the list of all Roles
        return redirect()->route('roles.index');
    }
    
    /**
     * Update the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Get specified Role
        $role = Role::find($id);

        // Delete the Model from the Table
        $role->delete();
    
        // Once the Table is updated, redirect the user to see the list of all Roles
        return redirect()->route('roles.index');
    }
}