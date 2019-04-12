<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CandidaturaType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('promotorNome')
                ->add('promotorProjecto')
                ->add('promotorEmail')
                ->add('promotorTelefone')
                ->add('promotorDescricaoPt')
                ->add('promotorDescricaoEn')
                //->add('documentoApresentacao')
                ->add('documentoFile', \Vich\UploaderBundle\Form\Type\VichFileType::class, [
                    'required' => false,
                    'allow_delete' => true,
                    'download_uri' => true,
                    'download_label' => 'Click para Download - Documento de Candidatura',
                ])
                //->add('categoria')
                ->add('respostas', CollectionType::class, [
                    'entry_type' => RespostaType::class,
                    'entry_options' => ['label' => false],
                ]);
                //->add('fosUser')
    }

/**
     * {@inheritdoc}
     */

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Candidatura'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_candidatura';
    }

}
