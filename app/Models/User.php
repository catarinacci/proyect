<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
// use Laravel\Sanctum\HasApiTokens;
use MohamedGaber\SanctumRefreshToken\Traits\HasApiTokens;
use App\Notifications\ResetPasswordNotification;
use App\Models\Note;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Auth\Passwords\CanResetPassword;

class User extends Authenticatable implements MustVerifyEmail, FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use CanResetPassword;


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $table = 'users';

    protected $fillable = [
        'name',
        'surname',
        'nickname',
        'email',
        'profile_photo_path',
        'password',
        'email_verified_at',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        //'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    /*  protected $appends = [
        'profile_photo_url',
    ]; */


    public function canAccessFilament(): bool
    {
        //return true;
        return str_ends_with($this->email, '@gmail.com') && $this->hasVerifiedEmail();
        //return str_ends_with($this->email, '@gmail.com');

    }

    public function sendPasswordResetNotification($token)
    {
        $url =  $token;

        $this->notify(new ResetPasswordNotification($url));
    }


    //Relacion de uno a muchos
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    // Relación uno a uno polimorfica
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    // Relación de uno a muchos
    public function reactionms()
    {
        return $this->hasMany(Reactionm::class);
    }

    // Relación de uno a muchos
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function chats()
    {
        return $this->belongsToMany('App\Models\Chat');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\Message');
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
    
    // relación uno a uno
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    // relación uno a uno a través de 
    public function location()
    {
        return $this->hasOneThrough(Location::class, Profile::class);
    }

     // relación uno a uno a través de 
    //  public function country()
    //  {
    //      return $this->hasOneThrough(Country::class, Location::class,);
    //  }
}
