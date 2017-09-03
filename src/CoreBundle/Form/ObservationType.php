<?php

namespace CoreBundle\Form;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObservationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

			->add('date',		DateType::class, array(
				'widget' 	=> 'single_text',
				'format' 	=> 'dd/MM/yyyy',
				'html5' 	=> false,
				'attr'		=> array(
					'class' 	=> 'form-control input-inline',
					'readonly' 	=> true,)
				)
			)
      ->add('espece',    EspeceType::class, array('data_class' => null))
			->add('latitude',	NumberType::class)
			->add('longitude',	NumberType::class)
			->add('image',		FileType::class)
			->add('save',		SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CoreBundle\Entity\Observation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'corebundle_observation';
    }


}
