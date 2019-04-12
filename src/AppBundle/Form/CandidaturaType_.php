<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class CandidaturaType_ extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                //->add('categoria',  \Symfony\Component\Form\Extension\Core\Type\HiddenType::class)
                ->add('fosUser');
        
        $builder->add('respostas', CollectionType::class, [
            'entry_type' => RespostaType::class,
            'entry_options' => ['label' => false],
//            'by_reference' => false,
//             'allow_add' => true,
        ]);
        
        
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Candidatura'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_candidatura';
    }


}
