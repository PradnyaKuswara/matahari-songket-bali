@extends('layouts.dashboard')

@section('title')
    Management Article
@endsection

@push('css')
    <script src="{{ asset('assets/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    {{-- <script src="https://cdn.tiny.cloud/1/jm4spe5lq6s2xar67c785v4zh59wrw4nhddp4xuxf2gj1o82/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script> --}}
    <script>
        tinymce.init({
            selector: 'textarea#loggingContent',
            plugins: [
                "advlist", "anchor", "autolink", "charmap", "code", "fullscreen",
                "help", "image", "insertdatetime", "link", "lists", "media",
                "preview", "searchreplace", "table", "visualblocks", "accordion"
            ],
            height: 600,
            toolbar: "undo redo |link image accordion | styles | bold italic underline strikethrough | align | bullist numlist",
            image_caption: true,
            license_key: 'gpl',
            image_title: true,
            automatic_uploads: true,
            file_picker_types: 'image',
            file_picker_callback: (cb, value, meta) => {
                const input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                input.addEventListener('change', (e) => {
                    const file = e.target.files[0];

                    const reader = new FileReader();
                    reader.addEventListener('load', () => {
                        const id = 'blobid' + (new Date()).getTime();
                        const blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        const base64 = reader.result.split(',')[1];
                        const blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), {
                            title: file.name
                        });
                    });
                    reader.readAsDataURL(file);
                });

                input.click();
            },
        });
    </script>
@endpush

@section('content')
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Article</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Edit</span>
            </li>
        </ul>

        <div class="mt-5">
            <form action="{{ route(request()->user()->role->name . '.dashboard.articles.update', $article) }}" method="POST"
                id="articleForm" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="panel">
                    <h5 class="text-lg font-semibold dark:text-white-light">Article Form</h5>
                    <div class="grid lg:grid-cols-2 gap-4 mb-4 mt-5 place-items-center place-content-center">
                        <div class=" w-full col-span-2">
                            <label class="form-control w-full max-w-xs" for="loggingTitle">
                                <div class="label">
                                    <div>
                                        <span class="label-text">Author</span>
                                        <span class="text-error">*</span>
                                    </div>
                                </div>
                            </label>

                            <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                <input id="loggingTitle" type="text" class="form-input grow border-none outline-none "
                                    name="user_id" value="{{ request()->user()->name }} / {{ request()->user()->email }}"
                                    placeholder="Enter your article author" minlength="1" maxlength="50" disabled />
                            </label>
                        </div>

                        <div class="w-full col-span-1">
                            <label class="form-control w-full max-w-xs" for="loggingTitle">
                                <div class="label">
                                    <div>
                                        <span class="label-text">Title</span>
                                        <span class="text-error">*</span>
                                    </div>
                                </div>
                            </label>

                            <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                <input id="loggingTitle" type="text" class="form-input grow border-none outline-none "
                                    name="title" value="{{ old('title') ?? $article->title }}"
                                    placeholder="Enter your article title" minlength="1" maxlength="50" />
                            </label>
                            @error('title')
                                <p class="mt-2 text-danger text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full col-span-1">
                            <label class="form-control w-full" for="loggingThumbnail">
                                <div class="label">
                                    <div>
                                        <span class="label-text">Thumbnail</span>
                                        <span class="text-error">*</span>
                                    </div>
                                </div>
                                <input id="loggingThumbnail" type="file" name="thumbnail"
                                    class="file-input file-input-bordered" />
                                @error('thumbnail')
                                    <p class="mt-2 text-danger text-xs">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>

                        <div class="w-full col-span-2">
                            <div class="flex items-center">
                                <div class=""
                                    style="width: 320px; height: 180px; border: 2px solid rgb(219, 219, 219);">
                                    <img class="w-full h-full object-contain" src="{{ $article->thumbnail() }}"
                                        alt="{{ $article->title }}">
                                </div>
                                <svg width="52" height="52" viewBox="0 0 32 32" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20.5717 9.90039L26.6669 15.9987L20.5717 22.0954M6.85742 16.0002H26.6669"
                                        stroke="black" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="mx-2"
                                    style="width: 320px; height: 180px; border: 2px solid rgb(219, 219, 219);"
                                    id="preview-container">
                                    <img class="w-full h-full object-contain" id="preview"
                                        src="{{ asset('assets/images/placeholder-image.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="w-full col-span-2">
                            <label class="form-control w-full" for="loggingContent">
                                <div class="label">
                                    <div>
                                        <span class="label-text">Content</span>
                                        <span class="text-error">*</span>
                                    </div>
                                </div>
                            </label>

                            {{-- <div id="editor" class="editor" style="height: 700px;">
                                {!! old('content') ?? $article->content !!}
                            </div> --}}
                            <textarea id="loggingContent" name="content" placeholder="Enter your article content">{{ old('content') ?? $article->content }}</textarea>

                            @error('content')
                                <p class="mt-2 text-danger text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full col-span-1">
                            <label class="form-control w-full" for="loggingMetaDesc">
                                <div class="label">
                                    <div>
                                        <span class="label-text">Meta Description</span>
                                    </div>
                                </div>
                                <textarea id="loggingMetaDesc" name="meta_desc" class="textarea textarea-bordered h-24"
                                    placeholder="Enter your article meta description">{{ old('meta_desc') ?? $article->meta_desc }}</textarea>

                                @error('meta_desc')
                                    <p class="mt-2 text-danger text-xs">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>

                        <div class="w-full col-span-1">
                            <label class="form-control w-full" for="loggingMetaKeyword">
                                <div class="label">
                                    <div>
                                        <span class="label-text">Meta Keyword</span>
                                    </div>
                                </div>
                                <textarea id="loggingMetaKeyword" name="meta_keyword" class="textarea textarea-bordered h-24"
                                    placeholder="Enter your article meta keyword">{{ old('meta_keyword') ?? $article->meta_keyword }}</textarea>
                                @error('meta_keyword')
                                    <p class="mt-2 text-danger text-xs">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <button type="submit" class="btn btn-primary" name="action" value="publish">Publish
                            article</button>
                        <button type="submit" class="btn btn-accent text-white" name="action" value="draft">Save as
                            draft
                            article</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/preview.js') }}"></script>
    <script>
        const preview = new Preview();
        preview.setImageNode('preview').setInputNode('loggingThumbnail').setParentNode('preview-container').set();
    </script>
@endpush
