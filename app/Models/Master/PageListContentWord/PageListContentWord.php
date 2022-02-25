<?php

namespace App\Models\Master\PageListContentWord;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class PageListContentWord extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = ['page_list_id', 'content_word_id'];

    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('page_list_id', '=', $this->getAttribute('page_list_id'))
            ->where('content_word_id', '=', $this->getAttribute('content_word_id'));
        return $query;
    }

    public $incrementing = false;
}
