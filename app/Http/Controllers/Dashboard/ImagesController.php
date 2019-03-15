<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Image;
use App\Image as ImageModel;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class ImagesController extends Controller
{
    private $sizes = array(
        'thumbnail' => array(200,200),
        'middle' => array(600,600),
        'big' => array(900, 900)
    );

    /**
     * Show the images list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = new ImageModel();
        return view('dashboard', ['images' => $images->where('parent', 0)->paginate(5)]);
    }

    /**
     * Show edit image form.
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function newForm()
    {
        return view('dashboard');
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
            'image' => 'required|mimes:jpeg,bmp,png',
        ]);
    }

    /**
     * Save image.
     * @param $request Request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        try {
            $this->validator($request->all())->validate();

            $this->create($request->file('image'));
            return redirect()->route('images_list');
        } catch (Exception $e) {
            return view('dashboard', ['error'=> $e->getMessage()]);
        }
    }

    /**
     * Remove image.
     * @param $id integer
     * @return \Illuminate\Http\Responsegit
     */
    public function remove($id) {
        $image = ImageModel::find($id);
        try {
            $sizes = new ImageModel();
            foreach($sizes->where('parent', $image->id)->get() as $image_item) {
                if(is_file(public_path().'/'.$image_item->url)) {
                    unlink(public_path() . '/' . $image_item->url);
                }
                $image_item->delete();
            }

            if(is_file(public_path().'/'.$image->url)) {
                unlink(public_path() . '/' . $image->url);
            }

            $image->delete();
            return redirect()->route('images_list');
        } catch (Exception $e) {
            return view('dashboard', ['error'=> $e->getMessage()]);
        }
    }

    /**
     * Get thumbnail size.
     * Will return original image size if specific size doesn't created
     * @return \Illuminate\Http\Response
     */
    static public function getImageBySize($id, $size)
    {
        $thumbnail = new ImageModel();
        if(!is_null($thumbnail->where('parent', $id)->where('size', $size)->first()))
            return $thumbnail->where('parent', $id)->where('size', $size)->first();
        else
            return ImageModel::find($id);
    }

    /**
     * Create image or return id if exists.
     * @return integer
     */
    public function create($imageSrc) {
        if($imageSrc) {
            if($image_id = $this->checkIfExists($imageSrc)) {
                return $image_id;
                exit;
            }

            $parent = 0;
            $uploadDir = public_path('storage/images');
            if (!is_dir($uploadDir))
                mkdir($uploadDir);

            $uploadDir .= '/' . date("Y");
            if (!is_dir($uploadDir))
                mkdir($uploadDir);

            $uploadDir .=  '/' . date('m');
            if (!is_dir($uploadDir))
                mkdir($uploadDir);

            $title = basename($imageSrc->getClientOriginalName(), '.'.$imageSrc->getClientOriginalExtension());
            $imageName = $imageSrc->getClientOriginalName();
            $imageHash = md5(file_get_contents($imageSrc->path()));
            $imageSrc->move($uploadDir, $imageName);
            $image = Storage::url('images/' . date( "Y" ) . '/' . date( 'm' ) . '/' . $imageName);

            $imageModel = new ImageModel();
            $imageModel->name = $title;
            $imageModel->type = $imageSrc->getClientOriginalExtension();
            $imageModel->url = $image;
            $imageModel->author = 1;
            $imageModel->parent = 0;
            $imageModel->size = 'original';
            $imageModel->hash = $imageHash;

            if($imageModel->save()) {
                $parent = $imageModel->id;
                foreach ($this->sizes as $size_title=> $size) {
                    $thumb_img = Image::make($uploadDir . '/' . $imageName)->fit($size[0], $size[1]);
                    $resized_title = $title . '-' . $size[0] . 'x' . $size[1] . '.' . $imageSrc->getClientOriginalExtension();
                    $thumb_img->save($uploadDir . '/' . $resized_title, 80);

                    $imageModel = new ImageModel();
                    $imageModel->name = $title;
                    $imageModel->type = $imageSrc->getClientOriginalExtension();
                    $imageModel->url = Storage::url('images/' . date( "Y" ) . '/' . date( 'm' ) . '/' . $resized_title);
                    $imageModel->author = 1;
                    $imageModel->parent = $parent;
                    $imageModel->size = $size_title;
                    $imageModel->hash = md5(file_get_contents($uploadDir . '/' . $imageName));
                    $imageModel->save();
                }
                return $parent;
            } else {
                throw new Exception('Something went wrong!');
            }
        }
    }

    /**
     * Check if image used.
     * @return \Illuminate\Http\Response
     */
    public function removeIfNotUsed($image_id) {
        $image = ImageModel::find($image_id);

        if(count($image->users()->get()->toArray()) > 0) {
            return true;
        }

        if(count($image->exhibitions()->get()->toArray()) > 0) {
            return true;
        }

        $this->remove($image_id);
    }

    /**
     * Check if image exists.
     * @return \Illuminate\Http\Response
     */
    protected function checkIfExists($imageSrc) {
        $newHash = md5(file_get_contents($imageSrc->path()));
        $image = new ImageModel();
        if(!is_null($image->where('hash', $newHash)->first()))
            return $image->where('hash', $newHash)->first()->id;

        return false;
    }
}
