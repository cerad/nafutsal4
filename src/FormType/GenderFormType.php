<?php
namespace App\FormType;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/* ==================================================================
 * Basic list of team levels
 */
class GenderFormType extends AbstractType
{
    public function getParent() { return ChoiceType::class; }
    public function getName()   { return 'cerad_team_gender'; }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'label'    => 'Gender',
            'choices'  => array_flip($this->choices),
            'multiple' => false,
            'expanded' => false,
        ));
    }
    protected $choices = array
    (
        'M' => 'Male',
        'F' => 'Female',
    );    
}

?>
