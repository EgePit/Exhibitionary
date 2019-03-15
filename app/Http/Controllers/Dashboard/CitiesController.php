<?php

namespace App\Http\Controllers\Dashboard;

use App\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CitiesController extends Controller
{
    /**
     * Show the cities list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard', ['cities' => City::paginate(10)]);
    }

    /**
     * Show edit city form.
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function newForm()
    {
        return view('dashboard');
    }

    /**
     * Show edit city form.
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function editForm($id)
    {
        return view('dashboard', ['city' => City::find($id)]);
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
            'code' => 'required|string|max:255',
        ]);
    }

    /**
     * Save city.
     * @param $request Request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        try {
            $this->validator($request->all())->validate();

            if(isset($request->id)) {
                $city = City::find($request['id']);
            } else {
                $city = new City();
            }

            $city->name = $request['name'];
            $city->code = $request['code'];

            $city->save();
            return redirect()->route('cities_list');
        } catch (Exception $e) {
            return view('dashboard', ['error'=> $e->getMessage()]);
        }
    }

    /**
     * Remove city.
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function remove($id) {
        try {
            $city = City::find($id);

            if($this->checkIfUsed($id)) {
                return redirect()->route('cities_list')->withErrors(['used' => 'This record used!']);
            }

            $city->delete();
            return redirect()->route('cities_list');
        } catch (Exception $e) {
            return view('dashboard', ['error'=> $e->getMessage()]);
        }
    }

    /**
     * Check if city used.
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function checkIfUsed($id) {
        try {
            $city = City::find($id);
            if(count($city->exhibitions()->get()->toArray()) > 0) {
                return true;
            }

            if(count($city->editors()->get()->toArray()) > 0) {
                return true;
            }

            if(count($city->institutions()->get()->toArray()) > 0) {
                return true;
            }

            if(count($city->districts()->get()->toArray()) > 0) {
                return true;
            }

            return false;
        } catch (Exception $e) {
            return view('dashboard', ['error'=> $e->getMessage()]);
        }
    }
}
