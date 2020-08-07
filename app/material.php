<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;
class material extends Model
{
    use UuidTrait;
    public $table = "materials";
    protected $fillable = ['uuid', 'thumbnail', 'title', 'content'];
}