<?php
    
    
    namespace App\Traits;
    
    trait RolesTrait
    {
        /**
         * @param mixed ...$roles
         * @return bool
         */
        public function hasRole(... $roles ) {
            
            foreach ($roles as $role) {
                if ($this->roles->contains('name', $role)) {
                    return true;
                }
            }
            return false;
        }
    }