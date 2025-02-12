<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;

class UserController extends Controller
{

    public function index() {

        $users = User::all();

        return view('pages.users.index', [
            'users' => $users
        ]);

    }

    public function create() {

        $user = new User();

        return view('pages.users.form', [
            'user' => $user
        ]);

    }

    public function store(Request $request) {

        $validator = $this->validation($request);

        if (!$validator->fails()) {

            try {

                $user = new User();

                $this->save($user, $request);

                return redirect('users')->withSuccess('Usuário criado com sucesso!');

            } catch (\Throwable $e) {

                return redirect()->withErrors($e->getMessage())->withInput(); 
 
            }
        }
        
        return redirect()->withErrors($validator->errors()->first())->withInput(); 
    }

    public function edit($id) {
        
        if ($id && is_numeric($id)) {

            $user = User::findById($id)->first();

            return view('pages.users.form', [
                'user' => $user
            ]);
        }

    }

    public function update(Request $request, $id) {
        
        $request->merge(['id' => $id]);
        $validator = $this->validation($request);

        if (!$validator->fails()) {

            $user = User::findById($id)->first();

            if ($user) {

                $this->save($user, $request);

                return redirect('users')->withSuccess('Usuário atualizado com sucesso!');

            }

            return redirect()->withErrors('Usuário não encontrado')->withInput();
        }

        return redirect()->withErrors('Dados Inválidos.')->withInput(); 
    }

    private function save(User $user, Request $request) {

        $user->name = $request->name;
        $user->email = $request->email;
        $user->created_at = time();
        $user->updated_at = time();

        $user->save();
    }


    public function destroy($id) {

        if ($id && is_numeric($id)) {

            $user = User::findOrFail($id)->first();

            if ($user) {

                $user->delete();

                return redirect('users')->withSuccess('Usuário deletado com sucesso!');
            }

            return redirect()->withErrors('Usuário não encontrado')->withInput(); 
        }
    }

    private function validation(Request $request) {

        $uniqueEmailRule = new Unique(User::class, 'email');

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', $uniqueEmailRule]
        ]);

        $validator->sometimes('id', 'required|numeric', function ($request) {
            return $request->_method == 'PUT';
        });

        return $validator;
    }
}
