<?php

namespace App\Http\Livewire\PA\Articles;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Articles\Article;
use App\Models\Articles\ArticleCategory;
use App\Models\Articles\ArticleTags;
use App\Models\Articles\ArticleType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class Create extends Component
{
    use WithFileUploads;
    public $judul_artikel, $slug, $deskripsi, $isi_artikel, $rekomendasi = 1, $status, $jenisId, $kategori, $nama_jenis, $tagsId = [], $tags;
    public $autoPublish = 0;
    public $tanggal_publish;
    public $thumbnail;

    public function mount()
    {
        $this->tanggal_publish = date('Y-m-d H:i');
    }

    public function render()
    {
        $types = ArticleType::orderBy('name')->get();
        $categories = ArticleCategory::orderBy('name')->get();
        $arrTags = ArticleTags::orderBy('name')->get();

        $bcs = [
            [
                'route' => 'admin.articles-index',
                'title' => 'Daftar Artikel',
            ],
            [
                'route' => 'admin.articles-index',
                'title' => 'Buat Artikel',
            ],
        ];

        return view('livewire.p-a.articles.create', [
            'types' => $types,
            'categories' => $categories,
            'arrTags' => $arrTags,
        ])->layout('admin.layouts.app')
            ->layoutData([
                'title' => 'Buat Artikel',
                'bcs' => $bcs
            ]);
    }

    public function updated($field)
    {
        if ($field == 'judul_artikel') {
            $this->slug = Str::slug($this->judul_artikel);
        }
    }

    public function store()
    {
        $validasi = $this->validate([
            'judul_artikel' => 'required|min:5',
            'slug' => 'required|unique:articles,slug',
            'deskripsi' => 'nullable',
            'isi_artikel' => 'required',
            'rekomendasi' => 'required',
            'jenisId' => 'required',
            'kategori' => 'required',
            'tagsId' => 'required',
            'tanggal_publish' => 'required|date',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ], [], [
            'judul_artikel' => 'Judul Artikel',
            'slug' => 'Custom URL',
            'deskripsi' => 'Deskripsi',
            'isi_artikel' => 'Isi Artikel',
            'rekomendasi' => 'Rekomendasi',
            'jenisId' => 'Jenis Artikel',
            'kategori' => 'Kategori Artikel',
            'tagsId' => 'Tags Artikel',
            'tanggal_publish' => 'Tanggal Publish',
            'thumbnail' => 'Thumbnail',
        ]);

        if ($validasi) {
            if ($this->tanggal_publish > now()) {
                $autoPub = 1;
            } else {
                $autoPub = 0;
            }
            // DOM UPLOAD IMAGE ON SUMMERNOTE
            $domIsiArtikel = $this->isi_artikel;
            $dom = new \DomDocument();
            $dom->loadHtml($domIsiArtikel, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $domImage = $dom->getElementsByTagName('img');

            foreach ($domImage as $k => $img) {
                $domData = $img->getAttribute('src');
                list($type, $domData) = explode(';', $domData);
                list($type, $domData) = explode(',', $domData);
                $domData = base64_decode($domData);
                $image_name = "/storage/images/" . time() . $k . '.png';
                $path = public_path() . $image_name;
                file_put_contents($path, $domData);
                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
            $domIsiArtikel = $dom->saveHTML();
            // DOM UPLOAD IMAGE ON SUMMERNOTE

            $data = new Article;
            $data->title = $this->judul_artikel;
            $data->slug = Str::slug($this->judul_artikel);
            $data->type_id = $this->jenisId;
            $data->category_id = $this->kategori;
            $data->user_id = Auth::user()->id;
            $data->description = $this->deskripsi;
            $data->content = $domIsiArtikel;
            $data->status = $autoPub == 0 ? "Draft" : "Publish";
            $data->is_recommend = $this->rekomendasi;
            $data->is_auto_publish = $autoPub;
            $data->published_at = Carbon::parse($this->tanggal_publish)->format('Y-m-d H:i');
            if ($this->thumbnail) {
                $photo = $this->thumbnail;
                $imageName = Str::slug($this->judul_artikel) . '.' . $photo->getClientOriginalExtension();

                // ORIGINAL
                $destinationPath = public_path('/storage/images/thumbnail/original/');
                $img = Image::make($photo->getRealPath());
                $QuploadImage = $img->resize(1080, 1080, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . $imageName, 100);

                // SMALL
                $destinationPath = public_path('/storage/images/thumbnail/small/');
                $img = Image::make($photo->getRealPath());
                $QuploadImage = $img->resize(480, 480, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . $imageName, 100);

                $data->thumbnail = $imageName;
            }
            $data->save();

            if ($data) {
                $tagNames = $this->tagsId;
                $tagIds = [];

                foreach ($tagNames as $tagName) {
                    $tag = ArticleTags::firstOrCreate([
                        'name' => $tagName,
                        'slug' => Str::slug($tagName),
                    ]);

                    if ($tag) {
                        $tagIds[] = $tag->id;
                    }
                }
                $data->Tags()->sync($tagIds);
            }

            session()->flash('success', 'Artikel berhasil ditambahkan!');
            return redirect()->route('admin.articles-index');
        }
    }
}
