<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoriaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//                ->add('promotorNome')
//                ->add('promotorProjecto')
//                ->add('promotorEmail', \Symfony\Component\Form\Extension\Core\Type\EmailType::class)
//                ->add('promotorTelefone')
                ->add('tituloPt')
                ->add('tituloEn')
                ->add('descricaoPt', \Symfony\Component\Form\Extension\Core\Type\TextareaType::class)
                ->add('descricaoEn', \Symfony\Component\Form\Extension\Core\Type\TextareaType::class)
//                ->add('imagem')
                ->add('imagemFile', \Vich\UploaderBundle\Form\Type\VichImageType::class, ['required' => false,
                    'label' => "Imagem",
                    'allow_delete' => true,
                    'download_link' => true])
                ->add('candidaturaVencedora');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Categoria'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_categoria';
    }


}
