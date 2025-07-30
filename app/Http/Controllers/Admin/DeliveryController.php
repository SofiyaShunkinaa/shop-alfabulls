<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Delivery;

class DeliveryController extends Controller {

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
        $items = Delivery::paginate(10);
        return view('admin.delivery.index', compact('items'));
    }



    /**
     * Показывает форму для создания товара
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view('admin.delivery.create');
    }

    /**
     * Сохраняет новый товар в базу данных
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = $request->all();
        $delivery = Delivery::create($data);
        return redirect()
            ->route('admin.delivery.index')
            ->with('success', 'Доставка добавлена');
    }

    /**
     * Показывает страницу товара
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Delivery $delivery) {
        return view('admin.delivery.show', compact('delivery'));
    }

    /**
     * Показывает форму для редактирования товара
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Delivery $delivery) {

        return view('admin.delivery.edit', compact('delivery'));
    }

    /**
     * Обновляет товар каталога в базе данных
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Delivery $delivery) {
        $request->merge([
            'new' => $request->has('new'),
            'hit' => $request->has('hit'),
            'sale' => $request->has('sale'),
        ]);
        $data = $request->all();
        $delivery->update($data);
        return redirect()
            ->route('admin.delivery.index')
            ->with('success', 'Доставка успешно обновлена');
    }

    /**
     * Удаляет товар каталога из базы данных
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount) {
        $this->imageSaver->remove($discount, 'product');
        $discount->delete();
        return redirect()
            ->route('admin.discount.index')
            ->with('success', 'Дисконт успешно удален');
    }
}
