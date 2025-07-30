<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discount;

class DiscountController extends Controller {

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
        $items = Discount::paginate(5);
        return view('admin.discount.index', compact('items'));
    }



    /**
     * Показывает форму для создания товара
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view('admin.discount.create');
    }

    /**
     * Сохраняет новый товар в базу данных
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = $request->all();
        $discount = Discount::create($data);
        return redirect()
            ->route('admin.discount.index')
            ->with('success', 'Новый дисконт успешно создан');
    }

    /**
     * Показывает страницу товара
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount) {
        return view('admin.discount.show', compact('discount'));
    }

    /**
     * Показывает форму для редактирования товара
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount) {

        return view('admin.discount.edit', compact('discount'));
    }

    /**
     * Обновляет товар каталога в базе данных
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount) {
        $request->merge([
            'new' => $request->has('new'),
            'hit' => $request->has('hit'),
            'sale' => $request->has('sale'),
        ]);
        $data = $request->all();
        $discount->update($data);
        return redirect()
            ->route('admin.discount.index')
            ->with('success', 'Дисконт был успешно обновлен');
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
