<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Password extends Model
{
    protected $fillable = [
        'title',
        'username',
        'password',
        'url',
        'notes',
        'uuid',
        'user_id',
    ];

    protected function encryptSensitive($value)
    {
        $key = str_pad(auth()->id(), 32, '0', STR_PAD_RIGHT); // Ensure 32 bytes for AES-256
        $iv = str_repeat('0', 16); // Proper 16-byte IV
        return openssl_encrypt($value, 'AES-256-CBC', $key, 0, $iv);
    }

    protected function decryptSensitive($value)
    {
        $key = str_pad(auth()->id(), 32, '0', STR_PAD_RIGHT); // Ensure 32 bytes for AES-256
        $iv = str_repeat('0', 16); // Proper 16-byte IV
        return openssl_decrypt($value, 'AES-256-CBC', $key, 0, $iv);
    }


    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = $this->encryptSensitive($value);
    }

    // Encrypt sensitive data before saving
    public function setUsernameAttribute($value)
    {
        $this->attributes['username'] = $value ? $this->encryptSensitive($value) : null;
    }

    public function setNotesAttribute($value)
    {
        $this->attributes['notes'] = $value ? $this->encryptSensitive($value) : null;
    }

    public function getUsernameAttribute($value)
    {
        return $value ? $this->decryptSensitive($value) : null;
    }

    public function getPasswordAttribute($value)
    {
        return $this->decryptSensitive($value);
    }

    public function getNotesAttribute($value)
    {
        return $value ? $this->decryptSensitive($value) : null;
    }
}
