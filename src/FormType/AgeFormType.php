<?php
namespace App\FormType;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/* ==================================================================
 * Basic list of team levels
 */
class AgeFormType extends AbstractType
{
    public function getParent() { return ChoiceType::class; }
    public function getName()   { return 'cerad_team_age'; }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'label'    => 'Age',
            'choices'  => array_flip($this->choices),
            'multiple' => false,
            'expanded' => false,
        ));
    }
    protected $choices = array
    (
        'U09'   => 'U9',
        'U10'   => 'U10',
        'U11'   => 'U11',
        'U12'   => 'U12',
        'U13'   => 'U13',
        'U14'   => 'U14',
        'U15'   => 'U15',
        'U16'   => 'U16',
        'U17'   => 'U17',
        'U18'   => 'U18',
        'U19'   => 'U19',
        'U13-15 (MS)'   => 'U13-15 (MS)',
        'U16-19 (HS)'   => 'U16-19 (HS)',
        'Adult' => 'Adult',
    );    
}

?>
