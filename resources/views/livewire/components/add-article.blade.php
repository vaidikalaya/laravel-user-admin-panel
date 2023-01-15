<div>
    @php
      $tags=App\Models\Blog_tag::all();
      $categories=App\Models\Blog_category::all();  
    @endphp
    <div class="main-header mt-2">
        <div class="d-inline">
            <h5 class="d-inline fw-bold">
                Add Article
                @if(session('success_msg'))
                    <span class="alert alert-success alert-dismissible" role="alert" style="padding: 6px 91px 8px 14px">
                        {{ session('success_msg') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 12px;margin-top:-8px"></button>
                    </span>
                @endif
                @error('thumbnail')
                    <span class="alert alert-danger alert-dismissible" role="alert" style="padding: 6px 91px 8px 14px">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 12px;margin-top:-8px"></button>
                    </span>
                @enderror
                @error('file')
                    <span class="alert alert-danger alert-dismissible" role="alert" style="padding: 6px 91px 8px 14px">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 12px;margin-top:-8px"></button>
                    </span>
                @enderror
            </h5>
            <button class="btn btn-primary2 float-end ms-3" style="margin-top:-10px" id="rightSideBar">
                <i class="fa-solid fa-bars"></i>
            </button>
            <button wire:loading class="spinner-border text-primary float-end" style="margin-top:-5px">
                <span class="visually-hidden">Loading...</span>
            </button>
        </div>
    </div> 
    <hr>

    <form  wire:submit.prevent="saveBlog()">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" wire:model.defer="blogArray.title" class="form-control only-border-bottom" id="articletitle" placeholder="title" required>
                    <label for="articletitle">Title</label>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-floating">
                    <select wire:model.defer="blogArray.category_id" class="form-select only-border-bottom" required>
                        <option selected>Select Category</option>
                        @foreach ($categories as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12" wire:ignore>
                <textarea id="summernote" wire:model.defer="blogArray.content" required></textarea>
            </div>
        </div>

        <div wire:ignore.self class="offcanvas offcanvas-end" id="rightOffcanvas" data-bs-scroll="true" data-bs-backdrop="false" style="margin-top:117px !important">
            <div class="offcanvas-header border-bottom">
            <button class="btn btn-primary2">Save</button>
            <button class="btn btn-primary2" type="button" wire:click="publishBlog({{$newBlogId}})">Publish</button>
            </div>
            <div class="offcanvas-body">
                
                <div class="mb-3">
                    <label for="thumbnailimage" class="form-label">Thumbnail Image</label>
                    <input type="file" wire:model="thumbnail" class="form-control form-control-sm" id="thumbnailimage">
                    <button wire:click="uploadFile('thumbnail-image')" class="btn btn-sm btn-primary2 mt-2" type="button">upload</button>
                    @if(json_decode($blogArray['other'])->thumbnail)
                        <img src="{{json_decode($blogArray['other'])->thumbnail}}" width="30px" height="30px" style="margin-top:8px">
                    @endif
                </div><hr>

                <div class="mb-3">
                    <label for="pdffile" class="form-label">Upload PDF</label>
                    <input type="file" wire:model="file" class="form-control form-control-sm" id="pdffile">
                    <button wire:click="uploadFile('pdf-files')" class="btn btn-sm btn-primary2 mt-2" type="button">upload</button>
                    @if(json_decode($blogArray['other'])->file)
                        <a href="{{json_decode($blogArray['other'])->file}}" target="_blank"><i class="fa fa-file-pdf"></i></a>
                    @endif
                </div><hr>

                <div wire:ignore>
                    <label class="form-label">Select Tags</label>
                    <div style="margin-top:-10px">
                        <select class="tagSelection" wire:model.defer="blogTags" multiple="multiple">
                            @foreach ($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
        </div>
    </form>

<script>
    document.addEventListener('livewire:load', function () {
        var tags=@this.blogTags;
        $('.tagSelection').select2().val(tags).trigger("change");
    });

    $('#summernote').summernote({
        height: 400,
        toolbar: [
            ['style', ['style']],
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['para', ['ul', 'ol', 'paragraph','height']],
            ['color', ['color']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']],
            ['buttons', ['button1']],
        ],
        fontSizes: ['8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30'],
        lineHeights: ['0.2','0.3','0.4','0.5','0.6','0.8','1.0','1.2','1.4','1.5','1.6','1.8','2.0','2.2','2.5','3.0'],
        callbacks: {
            onChange: function(contents, $editable) {
                @this.set('blogArray.content', contents);
            },
        }
    });
    
    $('#rightSideBar').click(function(){
        $('#rightOffcanvas').offcanvas('toggle');
    }); 
      
    $('.tagSelection').select2({
        placeholder: "Select tags",
        width:100+'%',
    }).on('change',function(){
        @this.set('blogTags', $(this).val());
    });
   
    
</script>

<style>
    .select2-container--default .select2-selection--multiple{
        width: 158px !important;
    }
    .select2-container--default .select2-dropdown--above{
        width: 158px !important;
    }
    .select2-container--default .select2-dropdown--below{
        width: 158px !important;
    }
</style>
</div>


