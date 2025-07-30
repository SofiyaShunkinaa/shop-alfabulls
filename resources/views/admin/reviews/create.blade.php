@extends('layout.admin', ['title' => 'Новый отзыв'])

@section('content')
    <h1>Новый отзыв</h1>
    <form method="post" action="{{ route('admin.reviews.store') }}" enctype="multipart/form-data">
        @include('admin.reviews.part.form')
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const ratingContainers = document.querySelectorAll('.ec-rating');
    
    ratingContainers.forEach(container => {
        const stars = container.querySelectorAll('.ec-rating-stars span');
        const hiddenInput = document.getElementById(container.dataset.storageId);
        const descriptionBox = container.querySelector('.ec-rating-description');
        
        // Инициализация текущего рейтинга
        let currentRating = parseInt(hiddenInput.value);
        updateStars(stars, currentRating);
        
        // Обработка клика по звезде
        stars.forEach(star => {
            star.addEventListener('click', function() {
                currentRating = parseInt(this.dataset.rating);
                hiddenInput.value = currentRating;
                updateStars(stars, currentRating);
                
                // Показываем описание
                if (descriptionBox) {
                    descriptionBox.textContent = this.dataset.description;
                }
            });
            
            // Эффект при наведении
            star.addEventListener('mouseover', function() {
                const hoverRating = parseInt(this.dataset.rating);
                stars.forEach((s, index) => {
                    s.classList.toggle('active', index < hoverRating);
                });
            });
        });
        
        // Сброс эффекта наведения
        container.addEventListener('mouseleave', function() {
            updateStars(stars, currentRating);
        });
    });
    
    function updateStars(stars, rating) {
        stars.forEach((star, index) => {
            star.classList.toggle('active', index < rating);
        });
    }
});
</script>
    
@endsection
