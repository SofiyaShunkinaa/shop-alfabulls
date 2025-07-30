<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dogs;
use App\Models\DogMedia;
use Illuminate\Support\Facades\Storage;

class DogsController extends Controller {

    private $imageSaver;

    public function __construct(ImageSaver $imageSaver) {
        $this->imageSaver = $imageSaver;
    }

    /**
     * Показывает список всех товаров
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $products = Dogs::with('media')->paginate(5);
        return view('admin.dogs.index', compact('products'));
    }



    /**
     * Показывает форму для создания товара
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view('admin.dogs.create');
    }

    /**
     * Сохраняет новый товар в базу данных
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //dd($request);
        $data = $request->only(['name', 'slug', 'date', 'pric', 'opis', 'type', 'oldprice', 'sale', 'baseprice']);
        $dog = Dogs::create($data);

        // Загрузка изображений
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                if ($image->isValid()) {
                    $path = $image->store('dogs/images', 'public');
                    $dog->media()->create([
                        'path' => $path,
                        'type' => 'image',
                    ]);
                }
            }
        }

        // Загрузка видео
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                if ($video->isValid()) {
                    $path = $video->store('dogs/videos', 'public');
                    $dog->media()->create([
                        'path' => $path,
                        'type' => 'video',
                    ]);
                }
            }
        }

        return redirect()->route('admin.dogs.index')
                        ->with('success', 'Новый щенок успешно создан');
    }

    /**
     * Показывает страницу товара
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Dogs $product) {
        return view('admin.dogs.show', compact('product'));
    }

    /**
     * Показывает форму для редактирования товара
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
     public function edit(Dogs $dog) {

        return view('admin.dogs.edit', compact('dog'));
    }

    /**
     * Обновляет товар каталога в базе данных
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dogs $dog) {
        $data = $request->only(['name', 'slug', 'date', 'pric', 'opis', 'type', 'oldprice', 'sale', 'baseprice']);
        $dog->update($data);
        // Удаляем изображения, которые пользователь убрал
        $existingImageIds = $request->input('existing_images', []);
        $existingVideoIds = $request->input('existing_videos', []);
        // Удаляем изображения, которых больше нет в списке
$dog->media()->where('type', 'image')
    ->whereNotIn('id', $existingImageIds)
    ->get()
    ->each(function ($media) {
        Storage::disk('public')->delete($media->path);
        $media->delete();
    });

    // Удаляем видео, которых больше нет в списке
    $dog->media()->where('type', 'video')
        ->whereNotIn('id', $existingVideoIds)
        ->get()
        ->each(function ($media) {
            Storage::disk('public')->delete($media->path);
            $media->delete();
        });

        // Добавляем новые фото
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                if ($image->isValid()) {
                    $path = $image->store('dogs/images', 'public');
                    $dog->media()->create([
                        'path' => $path,
                        'type' => 'image',
                    ]);
                }
            }
        }

        // Добавляем новые видео
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                if ($video->isValid()) {
                    $path = $video->store('dogs/videos', 'public');
                    $dog->media()->create([
                        'path' => $path,
                        'type' => 'video',
                    ]);
                }
            }
        }

        return redirect()->route('admin.dogs.index')
                        ->with('success', 'Щенок обновлен');
    }

    public function deleteMedia(DogMedia $media)
    {
        Storage::disk('public')->delete($media->path);
        $media->delete();

        return response()->json(['success' => true]);
    }

    
    public function destroy(Dogs $dog) {
        $this->imageSaver->remove($dog, 'product');
        $dog->delete();
        return redirect()
            ->route('admin.dogs.index')
            ->with('success', 'Щенок каталога успешно удален');
    }
}
