<main class="main">
    <section class="catalog">
        <div class="title__container">
            <p class="section-title catalog__title">Каталог специалистов</p>
        </div>
        <div class="catalog__items">
            @foreach($specialists as $sp)
                <x-catalog.main.catalog-item :specialist="$sp" />
            @endforeach 
        </div>
        {{ $specialists->links() }}
    </section>
</main>