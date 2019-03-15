<?php

namespace App\Http\Controllers\Dashboard;

use App\City;
use App\Editor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EditorsController extends Controller
{
    /**
     * Show the editors list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard', ['editors' => Editor::paginate(10)]);
    }

    /**
     * Show edit editor form.
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function newForm()
    {
        return view('dashboard', ['cities' => City::all()]);
    }

    /**
     * Show edit editor form.
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function editForm($id)
    {
        return view('dashboard', ['editor' => Editor::find($id), 'cities' => City::all()]);
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
            'description' => 'string',
        ]);
    }

    /**
     * Save editor.
     * @param $request Request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        try {
            $this->validator($request->all())->validate();

            if(isset($request->id)) {
                $editor = Editor::find($request['id']);
            } else {
                $editor = new Editor();
            }

            $editor->name = $request['name'];
            $editor->description = $request['description'];
            $editor->save();

            foreach($editor->cities->pluck('id')->toArray() as $city) {
                $editor->cities()->detach($city);
            }

            foreach($request['city_id'] as $city_id) {
                $editor->cities()->attach($city_id);
            }

            return redirect()->route('editors_list');
        } catch (Exception $e) {
            return view('dashboard', ['error'=> $e->getMessage()]);
        }
    }

    /**
     * Remove editor.
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function remove($id) {
        try {
            $editor = Editor::find($id);

            if($this->checkIfUsed($id)) {
                return redirect()->route('editors_list')->withErrors(['used' => 'This record used!']);
            }

            foreach($editor->cities->pluck('id')->toArray() as $city) {
                $editor->cities()->detach($city);
            }

            $editor->delete();
            return redirect()->route('editors_list');
        } catch (Exception $e) {
            return view('dashboard', ['error'=> $e->getMessage()]);
        }
    }

    /**
     * Check if editor used.
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function checkIfUsed($id) {
        try {
            $editor = Editor::find($id);
            if(count($editor->exhibitions()->get()->toArray()) > 0) {
                return true;
            }

            return false;
        } catch (Exception $e) {
            return view('dashboard', ['error'=> $e->getMessage()]);
        }
    }
}
