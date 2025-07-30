<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promo;
use Illuminate\Support\Carbon;

class PromoController extends Controller {

    private $imageSaver;

    public function __construct(ImageSaver $imageSaver) {
        $this->imageSaver = $imageSaver;
    }

    /**
     * Показывает список всех товаров
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $showArchived = $request->get('archived', false);
        $products = Promo::where('archived', $showArchived)->paginate(5);
        return view('admin.promo.index', compact('products', 'showArchived'));
    }

    public function archive(Promo $promo)
    {
        $promo->archived = ! $promo->archived;
        $promo->save();

        return redirect()->back()->with('success', 'Промокод обновлен.');
    }
    public function active(Promo $promo)
    {
        
        $promo->active = ! $promo->active;
        $promo->save();

        if($promo->active == 0){
            return redirect()->back()->with('success', 'Промокод остановлен.');
        }else{
            return redirect()->back()->with('success', 'Промокод активирован.');
        }        
    }


    /**
     * Показывает форму для создания товара
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view('admin.promo.create');
    }

    /**
     * Сохраняет новый товар в базу данных
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'datastart' => 'required|date',
            'datastop' => 'required|date|after_or_equal:datastart',
            'pric' => 'required|numeric|min:0',
        ]);

        Promo::create([
            'name' => $validated['name'],
            'datastart' => $validated['datastart'],
            'datastop' => $validated['datastop'],
            'pric' => $validated['pric'],
            'active' => false,
            'archived' => false,
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Показывает страницу товара
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Promo $product) {
        return view('admin.promo.show', compact('product'));
    }

    /**
     * Показывает форму для редактирования товара
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Promo $promo) {

        return view('admin.promo.edit', compact('promo'));
    }

    /**
     * Обновляет товар каталога в базе данных
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promo $product) {
        $request->merge([
            'new' => $request->has('new'),
            'hit' => $request->has('hit'),
            'sale' => $request->has('sale'),
        ]);

        $product = Promo::findOrFail($request->id);

        $data = $request->all();
        $product->update($data);

        return redirect()
            ->route('admin.promo.index')
            ->with('success', 'Промокод был успешно обновлен');
    }

    /**
     * Удаляет товар каталога из базы данных
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promo $product) {
        $this->imageSaver->remove($product, 'product');
        $product->delete();
        return redirect()
            ->route('admin.promo.index')
            ->with('success', 'Промокод каталога успешно удален');
    }
}
