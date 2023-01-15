<?php 
namespace App\Http\Livewire\Components;
use Livewire\Component;
use App\Models\{Blog,Blog_category,Blog_tag_relation};
use Livewire\WithFileUploads;

class AddArticle extends Component
{
    use WithFileUploads;
    public $newBlogId=null,$blogTags=[],$thumbnail,$file;
    public $blogArray=[
        'title'=>null,
        'slug'=>null,
        'content'=>null,
        'other'=>'{"thumbnail":null,"file":null}',
        'category_id'=>null,
        'author_id'=>null
    ]; 

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

    public function saveBlog(){
        try{
            $this->blogArray['slug']=str_slug($this->blogArray['title']);
            $this->blogArray['author_id']=auth()->user()->id;

            if(!$this->newBlogId){
                $resAdd=Blog::create($this->blogArray);
                if($resAdd){
                    $this->newBlogId=$resAdd->id;
                }
            }else{
                $resUpdate=Blog::where('id',$this->newBlogId)->update($this->blogArray);
            }

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

    public function publishBlog($blogId){
        if(Blog::where('id',$blogId)->update(['status'=>'publish'])){
            return back()->with('success_msg','blog published');  
        }
    }

    public static function render()
    {
        return view('livewire.components.add-article');
    }
}
