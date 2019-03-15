<?php

namespace App\Http\Controllers\Dashboard;

use App\City;
use App\District;
use App\Editor;
use App\Exhibition;
use App\Institution;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ExhibitionsController extends Controller
{
    /**
     * Show the Exhibitions list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard', ['exhibitions' => Exhibition::paginate(10)]);
    }

    /**
     * Show edit Exhibition form.
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function newForm()
    {
        $districts = District::where('city_id', City::first()->id)->get();
        $institutions = Institution::where('city_id', City::first()->id)->get();
        $editors = Editor::whereHas('cities', function($q){
            $q->where('city_id', '=', City::first()->id);
        })->get();

        return view('dashboard', [
                'cities' => City::all(),
                'districts' => $districts,
                'institutions' => $institutions,
                'editors' => $editors
            ]);
    }

    /**
     * Show edit Exhibition form.
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function editForm($id)
    {
        $exhibition = Exhibition::find($id);
        $districts = District::where('city_id', $exhibition->cities()->first()->id)->get();
        $institutions = Institution::where('city_id', $exhibition->cities()->first()->id)->get();
        $editors = Editor::whereHas('cities', function($q) use ($exhibition){
            $q->where('city_id', '=', $exhibition->cities()->first()->id);
        })->get();

        return view('dashboard', [
            'exhibition' => $exhibition,
            'cities' => City::all(),
            'districts' => $districts,
            'institutions' => $institutions,
            'editors' => $editors,
        ]);
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
            'press_release' => 'string',
            'open' => 'required|string',
            'expired' => 'required|string',
            'images.*' => 'mimes:jpeg,jpg,png|max:1000'
        ]);
    }

    /**
     * Save Exhibition.
     * @param $request Request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        try {
            $this->validator($request->all())->validate();

            if(isset($request->id)) {
                $exhibition = Exhibition::find($request['id']);
            } else {
                $exhibition = new Exhibition();
            }

            $exhibition->name = $request['name'];
            $exhibition->press_release = $request['press_release'];
            $exhibition->open = $request['open'];
            $exhibition->expired = $request['expired'];
            $exhibition->institution_id = $request['institution_id'];
            $exhibition->save();

            foreach($exhibition->cities->pluck('id')->toArray() as $city) {
                $exhibition->cities()->detach($city);
            }

            $exhibition->cities()->attach($request['city_id']);

            foreach($exhibition->districts->pluck('id')->toArray() as $district) {
                $exhibition->districts()->detach($district);
            }

            $exhibition->districts()->attach($request['district_id']);

            foreach($exhibition->editors->pluck('id')->toArray() as $editor) {
                $exhibition->editors()->detach($editor);
            }

            foreach($request['editors'] as $editor_id) {
                $exhibition->editors()->attach($editor_id);
            }

            foreach($exhibition->images->pluck('id')->toArray() as $image) {
                $exhibition->images()->detach($image);
                $imageC = new ImagesController();

                $imageC->removeIfNotUsed($image);
            }

            if(is_array($request->file('images'))) {
                foreach($request->file('images') as $file) {
                    $image = new ImagesController();
                    $exhibition->images()->attach($image->create($file));
                }
            }

            if(is_array($request['old_images'])) {
                foreach($request['old_images'] as $old_image) {
                    $exhibition->images()->attach($old_image);
                }
            }

            return redirect()->route('exhibitions_list');
        } catch (Exception $e) {
            return view('dashboard', ['error'=> $e->getMessage()]);
        }
    }

    /**
     * Remove Exhibition.
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function remove($id) {
        try {
            $exhibition = Exhibition::find($id);

            foreach($exhibition->cities->pluck('id')->toArray() as $city) {
                $exhibition->cities()->detach($city);
            }

            foreach($exhibition->districts->pluck('id')->toArray() as $district) {
                $exhibition->districts()->detach($district);
            }

            foreach($exhibition->images->pluck('id')->toArray() as $image) {
                $exhibition->images()->detach($image);
                $imageC = new ImagesController();

                $imageC->removeIfNotUsed($image);
            }

            foreach($exhibition->editors->pluck('id')->toArray() as $editor) {
                $exhibition->editors()->detach($editor);
            }

            $exhibition->delete();
            return redirect()->route('exhibitions_list');
        } catch (Exception $e) {
            return view('dashboard', ['error'=> $e->getMessage()]);
        }
    }
}
