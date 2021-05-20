<?php namespace App\Models;
use CodeIgniter\Model;

class TagModel extends Model
{
        protected $table      = 'tag';
        protected $primaryKey = 'idTag';
        protected $returnType = 'array';
        
        
        protected $allowedFields = ['opis'];   //polja koja se menjaju
         
}
        
    

