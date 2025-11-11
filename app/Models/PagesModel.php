<?php namespace App\Models;
 
use App\Models\BaseModel;
 
class PagesModel extends BaseModel
{
    protected $table = 'pages';
    protected $allowedFields = [
        'name',
        'url',
        'template',
        'content',
        'meta-title', 
        'meta-desc',
        'order_id',
        'content'
    ];
}