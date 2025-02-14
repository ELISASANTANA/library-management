<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;

class UserController extends Controller
{

    /**
     * Indexa lista de usuários na view
     *
     * @return void
     */
    public function index() {

        $users = User::all();

        return view('pages.users.index', [
            'users' => $users
        ]);

    }

    /**
     * Redireciona ao formulário de cadastro
     *
     * @return void
     */
    public function create() {

        $user = new User();

        return view('pages.users.form', [
            'user' => $user
        ]);

    }

    /**
     * Persite os dados do cadastro no banco de dados
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request) {

        $validator = $this->validation($request);

        if (!$validator->fails()) {

            try {

                $user = new User();

                $this->save($user, $request);

                return redirect('users')->withSuccess('Usuário criado com sucesso!');

            } catch (\Throwable $e) {

                return back()->withErrors($e->getMessage()); 
 
            }
        }
        
        return back()->response($validator->errors()->first()); 
    }

    /**
     * Redireciona ao formulário de edição
     *
     * @param [type] $id
     * @return void
     */
    public function edit($id) {
        
        if ($id && is_numeric($id)) {

            $user = User::findById($id)->first();

            return view('pages.users.form', [
                'user' => $user
            ]);
        }

    }

    /**
     * Atualiza as informações no banco
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function update(Request $request, $id) {
        
        $request->merge(['id' => $id]);
        $validator = $this->validation($request);

        if (!$validator->fails()) {

            $user = User::findById($id)->first();

            if ($user) {

                $this->save($user, $request);

                return redirect('users')->withSuccess('Usuário atualizado com sucesso!');

            }

            return back()->withErrors('Usuário não encontrado');
        }

        return back()->withErrors($validator->errors()->first()); 
    }

    /**
     * Salva os dados
     *
     * @param User $user
     * @param Request $request
     * @return void
     */
    private function save(User $user, Request $request) {

        $user->name = $request->name;
        $user->email = $request->email;
        $user->created_at = time();
        $user->updated_at = time();

        $user->save();
    }


    /**
     * Excluir dado do banco
     *
     * @param [type] $id
     * @return void
     */
    public function destroy($id) {

        if ($id && is_numeric($id)) {

            $user = User::findOrFail($id)->first();

            if ($user) {

                $user->delete();

                return redirect('users')->withSuccess('Usuário deletado com sucesso!');
            }

            return back()->withErrors('Usuário não encontrado')->withInput(); 
        }
    }

    /**
     * Validação dos dados inputados
     *
     * @param Request $request
     * @return
     */
    private function validation(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'email' => ['required', 'email']
        ]);

        $validator->sometimes('id', 'required|numeric', function ($request) {
            return $request->_method == 'PUT';
        });

        return $validator;
    }
}
