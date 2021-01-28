<?php

namespace App\View\Components;

use App\Models\Auth\Role;
use App\Models\Auth\User;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class Dataview extends Component
{
    public $modelName;
    public $id;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($modelName, $id)
    {
        $this->modelName = $modelName;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|array|void
     */
    public function render()
    {
        $model = $this->modelName;
        if($model == 'Profile') {
            // User Profiles
            $profiles = User::find($this->id)
                            ->profiles()
                            ->select(
                                'name',
                                'avatar',
                                'rating',
                                'visible',
                                'active',
                                'notes'
                            )
                            ->get();
            return view('components.profile', compact('profiles'));
        }
        elseif($model == 'Role') {
            // All Roles
            $roles = Role::all();
            
            $user = User::with('roles')->where('id', '=', $this->id)->get();
    
            // User Roles
            $arrs = User::find($this->id)->roles()->select('name')->orderBy('order')->get();
            $userRoles = [];
            foreach($arrs as $arr) {
                $q = $arr->name;
                array_push($userRoles, $q);
            }
    
            return view('components.role', compact('roles', 'user', 'userRoles'));
        }
        elseif($model == 'Message') {
            // User Nessages
    
            $modelData = [];
        }
        else {
            return;
        }
        return view('components.dataview', compact('model', 'modelData'));
    }
}
