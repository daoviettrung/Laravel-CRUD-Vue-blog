<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
      
        return [
            'id' => $this->id,
            'title' => $this->title,
            'des' => $this->des,
            'detail' => $this->detail,
            'category' => $this->category,
            'public' => $this->public,
            'data_pubblic' => $this->data_pubblic,
            'position' => $this->position,
            'thumbs' => $this->thumbs,
        ];
    }
}
