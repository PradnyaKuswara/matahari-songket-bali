@props(['article' => null])

<a href="{{ route('whats-new.detail', $article) }}">
    <div {{ $attributes->merge(['class' => 'card w-80 h-full rounded-sm mx-auto md:w-full shadow-sm']) }}>
        <figure id="preview-container">
            <img src="{{ $article->thumbnail() }}" alt="Album" />
        </figure>
        <div class="card-body">
            <div class="flex gap-3 item-center mb-4">
                <div class="flex flex-col">
                    <div class="avatar">
                        <div class="w-8 rounded-full">
                            <img src="{{ $article->user->avatar ? $article->user->avatar() : 'https://eu.ui-avatars.com/api/?name=' . $article->user->username . '&size=150' }}"
                                alt="Avatar Tailwind CSS Component" />
                        </div>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex flex-col">
                        <p class="text-xs">By: {{ $article->user->name }}</p>
                        <p class="text-xs">{{ $article->published_at->format('d F Y') }}</p>
                    </div>
                </div>
            </div>
            <h2 class="card-title font-bold">{{ $article->title }}</h2>
            <p class="text-sm text-left break-all"> {!! Str::limit(strip_tags($article->content), 100) !!}
            </p>
            <div class="flex gap-2 items-center">
                <span class="mdi mdi-eye text-sm text-gray-500"></span>
                <p class="text-sm text-gray-500">
                    {{ visits(\App\Models\Visitor::TYPE_ARTICLE, $article)->getVisitorCountPerSite() }}
                </p>
            </div>
        </div>
    </div>
</a>
