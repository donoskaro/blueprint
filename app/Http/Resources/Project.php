<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Project extends Resource
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
            'name' => $this->name,
            'description' => $this->description,
            'email' => $this->email,
            'files' => $this->mapFiles(),
            'created_at' => $this->created_at->format('c'),
            'updated_at' => $this->updated_at->format('c'),
        ];
    }

    /**
     * Transforms file entries into the format that we want to present in the
     * API response.
     *
     * @return array
     */
    private function mapFiles()
    {
        return $this->files->map(function ($file) {
           return [
               'id' => $file->id,
               'name' => $file->name,
               'created_at' => $file->created_at->format('c'),
           ];
        });
    }
}
