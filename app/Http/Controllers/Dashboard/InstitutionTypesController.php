<?php

namespace App\Http\Controllers\Dashboard;

use App\InstitutionType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class InstitutionTypesController extends Controller
{
    /**
     * Show the Institution Types list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard', ['institution_types' => InstitutionType::paginate(10)]);
    }

    /**
     * Show edit Institution Type form.
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function newForm()
    {
        return view('dashboard');
    }

    /**
     * Show edit Institution Type form.
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function editForm($id)
    {
        return view('dashboard', ['institution_type' => InstitutionType::find($id)]);
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
            'name' => 'required|string|max:255',
        ]);
    }

    /**
     * Save Institution Type.
     * @param $request Request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        try {
            $this->validator($request->all())->validate();

            if(isset($request->id)) {
                $institution_type = InstitutionType::find($request['id']);
            } else {
                $institution_type = new InstitutionType();
            }

            $institution_type->name = $request['name'];

            $institution_type->save();
            return redirect()->route('institution_types_list');
        } catch (Exception $e) {
            return view('dashboard', ['error'=> $e->getMessage()]);
        }
    }

    /**
     * Remove Institution Type.
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function remove($id) {
        try {
            if($this->checkIfUsed($id))
                return redirect()->route('institution_types_list')->withErrors(['used' => 'This record used!']);

            $institution_type = InstitutionType::find($id);
            $institution_type->delete();
            return redirect()->route('institution_types_list');
        } catch (Exception $e) {
            return view('dashboard', ['error'=> $e->getMessage()]);
        }
    }

    /**
     * Check if InstitutionType used.
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function checkIfUsed($id) {
        try {
            $institution_type = InstitutionType::find($id);
            if(count($institution_type->institutions()->get()->toArray()) > 0) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            return view('dashboard', ['error'=> $e->getMessage()]);
        }
    }
}
