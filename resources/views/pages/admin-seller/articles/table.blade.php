<div class="table-responsive">
    <table class="table-hover">
        <thead>
            <tr>
                <th class="text-left font-bold text-sm">Status</th>
                <th class="text-left font-bold text-sm">Thumbnail</th>
                <th class="text-left font-bold text-sm">Author</th>
                <th class="text-left font-bold text-sm">Title</th>
                <th class="text-left font-bold text-sm">Slug</th>
                <th class="text-left font-bold text-sm">Meta Description</th>
                <th class="text-left font-bold text-sm">Meta Keyword</th>
                <th class="text-left font-bold text-sm">Published At</th>
                <th class="text-left font-bold text-sm">Created At</th>
                <th class="text-left font-bold text-sm">Updated At</th>
                <th class="text-left font-bold text-sm">Watched</th>
                <th class="text-left font-bold text-sm">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($articles as $article)
                <tr>
                    @if ($article->is_active)
                        <td>
                            <form
                                action="{{ route(request()->user()->role->name . '.dashboard.articles.toggleActive', $article) }}"
                                method="POST">
                                @csrf
                                @method('PATCH')

                                <div x-data="modal">
                                    <button type="button" class="btn btn-outline btn-success btn-sm border-none"
                                        @click="toggle">Active</button>
                                    <x-dashboard.confirm-modal-action :modalId="$article->created_at" title="Status"
                                        description="Are you sure update article status?"></x-dashboard.confirm-modal-action>
                                </div>
                            </form>
                        </td>
                    @else
                        <td>
                            <form
                                action="{{ route(request()->user()->role->name . '.dashboard.articles.toggleActive', $article) }}"
                                method="POST">
                                @csrf
                                @method('PATCH')
                                <div x-data="modal">
                                    <button type="button" class="btn btn-outline btn-error btn-sm border-none"
                                        @click="toggle">Inactive</button>
                                    <x-dashboard.confirm-modal-action :modalId="$article->created_at" title="Status"
                                        description="Are you sure update article status?"></x-dashboard.confirm-modal-action>
                                </div>
                            </form>
                        </td>
                    @endif
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-squircle w-10 h-10">
                                    <img src="{{ $article->thumbnail ? $article->thumbnail() : '' }}"
                                        alt="Image article" />
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $article->user->name }}</td>
                    <td>{{ $article->title ?? '-' }}</td>
                    <td>{{ $article->slug ?? '-' }}</td>
                    <td>{{ $article->meta_desc ? Str::limit(strip_tags($article->meta_desc), 30) : '-' }}</td>
                    <td>{{ $article->meta_keyword ? Str::limit(strip_tags($article->meta_keyword), 30) : '-' }}</td>
                    <td>{{ $article->published_at ?? '-' }}</td>
                    <td>{{ $article->created_at }}</td>
                    <td>{{ $article->updated_at }}</td>
                    <td> {{ visits(\App\Models\Visitor::TYPE_ARTICLE, $article)->getVisitorCountPerSite() }}</td>
                    <td>
                        <div class="flex gap-2">
                            <a href="{{ route(request()->user()->role->name . '.dashboard.articles.edit', $article) }}"
                                class=" text-black"><span class="mdi mdi-pencil text-xl text-success"></span></a>

                            <form
                                action="{{ route(request()->user()->role->name . '.dashboard.articles.destroy', $article) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <div x-data="modal">
                                    <button type="button" @click="toggle"><span
                                            class="mdi mdi-trash-can-outline text-xl text-error"></span></button>
                                    <x-dashboard.confirm-modal-action :modalId="$article->created_at" title="Delete Article"
                                        description="Are you sure delete this data?"></x-dashboard.confirm-modal-action>
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">No data available</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-2">
        {{ $articles->links('components.dashboard.pagination') }}
    </div>

</div>
