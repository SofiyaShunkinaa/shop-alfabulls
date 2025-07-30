<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCatalogRequest;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller {

    private $imageSaver;

    public function __construct(ImageSaver $imageSaver) {
        $this->imageSaver = $imageSaver;
    }

    /**
     * Показывает список всех категорий
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(Request $request) {
        $showArchived = $request->get('archived', false);

        $items = Category::where('archived', $showArchived)->where('parent_id', 0)->get();
        
        return view('admin.category.index', compact('items', 'showArchived'));
    }    

    /**
     * Показывает форму для создания категории
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // все категории для возможности выбора родителя
        $items = Category::all();
        return view('admin.category.create', compact('items'));
    }

    /**
     * Сохраняет новую категорию в базу данных
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryCatalogRequest $request) {
        $data = $request->all();
        $data['image'] = $this->imageSaver->upload($request, null, 'category');
        $category = Category::create($data);
        return redirect()
            ->route('admin.category.show', ['category' => $category->id])
            ->with('success', 'Новая категория успешно создана');
    }

    /**
     * Показывает страницу категории
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category) {
        return view('admin.category.show', compact('category'));
    }

    /**
     * Показывает форму для редактирования категории
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category) {
        // все категории для возможности выбора родителя
        $items = Category::all();
        return view('admin.category.edit',compact('category', 'items'));
    }

    /**
     * Обновляет категорию каталога
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryCatalogRequest $request, Category $category) {
        $data = $request->all();
        $data['image'] = $this->imageSaver->upload($request, $category, 'category');
        $category->update($data);
        return redirect()
            ->route('admin.category.show', ['category' => $category->id])
            ->with('success', 'Категория была успешно исправлена');
    }

    /**
     * Удаляет категорию каталога
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category) {
        if ($category->children->count()) {
            $errors[] = 'Нельзя удалить категорию с дочерними категориями';
        }
        if ($category->products->count()) {
            $errors[] = 'Нельзя удалить категорию, которая содержит товары';
        }
        if (!empty($errors)) {
            return back()->withErrors($errors);
        }
        $this->imageSaver->remove($category, 'category');
        $category->delete();
        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Категория каталога успешно удалена');
    }

        public function archive(Category $category)
        {
            $category->archived = ! $category->archived;
            $category->save();

            return redirect()->back()->with('success', 'Категория обновлена.');
        }

       public function getSale($id)
    {
        $category = Category::findOrFail($id);
        return response()->json(['sale' => $category->sale ?? 0]);
    }

    public function updateSale(Request $request)
    {
        $category = Category::findOrFail($request->category_id);
        $category->sale = intval($request->sale);
        $category->save();

        return response()->json(['success' => true]);
    } 

    //////
    public function save(Request $request)
    {
        $categories = $request->input('categories', []);
        $deleted = $request->input('deleted', []);

        // Удаляем указанные элементы
        foreach ($deleted as $item) {
            if ($item['type'] === 'category' || $item['type'] === 'subcategory') {
                Category::where('id', $item['id'])->delete();
            }
        }

        // Сохраняем категории и подкатегории
        foreach ($categories as $category) {
            $cat = Category::updateOrCreate(
                ['id' => $category['id'] ?? null],
                [
                    'name' => $category['name'],
                    'parent_id' => 0,
                    'slug' => Str::slug($category['name']),
                ]
            );

            if (!empty($category['children'])) {
                foreach ($category['children'] as $child) {
                    Category::updateOrCreate(
                        ['id' => $child['id'] ?? null],
                        [
                            'name' => $child['name'],
                            'parent_id' => $cat->id,
                            'slug' => Str::slug($child['name']),
                        ]
                    );
                }
            }
        }

        return response()->json(['success' => true]);
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $category = Category::find($id);

        if ($category) {
            // Удалить подкатегории
            Category::where('parent_id', $category->id)->delete();
            // Удалить саму категорию
            $category->delete();
        }

        return response()->json(['success' => true]);
    }

    public function list()
    {
        $categories = Category::where('parent_id', 0)->with('children')->get();

        return response()->json($categories);
    }


}
