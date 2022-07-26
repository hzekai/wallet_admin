<div class="content">
    <h4 class="entity-list-item-name break-text">{{ $book->title }}</h4>
    <div class="entity-item-snippet">
        <p class="text-muted break-text mb-s text-limit-lines-1">{{ $book->content }}</p>
    </div>
</div>




<main class="content-wrap mt-m card">
    <div class="grid half v-center no-row-gap">
        <h1 class="list-heading">公告列表</h1>
    </div>

    <div class="entity-list">
        @foreach($books as $book)
            @include('notices.list-item', ['book' => $book])
        @endforeach
    </div>
</main>
