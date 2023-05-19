@extends('layouts.default')

@section('styles')
    <!--filepond-->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css" rel="stylesheet"/>
    <style>
        /*
        * FilePond Custom Styles
        */

        .filepond--drop-label {
            color: #4c4e53;
        }

        .filepond--label-action {
            text-decoration-color: #babdc0;
        }

        .filepond--panel-root {
            background-color: #edf0f4;
        }

        .filepond--root.thumb {
            /* width: 300px; */
            margin: 0 auto;
        }

        .filepond--list-scroller {
            display: block;
        }

        /* .filepond--item {
            width: calc(50% - 0.5em);
        }

        @media (min-width: 30em) {
            .filepond--item {
                width: calc(50% - 0.5em);
            }
        }

        @media (min-width: 50em) {
            .filepond--item {
                width: calc(33.33% - 0.5em);
            }
        } */
    </style>
@endsection

@section('contents')

    <div class="container mt-5 mb-5 d-flex justify-content-center">
        <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data" style="width: 50%;">
            <h3 class="text-center">Add Category</h3>

            @method('post')
            @csrf
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image"
                        data-style-item-panel-aspect-ratio="0.5625" accept="image/png, image/jpeg, image/gif">
                @foreach ($errors->get('image') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" value="{{ old('name') }}" name="name" class="form-control @if ($errors->has('name')) is-invalid @endif" id="name">
                @foreach ($errors->get('name') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="popular" class="form-label">Popular</label>
                <select id="popular" name="popular" class="selectpicker"
                        data-live-search="true" data-width="100%"
                        data-style="border" data-size="5">
                        <option value="1" data-content='<span class="badge bg-danger">Trending</span>'>Trending</option>
                        <option value="2" selected data-content='<span class="badge bg-secondary">Normal</span>'>Normal</option>
                </select>
            </div>
            <input type="submit" name="submit" value="Add now" class="btn btn-primary">
        </form>
    </div>

@endsection

@section('scripts')
    <!--filepond-->
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>

    <!--detail picture-->
    <script>
        FilePond.registerPlugin(
            // register the Image Crop plugin with FilePond
            FilePondPluginImageCrop,
            FilePondPluginImagePreview,
            FilePondPluginImageResize,
            FilePondPluginImageTransform,
            FilePondPluginFileValidateSize,
            FilePondPluginFileValidateType
        );

        const inputElement = document.querySelector('input[name="image"]');
        const pond = FilePond.create(inputElement, {
            maxFiles: 1,
            storeAsFile: true,
            maxFileSize: 2000000,
            labelIdle: 'Drag & Drop your image or <span class="filepond--label-action"> Browse </span>',
            acceptedFileTypes: ['image/png', 'image/jpeg', 'image/gif']
        });
    </script>
    @if($errors->any())
        <script>
            showErrorToast('Create Category failed!!');
        </script>
    @endif
    @if(session('success') && !$errors->any())
        <script>
            showSuccessToast('{{ session('success') }}');
        </script>
    @endif
@endsection
