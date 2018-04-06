<?php
namespace App\FormType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;

use App\DataTransformer\PhoneTransformer;

class PhoneFormType extends AbstractType
{   
    public function getName()   { return 'cerad_team_phone'; }
    public function getParent() { return TextType::class; }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Note the use of both transformer
        $transformer = new PhoneTransformer();
        $builder->addModelTransformer($transformer);
        $builder->addViewTransformer ($transformer);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'label' => 'Phone',
            'attr'  => array('size' => 20),
        ));
    }
}

?>
