<?php namespace App\Models;
use CodeIgniter\Model;

class TagModel extends Model
{
        protected $table      = 'tag';
        protected $primaryKey = 'idTag';
        protected $returnType = 'object';
        
        protected $allowedFields = ['datumVreme'];   //polja koja se menjaju
         
}
        
    

