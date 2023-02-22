<?php

namespace App\Http\Livewire\PA\Articles;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Articles\Article;
use App\Models\Articles\ArticleTags;
use App\Models\Articles\ArticleType;
use Intervention\Image\Facades\Image;
use App\Models\Articles\ArticleCategory;

class Edit extends Component
{

    use WithFileUploads;
    public $articleId, $judul_artikel, $slug, $deskripsi, $isi_artikel, $rekomendasi, $status, $jenisId, $kategori, $nama_jenis, $tagsId = [], $tags, $thumbnail;
    public $thumbnailGet;
    public $autoPublish;
    public $tanggal_publish;

    public function mount($id)
    {
        $data = Article::findOrFail($id);
        if ($data) {
            $this->articleId = $data->id;
            $this->judul_artikel = $data->title;
            $this->slug = $data->slug;
            $this->deskripsi = $data->description;
            $this->isi_artikel = $data->content;
            $this->rekomendasi = $data->is_recommend;
            $this->jenisId = $data->type_id;
            $this->kategori = $data->category_id;
            $this->nama_jenis = $data->Type->name ?? '';
            $this->tags = $data->getTags;
            $this->tagsId = [];
            foreach ($data->getTags as $tag) {
                $this->tagsId[] = $tag->name;
            }
            $this->tagsIdRes = json_encode($this->tagsId);
            // $this->tagsId = implode(',', $this->tagsId);
            // $this->tagsId = json_encode($this->tagsId);
            $this->thumbnailGet = $data->thumbnail;
            // $this->tanggal_publish = $data->published_at;
            // $this->tanggal_publish = Carbon::parse($data->published_at)->setTimezone('T')->format('Y-m-dTh:m');
            $this->tanggal_publish = Carbon::parse($data->published_at)->format('Y-m-d H:i');
        }
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
                'title' => 'Edit ' . $this->judul_artikel,
            ],
        ];

        return view('livewire.p-a.articles.edit', [
            'types' => $types,
            'categories' => $categories,
            'arrTags' => $arrTags,
        ])
            ->layout('admin.layouts.app')
            ->layoutData([
                'title' => 'Edit Artikel',
                'bcs' => $bcs
            ]);
    }

    public function updated($field)
    {
        if ($this->slug == null || $this->slug == '' && $field == 'judul_artikel') {
            $this->slug = Str::slug($this->judul_artikel);
        }
    }

    public function update()
    {
        $data = Article::findOrFail($this->articleId);
        $validasi = $this->validate([
            'judul_artikel' => 'required|min:5',
            'slug' => 'required|unique:articles,slug,' . $this->articleId,
            'deskripsi' => 'nullable',
            'isi_artikel' => 'required',
            'rekomendasi' => 'required',
            'jenisId' => 'required',
            'kategori' => 'required',
            'tagsId' => 'required',
            'tanggal_publish' => 'required|date',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
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
            @$dom->loadHtml($domIsiArtikel, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $domImage = $dom->getElementsByTagName('img');
            if ($domImage && $domImage->length > 0) {
                foreach ($domImage as $k => $img) {
                    $domData = $img->getAttribute('src');
                    if (Str::startsWith($domData, 'data:')) {
                        list($type, $domData) = explode(';', $domData);
                        list($type, $domData) = explode(',', $domData);
                        $domData = base64_decode($domData);
                        $image_name = "/storage/images/" . time() . $k . '.png';
                        $path = public_path($image_name);
                        file_put_contents($path, $domData);
                        $img->removeAttribute('src');
                        $img->setAttribute('src', $image_name);
                    }
                }
                $domIsiArtikel = $dom->saveHTML();
            }
            // DOM UPLOAD IMAGE ON SUMMERNOTE

            $data->title = $this->judul_artikel;
            $data->type_id = $this->jenisId;
            $data->category_id = $this->kategori;
            $data->description = $this->deskripsi;
            $data->content = $domIsiArtikel;
            $data->is_recommend = $this->rekomendasi;
            $data->is_auto_publish = $autoPub;
            // $data->published_at = $this->tanggal_publish ?? now();
            $data->published_at = Carbon::parse($this->tanggal_publish)->format('Y-m-d H:i');
            if ($this->thumbnail) {
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

            $this->showToastr('success', 'Artikel berhasil diperbarui!');
        }
    }

    // SWEETALERT
    public function showAlert($icon, $title, $text)
    {
        $this->emit('swal:modal', [
            'icon'  => $icon,
            'title' => $title,
            'text'  => $text,
        ]);
    }

    // TOASTR
    public function showToastr($icon, $title)
    {
        $this->emit('swal:alert', [
            'icon'    => $icon,
            'title'   => $title,
            'timeout' => 10000
        ]);
    }
}
