<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Asegúrate de importar el modelo User
use App\Models\Area; // Si estás utilizando el modelo Area
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
class UsuarioController extends Controller
{
    // Mostrar el formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Manejar la autenticación del usuario
    public function login(Request $request)
    {
        // Validar los datos de entrada
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            // Regenerar la sesión para evitar ataques de fijación de sesión
            $request->session()->regenerate();

            // Redirigir al usuario a su dashboard o página de inicio
            return redirect()->intended('dashboard')->with('success', 'Inicio de sesión exitoso.');
        }

        // Si la autenticación falla, redirigir de vuelta con un mensaje de error
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    // Cerrar la sesión del usuario
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidar y regenerar la sesión
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Sesión cerrada correctamente.');
    }

    // Método index para cargar usuarios
    public function index()
    {
        // Recuperar los usuarios con la relación 'area'
        $usuarios = User::with('area')->paginate(10);

        // Pasar la variable 'usuarios' a la vista
        return view('usuarios.index', compact('usuarios'));
    }
    

    
    // Otros métodos CRUD...

    // Mostrar formulario de creación
    public function create()
    {
        $roles = Role::all(); // Obtener todos los roles disponibles
        $areas = Area::all(); // Asegúrate de tener un modelo Area y sus registros

        return view('usuarios.create', compact('roles', 'areas'));
    }

    // Guardar un nuevo usuario
    public function store(Request $request)
    {
        // Validación de los campos
        $request->validate([
            'name' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:10', // Límite de 10 caracteres en teléfono
            'email' => 'required|email|max:255|unique:users,email',
            'id_area' => 'required|exists:areas,id',
            'password' => 'required|string|confirmed|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'rol' => 'required|exists:roles,name',
        ]);
        
    
        // Manejar la subida de la imagen
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile_images', 'public');
        } else {
            $imagePath = null;
        }
    
        // Crear el usuario con la contraseña encriptada
        $usuario = User::create([
            'name' => $request->input('name'),
            'apellido_paterno' => $request->input('apellido_paterno'),
            'apellido_materno' => $request->input('apellido_materno'),
            'telefono' => $request->input('telefono'),
            'email' => $request->input('email'),
            'id_area' => $request->input('id_area'),
            'password' => Hash::make($request->input('password')), // Encriptar la contraseña
            'image' => $imagePath,
        ]);
    
        // Asignar el rol al usuario
        $usuario->assignRole($request->input('rol'));
    
        // Redirigir con mensaje de éxito
        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }
    

    // Mostrar formulario de edición
    public function edit($id)
    {
        $usuario = User::findOrFail($id); // Encuentra el usuario o lanza un error 404 si no existe
        $areas = Area::all(); // Asegúrate de que este modelo está correctamente configurado
        $roles = Role::all(); // Obtiene todos los roles disponibles
    
        return view('usuarios.editar', compact('usuario', 'areas', 'roles')); // Pasa los datos necesarios a la vista
    }
    
    // Actualizar un usuario existente
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
    
        // Validación de los campos
        $request->validate([
            'name' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'required|email|max:255|unique:users,email,' . $usuario->id,
            'id_area' => 'required|exists:areas,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Manejar la subida de la imagen
        if ($request->hasFile('image')) {
            // Eliminar la imagen anterior si existe
            if ($usuario->image) {
                Storage::delete('public/' . $usuario->image);
            }
    
            // Almacenar la nueva imagen
            $imagePath = $request->file('image')->store('profile_images', 'public');
            $usuario->image = $imagePath;
        }
    
        // Actualizar los demás campos
        $usuario->name = $request->input('name');
        $usuario->apellido_paterno = $request->input('apellido_paterno');
        $usuario->apellido_materno = $request->input('apellido_materno');
        $usuario->telefono = $request->input('telefono');
        $usuario->email = $request->input('email');
        $usuario->id_area = $request->input('id_area');
    
        $usuario->save();
    
        // Redirigir con mensaje de éxito
        return redirect()->route('usuarios.index')->with('success', 'Perfil actualizado correctamente.');
    }
    
    

    // Eliminar un usuario
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }

    public function checkEmail(Request $request)
{
    $email = $request->input('email');

    // Verifica si el email ya existe en la base de datos
    $exists = User::where('email', $email)->exists();

    return response()->json(['exists' => $exists]);
}
public function profile()
{
    $usuario = Auth::user();
    return view('usuarios.show', compact('usuario')); // Cambiado de 'usuarios.profile' a 'usuarios.profile.show'
}

public function editProfile()
{
    $usuario = Auth::user();
    $areas = Area::all();
    return view('usuarios.profile.edit', compact('usuario', 'areas'));
}


public function updateProfile(Request $request)
{
    $usuario = Auth::user();

    // Validar los datos del formulario
    $request->validate([
        'name' => 'required|string|max:255',
        'apellido_paterno' => 'required|string|max:255',
        'apellido_materno' => 'nullable|string|max:255',
        'email' => 'required|email|unique:users,email,' . $usuario->id,
        'telefono' => 'nullable|string|max:10',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'current_password' => 'nullable|string', // Hacer opcional la contraseña actual
        'password' => 'nullable|string|confirmed|min:8', // Hacer opcional la nueva contraseña
    ]);

    // Validar y actualizar la contraseña solo si los campos están presentes
    if ($request->filled('current_password') && $request->filled('password')) {
        // Verificar si la contraseña actual es incorrecta
        if (!Hash::check($request->current_password, $usuario->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta.'])->withInput();
        }

        // Actualizar la contraseña si la actual es válida
        $usuario->password = Hash::make($request->password);
    }

    // Manejar la imagen de perfil
    if ($request->hasFile('image')) {
        if ($usuario->image) {
            Storage::delete('public/' . $usuario->image);
        }
        $usuario->image = $request->file('image')->store('profile_images', 'public');
    }

    // Actualizar datos personales
    $usuario->name = $request->name;
    $usuario->apellido_paterno = $request->apellido_paterno;
    $usuario->apellido_materno = $request->apellido_materno;
    $usuario->email = $request->email;
    $usuario->telefono = $request->telefono;

    $usuario->save();

    // Mensaje de éxito
    session()->flash('success', '¡Perfil actualizado exitosamente!');

    return redirect()->route('usuarios.profile');
}



}
