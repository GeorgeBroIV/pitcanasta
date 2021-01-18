<?php
    
    
    namespace App\Traits;
    
    use App\Models\Auth\Role;
//    use App\Models\Auth\Permission;
    
    trait HasRolesAndPermissionsTrait
    {
        /**
         * @return mixed
         */
        public function roles()
        {
            return $this->belongsToMany(Role::class,'role_user');
        }
        
        /**
         * @param string
         * @return array
         */
//        public function getRoles($permission) {
//            $roles = Permission::where('slug', $permission)->with('roles')->get();
//            return $roles;
//        }
        
        /**
         * @return mixed
         */
//        public function permissions()
//        {
//            return $this->belongsToMany(Permission::class,'permission_user');
//        }
        
        /**
         * @param mixed ...$roles
         * @return bool
         */
        public function hasRole(... $roles ) {
ddd($roles);
            foreach ($roles as $role) {
                if ($this->roles->contains('slug', $role)) {
                    return true;
                }
            }
            return false;
        }
        
        /**
         * @param $permission
         * @return bool
         */
 //       public function hasPermission($permission)
 //       {
 //           return (bool) $this->permissions->where('slug', $permission)->count();
 //       }
        
        /**
         * @param $permission
         * @return bool
         */
//        protected function hasPermissionTo($permission)
//        {
//            return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
//        }
        
        /**
         * @param $permission
         * @return bool
         */
//        public function hasPermissionThroughRole($permission)
//        {
//            foreach ($permission->roles as $role){
//                if($this->roles->contains($role)) {
//                    return true;
//                }
//            }
//            return false;
            
            
//            $q = $this->getRoles($permission);
//            foreach($q as $key => $value) {
//                if(isset($value->name)) {
//                    return true;
//                }
//            }
//            return false;
//        }
        
        /**
         * @param array $permissions
         * @return mixed
         */
//        protected function getAllPermissions(array $permissions)
//        {
//            return Permission::whereIn('slug',$permissions)->get();
//        }
        
        /**
         * @param mixed ...$permissions
         * @return $this
         */
//        public function givePermissionsTo(... $permissions)
//        {
//            $permissions = $this->getAllPermissions($permissions);
//            if($permissions === null) {
//                return $this;
//            }
//            $this->permissions()->saveMany($permissions);
//            return $this;
//        }
        
        /**
         * @param mixed ...$permissions
         * @return $this
         */
//        public function deletePermissions(... $permissions )
//        {
//            $permissions = $this->getAllPermissions($permissions);
//            $this->permissions()->detach($permissions);
//            return $this;
//        }
        
        /**
         * @param mixed ...$permissions
         * @return HasRolesAndPermissions
         */
//        public function refreshPermissions(... $permissions )
//        {
//            $this->permissions()->detach();
//            return $this->givePermissionsTo($permissions);
//        }
    }
