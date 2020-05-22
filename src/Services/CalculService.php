<?php 
namespace App\Services; 
use Doctrine\ORM\EntityManager; 
use Doctrine\ORM\Id\AbstractIdGenerator; 

class CalculService {     
    
    public function additionner($a, $b)     
    {         
        return $a + $b;     
    } 

} 
