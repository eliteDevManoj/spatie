<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Http\Requests\UserRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'identity_proof'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value){

        $this->attributes['password'] = Hash::make($value);
    }

    public static function createFromRequest(UserRequest $request){

        $user = self::create($request->getUserPayLoad());

        $user->storeAvatar($request);

        $user->storeIdentityProof($request);

        if($request->has('role')){

            $user->assignRole($request->role);
        }

        return $user;
    }

    public function updateFromRequest(UserRequest $request){

        $this->update($request->getUserPayLoad());

        $this->storeAvatar($request);

        $this->storeIdentityProof($request);

        if($request->has('role')){

            $this->syncRoles($request->role);
        }

        return $this;
    }

    public function storeAvatar($request){

        $profileImage = NULL;

        if($request->hasFile('profile_image')) {

            $profileImage = Storage::disk('public')->put('/', $request->file('profile_image'));

            $existProfileImage = storage_path('app/public/').$this->profile_image;
            if (isset($this->profile_image) && file_exists($existProfileImage)) {
                
                unlink($existProfileImage);
            }

            $this->update([
                'profile_image' => $profileImage,
            ]);
        }

        return $profileImage;
    }

    public function storeIdentityProof($request){

        $identityProof = NULL;

        if($request->hasFile('identity_proof')){

            $identityProof = Storage::disk('public')->put('/id-proof', $request->file('identity_proof'));

            $existIdentityProof = storage_path('app/public/id-proof').$this->identity_proof;
            if (isset($this->identity_proof) && file_exists($existIdentityProof)) {
                
                unlink($existIdentityProof);
            }

            $this->update([
                'identity_proof' => $identityProof
            ]);
        }

        return $identityProof;
    }
}
