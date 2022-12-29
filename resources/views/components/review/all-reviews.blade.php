<div class="reviews__wraper">
    <a href="#reviews" class="link">
        <section class="reviews">
            <div class="section-title title-container">
                <h1 class="title__text review__title__text">Отзывы</h1>
            </div>
            <div class="content">
                @foreach($userReviews as $review)
                    @if($review->getMark() !== null || $review->getComment() !== null)
                        <div class="review__item">
                            <div class="review__item__info">
                                <a target="_blank" href="/user/{{$review->getReviewBy()->id}}" class="link review__item__info__text review__item__info__interlocutor">Отзыв оставлен: {{$review->getReviewBy()->getOutName()}}</a>
                                <p class="review__item__info__text review__item__info__date">Дата проведения консультации: {{$review->getApply()->connect_time}}</p>
                                <p class="review__item__info__text review__item__info__mark">Оценка: {{$review->getMark()}}</p>
                                <p class="review__item__info__text review__item__info__comment">Комментарий: {{$review->getComment()}}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </section>
    </a>
</div>