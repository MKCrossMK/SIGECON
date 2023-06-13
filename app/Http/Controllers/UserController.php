<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Branch_Office;
use App\Models\Cash;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public $default_password;

    
    public function __construct()
    {
        $this->default_password = 'MDP105';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $branch_offices = Branch_Office::all();
        $users = User::all();
        $cashes = Cash::orderBy('name')->get();
        return view('users.index')
            ->with('roles', $roles)
            ->with('branch_offices', $branch_offices)
            ->with('users', $users)
            ->with('cashes', $cashes);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {

        $request->validated();

        User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'user' => $request->user,
            'email' => $request->email,
            'password' => Hash::make($this->default_password),
            'rol_id' => $request->rol_id,
            'branch_office_id' => $request->branch_office_id,
            'cash_id' => $request->cash_id,

        ]);


        return redirect()->route('users.index')->with('message', 'Usuario registrado satisfactoriamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $branch_offices = Branch_Office::all();

        return view('users.edit')
            ->with('user', $user)
            ->with('roles', $roles)
            ->with('branch_offices', $branch_offices);
    }

    public function configure(User $user)
    {
        return view('users.configuration')
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
       
    }

    public function resetPassword(User $user)
    {
        $user->update([
            'password' => Hash::make($this->default_password),
        ]);

        return back()->with('message', 'Contraseña Reestablecida Correctamente');
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'current_password' => 'required',
        ]);
        
        if(Hash::check($request->current_password, $user->password)) {
         
            if ( $request->new_password != "" &&  $request->confirm_password != ""  && $request->new_password === $request->confirm_password) {

                $user->update([
                    'password' => Hash::make($request->new_password),
                ]);
    
                return redirect()->route('users.config', $user->id)->with("success", "Contraseña actualizada correctamente");
    
            }
            else {
                return redirect()->route('users.config', $user->id)->with("error", "Las Contraseñas no son iguales");

            }
        } 
      
        return redirect()->route('users.config', $user->id)->with("error", "Contraseña actual es incorrecta");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $message = '';
        if ($user->status == 0) {
            $user->update([
                'status' => 1,
            ]);
            $message  = 'El Usuario fue Desactivado Correctamente';
        } else {
            $user->update([
                'status' => 0,
            ]);

            $message  = 'El Usuario fue Activado Correctamente';
        }

        $roles = Role::all();
        $branch_offices = Branch_Office::all();
        return redirect()->route('users.index')
            ->with('message', $message)
            ->with('roles', $roles)
            ->with('branch_offices', $branch_offices);
    }

    public function CodeUnique(User $user)
    {
        $generateCode = $this->generateCode(7);
        if ($user->unique_code == null) {
            $user->update([
                'unique_code' => Crypt::encryptString($generateCode),
            ]);

            return redirect()->route('users.edit', $user->id)->with('success', 'Codigo Unico Generado Correctamente');
        } else {
            return redirect()->route('users.edit', $user->id)->with('info', 'Este usuario ya poseé Codigo Unico');
        }
    }

    public function CodeUniqueRequest(User $user)
    {
        $unique_code = "";
        $generateCode = $this->generateCode(7);
        $users = User::where('unique_code', '=', $generateCode)->first();
        if ($user->unique_code == null) {
            if ($users === null) {
                $user->update([
                    'unique_code' => Crypt::encryptString($generateCode),
                ]);

                $unique_code = Crypt::decryptString($user->unique_code);
                return redirect()->route('users.config', $user->id)->with('success', 'Codigo Unico Generado Correctamente, este es: ' . $unique_code);
            } else {
                return redirect()->route('users.config', $user->id)->with('info', 'Vuelva a solicitar Codigo Unico');
            }
        } else {
            $unique_code = Crypt::decryptString($user->unique_code);
            return redirect()->route('users.config', $user->id)->with('info', 'Usted ya poseé Codigo Unico, este es: ' . $unique_code);
        }
    }

    public function generateCode($longitud)
    {
        $caracteres = array(
            "0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n",
            "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"
        );
        $codigo = '';

        for ($i = 1; $i <= $longitud; $i++) {
            $codigo .= $caracteres[$this->randomNumber(0, 35)];
        }

        return $codigo;
    }

    public function randomNumber($ninicial, $nfinal)
    {
        $numero = rand($ninicial, $nfinal);

        return $numero;
    }
}
