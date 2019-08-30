<?php

namespace App\Http\Resources;

use App\Article;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
           'name' => $this->firstname. ' '.$this->lastname,
            'email' => $this->email,
            'provider' => $this->provider,
            'verified' => $this->status,
            'user_since' => (string)$this->created_at->format('m/d/Y'),
            'number_of_articles' => count(Article::whereUserId($this->id)->get())
        ];
    }

    public function with($request)
    {
        return [
            'api_version' => '1.0.0'
        ];
    }
}
