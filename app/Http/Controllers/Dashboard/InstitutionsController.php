<?php

namespace App\Http\Controllers\Dashboard;

use App\City;
use App\Institution;
use App\InstitutionType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class InstitutionsController extends Controller
{
    /**
     * Show the institutions list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard', ['institutions' => Institution::paginate(10)]);
    }

    /**
     * Show edit institution form.
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function newForm()
    {
        return view('dashboard', ['cities' => City::all(), 'types' => InstitutionType::all()]);
    }

    /**
     * Show edit institution form.
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function editForm($id)
    {
        return view('dashboard', ['institution' => Institution::find($id), 'cities' => City::all(), 'types' => InstitutionType::all()]);
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
            'address' => 'required|string',
            'hours' => 'required|string',
            'website' => 'string',
            'phone' => 'string',
            'email' => 'email',
        ]);
    }

    /**
     * Save institution.
     * @param $request Request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        try {
            $this->validator($request->all())->validate();

            if(isset($request->id)) {
                $institution = Institution::find($request['id']);
            } else {
                $institution = new Institution();
            }

            $institution->name = $request['name'];
            $institution->address = $request['address'];
            $institution->hours = $request['hours'];
            $institution->website = $request['website'];
            $institution->phone = $request['phone'];
            $institution->email = $request['email'];
            $institution->city_id = $request['city_id'];
            $institution->type_id = $request['type_id'];

            $institution->save();
            return redirect()->route('institutions_list');
        } catch (Exception $e) {
            return view('dashboard', ['error'=> $e->getMessage()]);
        }
    }

    /**
     * Remove institution.
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function remove($id) {
        try {
            $institution = Institution::find($id);

            if($this->checkIfUsed($id)) {
                return redirect()->route('institutions_list')->withErrors(['used' => 'This record used!']);
            }

            $institution->delete();
            return redirect()->route('institutions_list');
        } catch (Exception $e) {
            return view('dashboard', ['error'=> $e->getMessage()]);
        }
    }

    /**
     * Check if institution used.
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function checkIfUsed($id) {
        try {
            $institution = Institution::find($id);
            if(count($institution->exhibition()) > 0) {
                return true;
            }

            return false;
        } catch (Exception $e) {
            return view('dashboard', ['error'=> $e->getMessage()]);
        }
    }
}
