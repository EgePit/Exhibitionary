<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class UsersController extends Controller
{
    /**
     * Show the users list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard', ['users' => User::paginate(10)]);
    }

    /**
     * Show edit user form.
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function newForm()
    {
        return view('dashboard');
    }

    /**
     * Show edit user form.
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function editForm($id)
    {
        return view('dashboard', ['user' => User::find($id)]);
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
            'firstname' => 'required|string|max:255',
            'lastname' => 'string|max:255',
            'email' => 'required|string|email|max:255',
            'photo' => 'mimes:jpeg,bmp,png',
            'whois' => 'required|string'
        ]);
    }

    /**
     * Save user.
     * @param $request Request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        try {
            $this->validator($request->all())->validate();
            if(isset($request->id)) {
                $user = User::find($request['id']);
            } else {
                $user = new User();
                $user->password = bcrypt(time().$request['email']);
            }

            $user->firstname = $request['firstname'];
            $user->lastname = $request['lastname'];
            $user->email = $request['email'];
            $user->biography = $request['biography'];
            $user->whois = $request['whois'];
            $user->newsletters_subs = $request['newsletters_subs'] ? true : false;
            $user->is_admin = $request['is_admin'] ? true : false;;

            $image = new ImagesController();
            if($request->photo) {
                $user->photo_id = $image->create($request->file('photo'));
            } else if($request->old_photo) {
                $user->photo_id = $request->old_photo;
            } else {
                $user->photo_id = 0;
            }

            $user->save();

            $image->removeIfNotUsed($request->old_photo);

            return redirect()->route('users_list');
        } catch (Exception $e) {
            return view('dashboard', ['error'=> $e->getMessage()]);
        }
    }

    /**
     * Remove user.
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function remove($id) {
        $user = User::find($id);
        try {
            $user->delete();
            return redirect()->route('users_list');
        } catch (Exception $e) {
            return view('dashboard', ['error'=> $e->getMessage()]);
        }
    }
}
