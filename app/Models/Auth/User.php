<?php
    
    namespace App\Models\Auth;
    
    use App\Models\Profilegame;
    use App\Traits\RolesTrait;
    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    
    class User extends Authenticatable implements MustVerifyEmail
        // Authenticatable extends model, so no need to extend model and authenticatable
    {
        use Notifiable, RolesTrait;
        
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
        
        /* Custom User Methods
         *  https://stackoverflow.com/questions/32437384/laravel-custom-user-specific-functions
         */
    
        /**
         * Usage: Auth()->user()->isActive() (boolean)
         *
         * @return boolean
         */
        public function isActive()
        {
            $active = false;
            if($this->attributes['active'] == 1) {
                $active = true;
            }
            return $active;
        }
        
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
         * The Users that belong to Roles.
         */
        public function roles()
        {
            return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
        }

        /**
         * The Users that have Game Profiles.
         */
        public function profilegame()
        {
            return $this->hasMany(Profilegame::class);
        }
    }