<?php

namespace App\Http\Controllers\Dashboard;

use App\City;
use App\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DistrictsController extends Controller
{
    /**
     * Show the districts list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard', ['districts' => District::paginate(10)]);
    }

    /**
     * Show edit district form.
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function newForm()
    {
        return view('dashboard', ['cities' => City::all()]);
    }

    /**
     * Show edit district form.
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function editForm($id)
    {
        return view('dashboard', ['district' => District::find($id), 'cities' => City::all()]);
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
            'city_id' => 'required|integer',
        ]);
    }

    /**
     * Save district.
     * @param $request Request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        try {
            $this->validator($request->all())->validate();

            if(isset($request->id)) {
                $district = District::find($request['id']);
            } else {
                $district = new District();
            }

            $district->name = $request['name'];
            $district->city_id = $request['city_id'];

            $district->save();
            return redirect()->route('districts_list');
        } catch (Exception $e) {
            return view('dashboard', ['error'=> $e->getMessage()]);
        }
    }

    /**
     * Remove district.
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function remove($id) {
        try {
            $district = District::find($id);

            if($this->checkIfUsed($id)) {
                return redirect()->route('districts_list')->withErrors(['used' => 'This record used!']);
            }

            $district->delete();
            return redirect()->route('districts_list');
        } catch (Exception $e) {
            return view('dashboard', ['error'=> $e->getMessage()]);
        }
    }

    /**
     * Check if district used.
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function checkIfUsed($id) {
        try {
            $district = District::find($id);
            if(count($district->exhibitions()->get()->toArray()) > 0) {
                return true;
            }

            return false;
        } catch (Exception $e) {
            return view('dashboard', ['error'=> $e->getMessage()]);
        }
    }
}
