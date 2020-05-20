<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class OnlyLetter extends Constraint
{
    public $message = 'Le nom de  "{{ auteur }}" contient des chiffres c\'est interdit.';

    public function validatedBy()
    {
        return \get_class($this).'Validator';
    }
}
?>