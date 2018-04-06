<?php
namespace App\FormType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\NotBlank as NotBlankConstraint;

class TeamRegisterFormType extends AbstractType
{
    public function getName() { return 'cerad_team_register'; }
   
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Team',
            'error_bubbling' => true,
          //'required'   => false,
        ));
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('teamName',  TextType::class, array('label' => 'Team name'));
        $builder->add('teamAge',   AgeFormType::class);
        $builder->add('teamGender',GenderFormType::class);
        $builder->add('teamColor', TextType::class, array('label' => 'Jersey color','required' => false));

        $years = [];
        for($year = 1999; $year > 1930; $year--) $years[] = $year;
        
        $builder->add('nameFirst', TextType::class);
        $builder->add('nameLast',  TextType::class);
        $builder->add('dob',       BirthdayType::class, array('years' => $years));
        $builder->add('gender',    GenderFormType::class);

        $builder->add('email', RepeatedType::class, array(
            'type'     => EmailType::class,
            'label'    => 'Email',
            'required' => true,
            'attr'     => array('size' => 40),
            'error_bubbling' => true,
            
            'invalid_message' => 'The email fields must match.',
            'constraints'     => new NotBlankConstraint(),
            'first_options'   => array('label' => 'Email',         'attr' => array('size' => 40),),
            'second_options'  => array('label' => 'Email (confirm)','attr' => array('size' => 40),),
            
            'first_name'  => 'email1',
            'second_name' => 'email2',
        ));
        
        $builder->add('phoneHome',PhoneFormType::class,array('label' => 'Home Phone', 'required' => true));
        $builder->add('phoneCell',PhoneFormType::class,array('label' => 'Cell Phone', 'required' => false));
        $builder->add('phoneWork',PhoneFormType::class,array('label' => 'Work Phone', 'required' => false));
        
        $builder->add('street', TextType::class);
        $builder->add('city',   TextType::class);
        $builder->add('state',  TextType::class);
        $builder->add('zipCode',TextType::class);
        
        $builder->add('learn',TextType::class, array('required' => false, 'attr' => array('size' => 40)));
        
    }
}
