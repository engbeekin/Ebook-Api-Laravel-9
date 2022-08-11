<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'pages' => $this->pages,
            'publishing_year' => $this->publishing_year,
            'image' => asset('storage/bookImages/'.$this->image),
            'file_upload' => asset('storage/bookFileUpload/'.$this->file_upload),
            'authors' => AuthorResource::collection($this->whenLoaded('authors')),
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),

        ];
    }
}
