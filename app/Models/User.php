<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function block(): void
    {
        $this->is_ban = true;
        $this->save();

        \Illuminate\Support\Facades\DB::table('sessions')->where('user_id', $this->id)->delete();
    }

    public function unblock(): void
    {
        $this->is_ban = false;
        $this->save();
    }

    public function toggleAdmin(): void
    {
        $this->is_admin = !$this->is_admin;
        $this->save();
    }

    public function archive(): void
    {
        \Illuminate\Support\Facades\DB::transaction(function () {
            \Illuminate\Support\Facades\DB::table('archived_users')->insert([
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
                'is_admin' => $this->is_admin,
                'is_ban' => $this->is_ban,
                'original_created_at' => $this->created_at,
                'original_updated_at' => $this->updated_at,
                'archived_at' => now(),
            ]);

            $this->delete();
        });
    }
}
