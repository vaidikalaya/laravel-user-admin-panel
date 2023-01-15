<div>
    <div class="main-header mt-2">
        <div>
            @can('article-add') <a class="btn btn-primary2" href="/admin/add-article">Add Article</a> @endcan
            @can('category-add') <a class="btn btn-primary2" data-bs-toggle="modal" data-bs-target="#addArticleCategory" wire:click="$set('modalHeader', 'Add a category')">Add Article Category</a> @endcan
            @can('tag-add') <a class="btn btn-primary2" data-bs-toggle="modal" data-bs-target="#addTags" wire:click="$set('modalHeader', 'Add tag')">Add Tags</a> @endcan
        </div>
    </div>
    <hr>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="articles-tab" data-bs-toggle="tab" data-bs-target="#articles-tab-pane" type="button">
                Articles
            </button>
        </li>
        @can('categories-view') 
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="categories-tab" data-bs-toggle="tab" data-bs-target="#categories-tab-pane" type="button">
                Categories
            </button>
        </li>
        @endcan
        @can('tags-view') 
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tags-tab" data-bs-toggle="tab" data-bs-target="#tags-tab-pane" type="button">
                Tags
            </button>
        </li>
        @endcan
    </ul>
    <div wire:ignore class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="articles-tab-pane">
            <div class="card mt-2">
                <div class="card-body table-responsive">
                    <table id="articleDataTable" class="display">
                        <thead>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Status</th>
                            <th scope="col">Category</th>
                            <th scope="col">Created</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @if($articles->count()>0)
                                @foreach ($articles as $article)
                                    <tr>
                                        <td>{{$article->id}}</td>
                                        <td>{{$article->title}}</td>
                                        <td>{{$article->slug}}</td>
                                        <td>{{$article->status}}</td>
                                        <td>{{$article->category->name}}</td>
                                        <td>{{ \Carbon\Carbon::parse($article->created_at)->format('d/m/Y')}}</td>
                                        <td>
                                            @can('article-update') 
                                            <button class="btn" wire:click="editBlog({{$article->id}})">
                                                <i class="fa fa-edit" style="font-size: 25px;color:#2073bf;" ></i>
                                            </button>
                                            @endcan

                                            @can('article-delete') 
                                            <button class="btn" onclick="showDeleteAlert('blog',{{$article->id}})">
                                                <i class="fa fa-trash" style="font-size: 25px;color:#2073bf;"></i>
                                            </button>  
                                            @endcan
                                        </td>
                                    </tr>        
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @can('categories-view') 
        <div class="tab-pane fade" id="categories-tab-pane">
            <div class="card mt-2">
                <div class="card-body table-responsive">
                    <table id="categoryDataTable" class="display">
                        <thead>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Created</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @if($categories->count()>0)
                                @foreach ($categories as $cat)
                                    <tr>
                                        <td>{{$cat->id}}</td>
                                        <td>{{$cat->name}}</td>
                                        <td>{{$cat->slug}}</td>
                                        <td>{{ \Carbon\Carbon::parse($cat->created_at)->format('d/m/Y')}}</td>
                                        <td>
                                            @can('category-update')
                                            <button class="btn" wire:click="categoryOperation('edit',{{$cat}})" data-bs-toggle="modal" data-bs-target="#addArticleCategory">
                                                <i class="fa fa-edit" style="font-size: 25px;color:#2073bf;" ></i>
                                            </button>
                                            @endcan

                                            @can('category-delete')
                                            <button class="btn" onclick="showDeleteAlert('blog-category',{{$cat->id}})">
                                                <i class="fa fa-trash" style="font-size: 25px;color:#2073bf;"></i>
                                            </button>  
                                            @endcan
                                        </td>
                                    </tr>        
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endcan
        @can('tags-view') 
        <div class="tab-pane fade" id="tags-tab-pane">
            <div class="card mt-2">
                <div class="card-body table-responsive">
                    <table id="tagDataTable" class="display">
                        <thead>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Created</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @if($tags->count()>0)
                                @foreach ($tags as $tag)
                                    <tr>
                                        <td>{{$tag->id}}</td>
                                        <td>{{$tag->name}}</td>
                                        <td>{{$tag->slug}}</td>
                                        <td>{{ \Carbon\Carbon::parse($tag->created_at)->format('d/m/Y')}}</td>
                                        <td>
                                            @can('tag-update')
                                            <button class="btn" wire:click="tagOperation('edit',{{$tag}})" data-bs-toggle="modal" data-bs-target="#addTags">
                                                <i class="fa fa-edit" style="font-size: 25px;color:#2073bf;" ></i>
                                            </button>
                                            @endcan

                                            @can('tag-delete')
                                            <button class="btn" onclick="showDeleteAlert('tag',{{$tag->id}})">
                                                <i class="fa fa-trash" style="font-size: 25px;color:#2073bf;"></i>
                                            </button> 
                                            @endcan 
                                        </td>
                                    </tr>        
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endcan
    </div>

    <!--Category Modal-->
    @can('category-add') 
    <div wire:ignore.self class="modal fade" id="addArticleCategory" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                   {{$modalHeader}}
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="categoryOperation('add-update')">
                        <div class="form-floating mb-3">
                            <input type="text" wire:model.defer="catName" class="form-control only-border-bottom" id="categoryname" placeholder="categoryname" required>
                            <label for="categoryname">Category Name</label>
                        </div>
                        <button class="btn btn-primary2" type="submit">Submit</button>
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button" wire:click="clear()">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endcan

    <!--Tag Modal-->
    @can('tag-add') 
    <div wire:ignore.self class="modal fade" id="addTags" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                   {{$modalHeader}}
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="tagOperation('add-update')">
                        <div class="form-floating mb-3">
                            <input type="text" wire:model.defer="tagName" class="form-control only-border-bottom" id="tagname" placeholder="tagname" required>
                            <label for="tagname">Tag Name</label>
                        </div>
                        <button class="btn btn-primary2" type="submit">Submit</button>
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button" wire:click="clear()">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endcan
</div>
