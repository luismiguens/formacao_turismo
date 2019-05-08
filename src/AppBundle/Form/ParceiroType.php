<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class ParceiroType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('nome')
                ->add('isJuri')
                ->add('imagemFile', \Vich\UploaderBundle\Form\Type\VichImageType::class, [
//                    'required' => false,
//                    'label' => "Imagem",
//                    'allow_delete' => true,
//                    'download_link' => true
                    'required' => false,
                    'allow_delete' => true,
                    'download_uri' => true,
                    'download_label' => 'Click para Download - Certidão Permantente',
                    'constraints' => new \Symfony\Component\Validator\Constraints\File(array(
                        'maxSize' => '1M'
                            )),
                
                    ])
                ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Parceiro'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_parceiro';
    }


}
