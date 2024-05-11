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
    <style>
        #preview-container>img {
            width: 320px;
            height: 180px;
            border: 2px solid rgb(219, 219, 219);
            object-fit: contain;
        }
    </style>
@endpush

@section('content')
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Article</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Create</span>
            </li>
        </ul>

        <div class="mt-5">
            <form action="{{ route(request()->user()->role->name . '.dashboard.articles.store') }}" method="POST"
                id="articleForm" enctype="multipart/form-data">
                @csrf
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
                                    name="title" value="{{ old('title') }}" placeholder="Enter your article title"
                                    minlength="1" maxlength="50" />
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
                            <div id="preview-container" class="mb-3"></div>
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

                            <textarea id="loggingContent" name="content" placeholder="Enter your article content">{{ old('content') }}</textarea>

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
                                    placeholder="Enter your article meta description">{{ old('meta_desc') }}</textarea>

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
                                    placeholder="Enter your article meta keyword">{{ old('meta_desc') }}</textarea>
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
        preview.createImageNode('').setParentNode('preview-container').setInputNode('loggingThumbnail').set();
    </script>
@endpush
