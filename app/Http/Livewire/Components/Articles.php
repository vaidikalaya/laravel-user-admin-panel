<?php

namespace App\Http\Livewire\Components;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\{Blog,Blog_category,Blog_tag};

class Articles extends Component
{
    use WithFileUploads;
    public $modalHeader;
    public $catId=null,$catName=null;
    public $tagId,$tagName;
    public $newBlogId,$blogArray=[],$blogTags=[],$pageRender,$thumbnail,$file;
    protected $listeners = ['delete-listener' => "deleteOperation"];

    public function categoryOperation($url,$data=null){
        switch($url){
            case 'add-update':

                if($this->modalHeader==="Edit a category"){
                    $res=Blog_category::where('id',$this->catId)->update([
                        'name'=>$this->catName,
                        'slug'=>str_slug($this->catName)
                    ]);
                }else{
                    $res=Blog_category::create([
                        'name'=>$this->catName,
                        'slug'=>str_slug($this->catName)
                    ]);
                }
                if($res){
                    $this->clear();
                    $this->emit('close-modal');
                    return back()->with('success_msg','category saved');
                }

            case 'edit':
                $this->modalHeader="Edit a category";
                $this->catId=$data['id'];
                $this->catName=$data['name'];
                break;
        }
    }

    public function tagOperation($url,$data=null){
        switch($url){
            case 'add-update':

                if($this->modalHeader==="Edit tag"){
                    $res=Blog_tag::where('id',$this->tagId)->update([
                        'name'=>$this->tagName,
                        'slug'=>str_slug($this->tagName)
                    ]);
                }else{
                    $res=Blog_tag::create([
                        'name'=>$this->tagName,
                        'slug'=>str_slug($this->tagName)
                    ]);
                }
                if($res){
                    $this->clear();
                    $this->emit('close-modal');
                    return back()->with('success_msg','tag saved');
                }

            case 'edit':
                $this->modalHeader="Edit tag";
                $this->tagId=$data['id'];
                $this->tagName=$data['name'];
                break;
        }
    }

    public function deleteOperation($payload){
        switch($payload['url']){
            case 'blog-category':
                if(Blog_category::where('id',$payload['id'])->delete()){
                    $this->emit('close-modal');
                }
                break;

            case 'tag':
                if(Blog_tag::where('id',$payload['id'])->delete()){
                    $this->emit('close-modal');
                }
                break;

            case 'blog':
                if(Blog::where('id',$payload['id'])->delete()){
                    $this->emit('close-modal');
                }
                break;
        }
    }

    /*Blog Operations*/
    
    public function editBlog($id){
        $this->blogArray=Blog::with('tags')->find($id)->toArray();
        $this->newBlogId=$this->blogArray['id'];
        foreach($this->blogArray['tags'] as $tag){
            array_push($this->blogTags,$tag['id']);
        }
        unset($this->blogArray['tags'],$this->blogArray['created_at'],$this->blogArray['updated_at']);
        $this->pageRender='edit-page';
    }

    public function saveBlog(){
        try{
            $this->blogArray['slug']=str_slug($this->blogArray['title']);
            $resUpdate=Blog::where('id',$this->newBlogId)->update($this->blogArray);
            if(count($this->blogTags)){
                foreach($this->blogTags as $tag){
                    if(!Blog_tag_relation::where('blog_id',$this->newBlogId)->where('tag_id',$tag)->exists()){
                        Blog_tag_relation::create([
                            'blog_id'=>$this->newBlogId,
                            'tag_id'=>$tag
                        ]);
                    }  
                }
            }
            return back()->with('success_msg','blog saved');
        }
        catch(Exception $e){
            return $e;
        }
    }

    public function uploadFile($url){
        $this->blogArray['other']=json_decode($this->blogArray['other']);
        switch($url){
            case "thumbnail-image":
                if($this->thumbnail){
                    $this->validate([
                        'thumbnail' => 'image',
                    ]);
                    $thumbnail=time().'-'.$this->thumbnail->getClientOriginalName();
                    $this->thumbnail->storeAs('blogs/thumbnails',$thumbnail,'custom_public_path');
                    $this->blogArray['other']->thumbnail=asset('uploads/blogs/thumbnails/'.$thumbnail);
                }
                break;

            case "pdf-files":
                if($this->file){
                    $this->validate([
                        'file' => 'mimes:pdf',
                    ]);
                    $fileName=time().'-'.$this->file->getClientOriginalName();
                    $this->file->storeAs('blogs/files',$fileName,'custom_public_path');
                    $this->blogArray['other']->file=asset('/uploads/blogs/files'.$fileName);
                }
                break;
        }  
        $this->blogArray['other']=json_encode($this->blogArray['other']);
    }

    public function publishBlog($blogId){
        if(Blog::where('id',$blogId)->update(['status'=>'publish'])){
            return back()->with('success_msg','blog published');  
        }
    }

    public function clear(){
        $this->modalHeader=null;
        $this->catId=null;
        $this->catName=null;

        $this->tagId=null;
        $this->tagName=null;
    }

    public function render()
    {  
        if($this->pageRender==='edit-page'){
            return view('livewire.components.add-article');
        }
        $categories=Blog_category::all();
        $tags=Blog_tag::all();
        $articles=Blog::with('category')->get();
        return view('livewire.components.articles',compact('categories','articles','tags'));
    }
}
