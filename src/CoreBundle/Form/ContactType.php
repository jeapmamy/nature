<?php

namespace CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			
            ->add('nom', TextType::class, array(
				'label' => false,
				'required'	=> true,
				'constraints' => array(
                    new NotBlank(array("message" => "Veuillez remplir ce champ")),
				)
			))
            ->add('prenom', TextType::class, array(
				'required'	=> true,
				'constraints' => array(
                    new NotBlank(array("message" => "Veuillez remplir ce champ")),
				)
			))
            ->add('email', EmailType::class, array(
				'required'	=> true,
				'constraints' => array(
                    new NotBlank(array("message" => "Veuillez remplir ce champ")),
				)
			))
            ->add('message', TextareaType::class, array(
				'required'	=> true,
				'constraints' => array(
                    new NotBlank(array("message" => "Veuillez remplir ce champ")),
				)
			))
			->add('envoyer', SubmitType::class)
        ;
    }
	
    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'error_bubbling' => true
        ));
    }
	
    public function getName()
    {
        return 'contact_form';
    }
}