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
                ->add('promotorNome', null, array('required' => true, 'label' => 'candidatura_form_promotorNome'))
                ->add('promotorProjecto', null, array('label' => 'candidatura_form_promotorProjecto'))
                ->add('promotorEmail', null, array('label' => 'candidatura_form_promotorEmail'))
                ->add('promotorTelefone', null, array('label' => 'candidatura_form_promotorTelefone'))
                ->add('promotorDescricaoPt', null, array('label' => 'candidatura_form_promotorDescricaoPt', 'attr' => array('maxlength' => 2000)))
                ->add('promotorDescricaoEn', null, array('label' => 'candidatura_form_promotorDescricaoEn', 'attr' => array('maxlength' => 2000)))
                //->add('documentoApresentacao')
                ->add('documentoFile', \Vich\UploaderBundle\Form\Type\VichFileType::class, [
                    'required' => false,
                    'allow_delete' => true,
                    'download_uri' => true,
                    'download_label' => 'candidatura_form_download_candidatura',
                    'label' => 'candidatura_form_documentoFile',
                    'translation_domain' => 'messages',
                    'constraints' => new \Symfony\Component\Validator\Constraints\File(array(
                        'maxSize' => '10M',
//                        'mimeTypes' => ["application/pdf", "application/x-pdf"],
//                        'mimeTypesMessage' => "Please upload a valid PDF",
//                        'maxSizeMessage' => "Upload not more than 2M size files"
                            )),
                ])
                ->add('cvFile', \Vich\UploaderBundle\Form\Type\VichFileType::class, [
                    'required' => false,
                    'allow_delete' => true,
                    'download_uri' => true,
                    'download_label' => 'candidatura_form_download_curriculo',
                    'label' => 'candidatura_form_cvFile',
                    'translation_domain' => 'messages',
                    'constraints' => new \Symfony\Component\Validator\Constraints\File(array(
                        'maxSize' => '10M'
                            )),
                ])
                ->add('imagemFile', \Vich\UploaderBundle\Form\Type\VichImageType::class, ['required' => false,
                    'allow_delete' => true,
                    'download_link' => true,
                    'label' => 'candidatura_form_imagemFile',
                    'translation_domain' => 'messages',
                    'constraints' => new \Symfony\Component\Validator\Constraints\File(array(
                        'maxSize' => '10M'
                            )),
                    ]
                )
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
