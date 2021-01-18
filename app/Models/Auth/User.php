<?php
    
    namespace App\Models\Auth;
    
    use App\Models\Profilegame;
    use App\Traits\HasRolesAndPermissionsTrait;
    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    
    class User extends Authenticatable implements MustVerifyEmail
        // Authenticatable extends model, so no need to extend model and authenticatable
    {
        use Notifiable, HasRolesAndPermissionsTrait;
        
        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'username',
            'firstname',
            'lastname',
            'displayname',
            'email',
            'avatar',
            'password',
            'visible',
            'active',
            'notes',
        ];
        protected $guarded = ['*'];
        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [
            'password',
            'remember_token',
        ];
        
        /**
         * The attributes that should be cast to native types.
         *
         * @var array
         */
        protected $casts = [
            'email_verified_at' => 'datetime',
        ];
        
        /* Custom User Properties
         *   This will not be needed once I do a permissions check.
         */
        protected $rolesAdmin = ['Admin', 'Reviewer', 'Verified', 'Registered'];
        protected $rolesReviewer = ['Reviewer', 'Verified', 'Registered'];
        protected $rolesVerified = ['Verified', 'Registered'];
        
        /* Custom User Methods
         *  https://stackoverflow.com/questions/32437384/laravel-custom-user-specific-functions
         */
        
        /**
         * Usage: Auth()->user()->isVisible() (boolean)
         *
         * @return boolean
         */
        public function isVisible()
        {
            $visible = false;
            if($this->attributes['visible'] == 1) {
                $visible = true;
            }
            return $visible;
        }
        
        /**
         * Usage: Auth()->user()->isVerified() (boolean)
         *
         * @return boolean
         */
        public function isVerified()
        {
            $verified = false;
            if(isset($this->attributes['email_verified_at'])) {
                $verified = true;
            }
            return $verified;
        }
        
        /**
         * Usage: Auth()->user()->isReviewer() (boolean)
         *
         * @return boolean
         */
        public function isReviewer()
        {
            $reviewer = false;
            if(in_array($this->attributes['role'],$this->rolesReviewer)) {
                $reviewer = true;
            }
            return $reviewer;
        }
        
        /**
         * Usage: Auth()->user()->isAdmin() (boolean)
         *
         * @return boolean
         */
        public function isAdmin()
        {
            $admin = false;
            if(in_array($this->attributes['role'], $this->rolesAdmin)) {
                $admin = true;
            }
            return $admin;
        }
        
        /**
         * Custom User Methods
         *
         * Use: $var = Auth()->user()->hasRole($role);
         */
        /*    public function hasRole($role)
            {
                return $this->role == $role;
            }
        
        
            /**
             * The Roles that belong to the permissions.
             */
        public function permissions()
        {
            return $this
                ->belongsToMany('App\Models\Auth\Permission')
                ->using('App\Models\Auth\PermissionUser')
                ->with('roles')
                ->withPivot([
                    'created_by',
                    'updated_by',
                ]);
        }
        
        /**
         * The Roles that belong to the permissions.
         */
        public function roles()
        {
            return $this->belongsToMany('App\Models\Auth\Role');
        }

        /**
         * Get the Game Profile for the user.
         */
        public function profilegame()
        {
            return $this->hasMany(Profilegame::class);
        }
    }
