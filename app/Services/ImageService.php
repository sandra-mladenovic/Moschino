<?php
namespace App\Services;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ImageService{

    public function uploadImage($image){
        return $this->upload($image);
    }


    private function upload(UploadedFile $image) {
        $fileName = time() . "_" . $image->getClientOriginalName();
        $image->move(public_path() . "/assets/images/", $fileName);
        return $fileName;
    }
}
