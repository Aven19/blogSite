@extends('layouts.app')
@section('content')
@include('layouts.side-nav')
<div class="main-wrapper">

    <section class="cta-section theme-bg-light py-5">
        <div class="container text-center">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Blogs | Edit</h3>
                <div></div>
            </div>

        </div>
    </section>
    <section class="cta-section theme-bg-light">
        <div class="container">
            <form method="POST" action="{{ route('blogs.update', $blog->id) }}" class="blog-edit-form blog-form row g-2 g-lg-2 align-items-center" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="col-12 col-md-12">
                    <label class="pb-3 label-text" for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" value="{{ old('title', $blog->title) }}" id="title" name="title" class="form-control @error('title') is-invalid @enderror me-md-1" placeholder="Add Blog Title">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-12 col-md-12 pt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <label class="pb-3 label-text" for="image">Thumbnail Image</label>
                        <input type="file" value="{{old('file')}}" id="file" name="file" class="form-control-sm  @error('file') is-invalid @enderror me-md-1" placeholder="Add Thumbnail Image" accept="image/png, image/jpg, image/jpeg" >
                        @error('file')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="col-2 col-xl-3">
                            <img class="img-fluid post-thumb" 
						    onError="this.onerror=null;this.src='https://picsum.photos/500/300?random=4';"
                            
                            src="{{ url('storage/blog-image/'.$blog->file) }}" alt="{{$blog->title}}">
                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-12 pt-3">
                    <label class="pb-3 label-text" for="custom_description">Description <span class="text-danger">*</span></label>
                    <textarea class="form-control tinymce-editor " id="custom_description" name="description" value="{{old('description')}}"></textarea>
                    @error('description')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-md-12 pt-3 pb-5">
                    <button type="submit" class="btn btn-primary">UPDATE</button>
                </div>

            </form>
        </div>
        <!--//container-->
    </section>
    @include('layouts.footer')
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.2.0/tinymce.min.js"></script>
<script>
    $(document).ready(function() {
        tinymce.init({
            selector: 'textarea.tinymce-editor',
            branding: false,
            setup: function (editor) {
            editor.on('init', function (e) {
                editor.setContent({!!json_encode($blog->description) !!});
            });
            },
            plugins: 'autolink directionality visualblocks visualchars fullscreen link table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount charmap quickbars emoticons',
            menubar: 'edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview | link anchor | ltr rtl',
            toolbar_sticky: true,
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 600,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quicktable',
            toolbar_mode: 'sliding',
            contextmenu: 'link table',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
            entity_encoding: 'raw'
        });
    });
</script>
@endsection
@section('scripts')
@vite([
    "resources/assets/custom-file-validation.js"
])
@endsection