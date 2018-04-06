<?php
namespace App\FormType;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/* ==================================================================
 * Basic list of team levels
 */
class LevelFormType extends AbstractType
{
    public function getParent() { return ChoiceType::class; }
    public function getName()   { return 'cerad_team_level'; }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'label'    => 'Division',
            'choices'  => array_flip($this->choices),
            'multiple' => false,
            'expanded' => false,
        ));
    }
    protected $choices = array
    (
        'NAFUTSAL_U19B' => 'U19 Boys',
        'NAFUTSAL_O30M' => 'Adults, Over 30, Men',
    );    
}

?>
