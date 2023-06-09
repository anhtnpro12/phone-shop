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
        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data" style="width: 50%;">
            <h3 class="text-center">Add Product</h3>

            @method('post')
            @csrf
            <div class="mb-3">
                <label for="image" class="form-label">Image <span class="text-danger">*</span></label>
                <input type="file" name="image" id="image"
                        data-style-item-panel-aspect-ratio="0.5625" accept="image/png, image/jpeg, image/gif">
                @foreach ($errors->get('image') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" value="{{ old('name') }}" name="name" class="form-control @if ($errors->has('name')) is-invalid @endif" id="name">
                @foreach ($errors->get('name') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select id="category_id" name="category_id" class="selectpicker"
                        data-live-search="true" data-width="100%"
                        data-style="border" data-size="5">
                    @foreach ($categories as $c)
                        <option value="{{ $c->id }}" data-content='
                            <div class="d-flex">
                                <div class="d-flex justify-content-center" style="max-width: 30%; max-height: 50px">
                                    <img style="max-height: 100%;" class="img-fluid" src="{{ asset('storage/imgs/categories/'.$c->id.'/'.$c->image) }}" alt="image">
                                </div>
                                <div class="d-flex align-items-center ps-1" style="width: 70%">
                                    <p>{{ $c->name }}</p>
                                </div>
                            </div>'>
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3">{{ old('description') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="original_price" class="form-label">Price <span class="text-danger">*</span></label>
                <input type="text" value="{{ old('original_price') }}" name="original_price" class="form-control @if ($errors->has('original_price')) is-invalid @endif" id="original_price">
                @foreach ($errors->get('original_price') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="qty" class="form-label">Quantity <span class="text-danger">*</span></label>
                <input type="number" value="{{ old('qty') }}" name="qty" class="form-control @if ($errors->has('qty')) is-invalid @endif" id="qty">
                @foreach ($errors->get('qty') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="selectpicker"
                        data-live-search="true" data-width="100%"
                        data-style="border" data-size="5">
                    <option value="1" data-content='<span class="badge bg-secondary">4hand</span>'>4hand</option>
                    <option value="2" data-content='<span class="badge bg-primary">3hand</span>'>3hand</option>
                    <option value="3" data-content='<span class="badge bg-warning">2hand</span>'>2hand</option>
                    <option value="4" data-content='<span class="badge bg-success">New</span>' selected>New</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="trending" class="form-label">Trending Priority</label>
                <select id="trending" name="trending" class="selectpicker"
                        data-live-search="true" data-width="100%"
                        data-style="border" data-size="5">
                        <option value="1" data-content='<span class="badge bg-danger">Trending</span>'>Trending</option>
                        <option value="2" selected data-content='<span class="badge bg-secondary">Normal</span>'>Normal</option>
                </select>
            </div>
            <input type="submit" name="submit" value="Add now" class="btn btn-primary">
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
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
            showErrorToast('Create Product failed!!');
        </script>
    @endif
    @if(session('success') && !$errors->any())
        <script>
            showSuccessToast('{{ session('success') }}');
        </script>
    @endif
@endsection
