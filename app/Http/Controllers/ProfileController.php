<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModelUpdateRequest;
use App\Models\Auth\User;
use App\Models\Profile;
use App\Traits\ModelUpdateTrait;
use App\Traits\RolesTrait;
use App\Traits\InputValidateTrait;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use UploadTrait, InputValidateTrait, RolesTrait, ModelUpdateTrait;

    /**
     * The model's input fields to undergo validation checks (modify as applicable).
     */
    public $modelName = "Profile";

    /**
     * The model's input fields to undergo validation checks (modify as applicable).
     */
    public $fieldsUnique = [
        'name',
    ];
    
    public $profilesMax = 10;
    
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
        $id = $user->id;
        $profiles=User::find($id)->profiles()->get();
        $profiles->toArray();
        $profilesMax = $this->profilesMax;

        return view('profile.index', compact(['user', 'profiles', 'profilesMax']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return string
     */
    public function create()
    {
        // Test to see if Number of Profiles exceeds the maximum
        $user = Auth()->user();
        $id = $user->id;
        $profiles=User::find($id)->profiles()->get();
        $profilesCount = count($profiles);
        if($profilesCount < $this->profilesMax)
        {
            return view('profile.create');
        }
        else
        {
            return redirect()->route('profiles.index');
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
        $model = new Profile();
        $this->updateModel($this->modelName, $model, $request);
    
        // Once the Table is updated, redirect the user to see the list of all Roles
        return redirect()->route('profiles.index');
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
        return redirect()->route('profiles.edit', $request->id);
    }
    
    /**
     * Method to update game profile, where the $request is passed to ProfileUpdateRequest class for validation
     * when this method is called (and before executing the first statement within the method).
     *
     * @param  integer $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $user = Auth()->user();
        $profile = Profile::find($id);
        //
        return view('profile.edit', compact('user', 'profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ModelUpdateRequest  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ModelUpdateRequest $request)
    {
        $model = Profile::find($request->id);
        $this->updateModel($this->modelName, $model, $request);
    
        // And then return user back and show a flash message
        return redirect()->route('profiles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Get specified Role
        $profile = Profile::find($id);
    
        // Delete the Model from the Table
        $profile->delete();
    
        // Once the Table is updated, redirect the user to see the list of all Roles
        return redirect()->route('profiles.index');
    }
}
