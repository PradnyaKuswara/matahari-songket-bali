@props(['article' => [], 'modalId' => ''])

<input type="checkbox" id="article_modal_{{ $modalId }}" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box w-11/12 max-w-3xl">
        <h3 class="text-lg font-bold">{{ $article->title }}</h3>
        <div class="mt-3">
            {!! $article->content !!}
        </div>
    </div>
    <label class="modal-backdrop" for="article_modal_{{ $modalId }}">Close</label>
</div>
