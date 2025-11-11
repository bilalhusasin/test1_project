<?php namespace App\Models;
 
use App\Models\BaseModel;

class ContentModel extends BaseModel
{
    protected $table = 'content';
    protected $allowedFields = [
        'name',
        'content',
        'page_id',
        'afbeelding'
    ];
}