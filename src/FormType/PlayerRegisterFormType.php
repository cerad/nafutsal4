<?php
namespace App\FormType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\NotBlank as NotBlankConstraint;

class PlayerRegisterFormType extends AbstractType
{
    public function getName() { return 'cerad_player_register'; }
   
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Player',
            'error_bubbling' => true,
            'required'   => true,
            // 'csrf_protection' => false
        ));
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //for($year = 2015; $year > 2013; $year--) {$years1[] = $year;}
        //$builder->add('playDate', 'birthday', array('years' => $years1));
                                // birthday gives yyyy, mm, dd
        $builder->add('nameFirstPlayer', TextType::class, array('required' => true));
        $builder->add('initialPlayer', TextType::class,   array('required' => false));
        $builder->add('nameLastPlayer', TextType::class,  array('required' => true));
        $builder->add('gender', GenderFormType::class, array('required' => true));
        $years = [];
        for($year = 1999; $year > 1930; $year--) {$years[] = $year;}
        $builder->add('dob', BirthdayType::class, array('years' => $years, 'required' => true));
                
        $builder->add('street', TextType::class, array('required' => true));
        $builder->add('city',   TextType::class, array('required' => true));
        $builder->add('state',  TextType::class, array('required' => true));
        $builder->add('zipCode',TextType::class, array('required' => true));
        
        $builder->add('phonePlayer',          PhoneFormType::class,array('label' => "Player's Phone",            'required' => true));
        $builder->add('phoneParent',          PhoneFormType::class,array('label' => "Parent's Phone",            'required' => false));
        $builder->add('phoneDoctor',          PhoneFormType::class,array('label' => "Doctor's Phone",            'required' => false));
        $builder->add('phoneEmergencyContact',PhoneFormType::class,array('label' => "Emergency Contact's Phone", 'required' => true));

        $builder->add('jerseyNumber', IntegerType::class,   array('required' => false));
        $builder->add('indoorExperience', TextType::class,  array('required' => false));
        $builder->add('outdoorExperience', TextType::class, array('required' => false));
        $builder->add('shirtSize', TextType::class,   array('required' => false));

        $builder->add('emailAddress', RepeatedType::class, array(
            'type'     => EmailType::class,
            'label'    => 'Email',
            'required' => true,
            'attr'     => array('size' => 40),
            'error_bubbling' => true,
            
            'invalid_message' => 'The email fields must match.',
            'constraints'     => new NotBlankConstraint(),
            'first_options'   => array('label' => 'Email',         'attr' => array('size' => 40)),
            'second_options'  => array('label' => 'Email (confirm)','attr' => array('size' => 40)),
            
            'first_name'  => 'email1',
            'second_name' => 'email2',
        ));
        
        $builder->add('paidAnnualUSFFplayerFee', CheckboxType::class,   array('required' => false));

        $builder->add('nameFirstParent', TextType::class, array('required' => false));
        $builder->add('nameLastParent',  TextType::class, array('required' => false));
        $builder->add('relationship',  TextType::class,   array('required' => false));
        
        $builder->add('medicalConditions', TextType::class,    array('required' => false, 'attr' => array('size' => 50)));
        $builder->add('nameDoctor', TextType::class,           array('required' => false));
        $builder->add('nameEmergencyContact', TextType::class, array('required' => false));
        
        $builder->add('volunteerism',TextType::class, array('required' => false, 'attr' => array('size' => 50)));
        $builder->add('project',ChoiceType::class,array(
            'label' => 'play',
            'multiple' => false,
            'expanded' => false,
            'required' => true,
            'choices' => array_flip(array('NAFUTSAL_Player_2017-18_winter_season' => 'Winter Season 2017/18'))
        ));
    }
}
