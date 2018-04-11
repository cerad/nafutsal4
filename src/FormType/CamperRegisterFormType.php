<?php
namespace App\FormType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\NotBlank as NotBlankConstraint;

class CamperRegisterFormType extends AbstractType
{
    public function getName() { return 'cerad_camper_register'; }
   
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Camper',
            'error_bubbling' => true,
          //'required'   => false,
          //'csrf_protection' => false
        ));
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //for($year = 2015; $year > 2013; $year--) {$years1[] = $year;}
        //$builder->add('campDate', 'birthday', array('years' => $years1));
                                // birthday gives yyyy, mm, dd
        $builder->add('nameFirstCamper', TextType::class);
        $builder->add('initialCamper', TextType::class, array('required' => false));
        $builder->add('nameLastCamper', TextType::class);
        $builder->add('gender', GenderFormType::class);

        $years = [];
        //r($year = 2009; $year > 2001; $year--) {$years[] = $year;}
        for($year = 2003; $year > 1998; $year--) {$years[] = $year;}
        $builder->add('dob', BirthdayType::class, array('years' => $years));
                
        $builder->add('street', TextType::class);
        $builder->add('city',   TextType::class);
        $builder->add('state',  TextType::class);
        $builder->add('zipCode',TextType::class);
        
        $builder->add('phoneCamper',          PhoneFormType::class,array('label' => "Camper's Phone",            'required' => true));
        $builder->add('phoneParent',          PhoneFormType::class,array('label' => "Parent's Phone",            'required' => false));
        $builder->add('phoneDoctor',          PhoneFormType::class,array('label' => "Doctor's Phone",            'required' => false));
        $builder->add('phoneEmergencyContact',PhoneFormType::class,array('label' => "Emergency Contact's Phone", 'required' => true));

        $builder->add('jerseyNumber', IntegerType::class,   array('required' => false));
        $builder->add('indoorExperience', TextType::class);
        $builder->add('outdoorExperience', TextType::class);
        $builder->add('shirtSize', TextType::class,   array('required' => false));

        $builder->add('emailAddress', RepeatedType::class, array(
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
        
        $builder->add('nameFirstParent', TextType::class);
        $builder->add('nameLastParent',  TextType::class);
        $builder->add('relationship',  TextType::class);
        
        $builder->add('medicalConditions', TextType::class, array('required' => false, 'attr' => array('size' => 50)));
        $builder->add('nameDoctor', TextType::class, array('required' => false));
        $builder->add('nameEmergencyContact', TextType::class);
        
        $builder->add('volunteerism',TextType::class, array('required' => false, 'attr' => array('size' => 50)));
        $builder->add('project',ChoiceType::class,array(
            'label' => 'camp',
            'multiple' => false,
            'expanded' => false,
            'choices' => array_flip(array(
                'NAFUTSAL_Academy_2018_Summer' => 'June/July,2018',
                'NAFUTSAL_Camp_2018-03-27' => 'March 27/29, 2018',
                'NAFUTSAL_Camp_2017-11-03' => 'November 3, 2017',
                'NAFUTSAL_Camp_2016-11-10' => 'November 10, 2016',
                'NAFUTSAL_Camp_2016-05-21' => 'May 21, 2016',
                'NAFUTSAL_Camp_2015-01-11' => 'January 11, 2015',
                'NAFUTSAL_Camp_2014-11-07' => 'November 7, 2014',
                'NAFUTSAL_Camp_2014-07-01' => 'July 1, 2014'))
        ));
    }
}
?>
