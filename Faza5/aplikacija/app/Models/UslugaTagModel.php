<?php  namespace App\Models;
use CodeIgniter\Model;

class UslugaTagModel extends Model
{
        protected $table      = 'uslugatag';
        protected $primaryKey = 'idUslTag';
        protected $returnType = 'object';
        
        
        protected $allowedFields = ['idUsl','idTag'];   //polja koja se menjaju
        
        
         
}