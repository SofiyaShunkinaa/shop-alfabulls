<?php
namespace App\Http\Controllers;

use App\Models\Otzv;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Helpers\ImageSaver;

class OtzvController extends Controller {


    private $imageSaver;

    public function __construct(ImageSaver $imageSaver) {
        $this->imageSaver = $imageSaver;
    }


   public function __invoke(){

   }


    public function store(Request $request)
{


    $data = [
        'name' => auth()->user()->name,
        // 'file' => $request->file,
        'rating' => $request->rating,
        'text' => $request->text,
        'status' => '0'
    ];

    

    $file = $request->file('file');
    $isVideo = false;

    if ($file !== null) {
        $isVideo = str_starts_with($file->getMimeType(), 'video/');

        if ($isVideo) {
        
            $filePath = $file->store('public/reviews/videos');
            $data['file'] = str_replace('public/', '', $filePath);
            // $data['type'] = $file->getMimeType();
        } else {
            $filePath = $file->store('public/reviews/images');
            $data['file'] = str_replace('public/', '', $filePath);
            // $data['type'] = $file->getMimeType();
        }
    }

    



    // Создаем отзыв
    Otzv::create($data);

    return redirect('/')
        ->with('success', 'Ваш отзыв отправлен на модерацию');
}


}
