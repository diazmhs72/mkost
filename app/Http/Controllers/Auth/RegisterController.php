<?php

namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller; // Dihapus untuk sementara
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Routing\Controller; // Menggunakan Controller inti dari Laravel
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

// Mengubah 'extends Controller' menjadi 'extends \Illuminate\Routing\Controller'
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait
    | to provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     * This will be overridden by the redirectTo() method below.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'in:penyewa,pemilik'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);
    }

    /**
     * Override the default redirect path to redirect users based on their role.
     *
     * @return string
     */
    public function redirectTo()
    {
        // Get the role of the authenticated user
        $role = Auth::user()->role;

        // Determine the redirect path based on the user's role
        switch ($role) {
            case 'pemilik':
                return route('pemilik.index');
            case 'penyewa':
                return route('index'); // Redirect penyewa to 'Cari Kost' page
            case 'admin':
                return route('admin.users'); // Fallback for admin
            default:
                return $this->redirectTo; // Default fallback to home
        }
    }
}
