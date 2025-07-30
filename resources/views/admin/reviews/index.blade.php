@extends('layout.admin', ['title' => 'Отзывы'])

@section('content')
    <h1 class="dog-h1 mb-4">Отзывы</h1>

    <div class="p-4 table-con">
        <div class="mb-3">
            <div class="d-flex" style="background-color: #868686; width: max-content; border-radius: 10px;">
            <a href="{{ route('admin.reviews.index') }}" class="butn {{ !$showArchived ? 'active' : '' }}"
            style="background-color: {{ !$showArchived ? '#fff' : '#A6A6A6' }}; color: {{ !$showArchived ? '#505050' : '#FFFFFF' }}; border-radius: 10px;">
                Активные
            </a>
            <a href="{{ route('admin.reviews.index', ['archived' => 1]) }}" class="butn {{ !$showArchived ? 'active' : '' }}"
            style="background-color: {{ $showArchived ? '#fff' : '#868686' }}; color: {{ $showArchived ? '#505050' : '#  ' }}; border-radius: 0 10px 10px 0;">
                Архив
            </a>
            </div>
        </div>

        <div style="overflow-x: auto; width: 100%;">
        <table class="table-bordered w-full whitespace-nowrap">
            <thead class="table-header text-white">
                <tr style="background-color: #9A9A9A;">
                    <th class="table-cell">Пользователь</th>
                    <th class="table-cell">Товары</th>
                    <th class="table-cell">Оценка</th>
                    <th class="table-cell">Файл</th>
                    <th class="table-cell">Комментарий</th>
                    <th class="table-cell">Одобрить/Удалить</th>
                    <th class="table-cell">Архив</th>
                    <!-- <th class="table-cell">Удалить</th> -->
                </tr>
            </thead>
            <tbody>
                @forelse ($reviews as $review)
                    <tr>
                        <td class="table-cell" style="
    text-align: left;
">{{ $review->name }}</td>
<td class="table-cell" style="
    text-align: left;
"></td>
<td class="table-cell">
    @for ($i = 1; $i <= 5; $i++)
        @if ($i <= $review->rating)
            <i class="fas fa-star" style="color: gold;"></i> {{-- заполненная --}}
        @else
            <i class="far fa-star" style="color: #ccc;"></i> {{-- пустая --}}
        @endif
    @endfor
</td>
                        <td class="table-cell" style="gap: 10px">
                            <div style="margin: auto;">
                                @if ($review->isVideo())
                                    <video width="120" controls>
                                        <source src="{{ $review->file_url }}" type="video/mp4">
                                        Ваш браузер не поддерживает видео.
                                    </video>
                                @elseif($review->file)
                                    <img src="{{ $review->file_url }}" alt="Фото" width="100">
                                @else
                                    -
                                @endif
                            </div>
                        </td>
                        <td class="table-cell">{{ Str::limit($review->text, 100) }}</td>

                        <td class="table-cell">
                            @if (!$review->status)
                                <form method="POST" action="{{ route('admin.reviews.approve', $review->id) }}">
                                    @csrf
                                    <button class="butn bg-green-600 text-white px-2 py-1 rounded">Одобрить</button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('admin.reviews.destroy', $review->id) }}">
                                    @csrf
                                    <button class="butn bg-red-600 text-white px-2 py-1 rounded">Удалить</button>
                                </form>
                            @endif
                        </td>
                        <td class="table-cell">
                            <form action="{{ route('admin.reviews.archive', $review->id) }}"
                                method="post"
                                    @if (!$showArchived)
                                        onsubmit="return confirm('Переместить отзыв в архив?')"
                                    @else
                                        onsubmit="return confirm('Восстановить отзыв из архива?')"
                                    @endif
                                >
                                @csrf
                                <button type="submit" class="delete-button">
                                    <i class="ri-delete-bin-line ri-lg"></i>
                                </button>
                            </form>
                        </td>
                        <!-- <td class="table-cell">
                            <form method="POST" action="{{ route('admin.reviews.destroy', $review->id) }}" onsubmit="return confirm('Удалить отзыв?')">
                                @csrf
                                @method('DELETE')
                                <button class="delete-button">
                                    <i class="ri-delete-bin-line ri-lg text-red-600"></i>
                                </button>
                            </form>
                        </td> -->
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">Отзывы не найдены</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
</div>
        <div class="flex justify-end mt-6">
            <button type="button" id="add-review-button" class="add-button whitespace-nowrap !rounded-button">Добавить</button>
        </div>

        </div> 
        <div class="py-6">
            {{ $reviews->links() }}
        </div>
    
    <script>
$(document).ready(function () {
    $('#add-review-button').on('click', function () {
        // Удалим предыдущую, если есть
        $('tr.new-review-row').remove();

        const newRow = `
        <tr class="table-row new-review-row">
            <td class="table-cell"><input type="text" class="input-name border px-2 py-1 form-control" placeholder="Имя"></td>
            <td class="table-cell">
                <div class="ec-form__row ec-input-parent">
                    <input type="hidden" name="rating" class="input-rating" value="5">
                    <div class="ec-rating ec-clearfix" data-storage-id="">
                        <div class="ec-rating-stars ec-rating-stars--default" style="margin-right: 0px;">
                            <span data-rating="1" data-description="Плохо" class="active"></span>
                            <span data-rating="2" data-description="Есть и получше" class="active"></span>
                            <span data-rating="3" data-description="Средне" class="active"></span>
                            <span data-rating="4" data-description="Хорошо" class="active"></span>
                            <span data-rating="5" data-description="Отлично! Рекомендую!" class="active"></span>
                        </div>
                    </div>
                </div>
            </td>
            <td class="table-cell"><input type="file" class="input-file" style="padding: 0px; background: transparent;"/></td>
            <td class="table-cell" colspan="2"><textarea class="input-text border px-2 py-1 form-control" placeholder="Текст отзыва"></textarea></td>
            <td class="table-cell">
                <button type="button" class="save-review-button bg-green-500 text-white px-3 py-1 rounded">Добавить</button>
            </td>
            <td></td>
        </tr>`;

        $('table tbody').prepend(newRow);
        initRatingSystem(); // Инициализация рейтинга
    });

    $(document).on('click', '.save-review-button', function () {
        const row = $(this).closest('tr');
        const name = row.find('.input-name').val();
        const rating = row.find('.input-rating').val();
        const text = row.find('.input-text').val();
        const fileInput = row.find('.input-file')[0];

        const formData = new FormData();
        formData.append('name', name);
        formData.append('rating', rating);
        formData.append('text', text);
        formData.append('_token', '{{ csrf_token() }}');

        if (fileInput.files.length > 0) {
            formData.append('file', fileInput.files[0]);
        }

        $.ajax({
            url: '{{ route("admin.reviews.store") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function () {
                location.reload();
            },
            error: function (xhr) {
                alert('Ошибка при сохранении');
                console.log(xhr.responseText);
            }
        });
    });

    // Инициализация звёзд
    function initRatingSystem() {
        $('.ec-rating').each(function () {
            const container = $(this);
            const stars = container.find('.ec-rating-stars span');
            let hiddenInput = container.closest('.ec-form__row').find('.input-rating');
            let currentRating = parseInt(hiddenInput.val()) || 5;

            updateStars(stars, currentRating);

            stars.off('click').on('click', function () {
                currentRating = parseInt($(this).data('rating'));
                hiddenInput.val(currentRating);
                updateStars(stars, currentRating);
            });

            stars.off('mouseover').on('mouseover', function () {
                const hoverRating = parseInt($(this).data('rating'));
                stars.each(function (i) {
                    $(this).toggleClass('active', i < hoverRating);
                });
            });

            container.off('mouseleave').on('mouseleave', function () {
                updateStars(stars, currentRating);
            });
        });

        function updateStars(stars, rating) {
            stars.each(function (index) {
                $(this).toggleClass('active', index < rating);
            });
        }
    }
});
</script>
@endsection
