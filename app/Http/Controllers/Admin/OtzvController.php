<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

    /**
     * Показывает Страницу отзывов
     */


public function index(Request $request) {
        $showArchived = $request->get('archived', false);
        $reviews = Otzv::where('archived', $showArchived)->paginate(5);
        return view('admin.reviews.index', compact('reviews', 'showArchived'));
    }

    public function create() {

        return view('admin.reviews.create');
    }


    public function store(Request $request)
    {

        $data = [
            'name' => $request->name,
            // 'file' => $request->file,
            'rating' => $request->rating,
            'text' => $request->text,
            'status' => '0'
        ];

        

        $file = $request->file('file');
        $isVideo = false;

        if ($file !== null) {
            $videoExtensions = ['mp4', 'webm', 'ogg', 'mov', 'avi'];
            $isVideo = in_array($file->getClientOriginalExtension(), $videoExtensions);

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

            return redirect()
            ->route('admin.reviews.index')
            ->with('success', 'Новый отзыв сохранен');
        
        
    }

    public function approve($id)
    {
        $review = Otzv::findOrFail($id);
        $review->status = 1;
        $review->save();

        return back()->with('success', 'Отзыв одобрен');
    }

    public function destroy($id)
    {
        $review = Otzv::findOrFail($id);
        $review->delete();

        return back()->with('success', 'Отзыв удален');
    }

    public function archive($id)
    {
        $review = Otzv::findOrFail($id);
        $review->archived = ! $review->archived;
        $review->save();

        return redirect()->back()->with('success', 'Отзыв обновлен.');
    }


}
