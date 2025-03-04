<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentRecourses extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'department'=>$this->department,
            'title'=>$this->title,
            'file'=>$this->file,
            'created_at'=>$this->created_at
        ];
    }
}
