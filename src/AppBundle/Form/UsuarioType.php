<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomUser', TextType::class, array('label'=>'Nombre'))
                ->add('appUser', TextType::class, array('label'=>'Apellido'))
                ->add('cedUser', TextType::class, array('label'=>'Cedula'))
                ->add('emailUser', EmailType::class, array('label'=>'Email'))
                ->add('userEmpFk',EntityType::class, array('class'=>'AppBundle:Empresa',
                                                                        'query_builder' => function (EntityRepository $er) {
                                                                            return $er->createQueryBuilder('emp')
                                                                                ->where('emp.estEmp=1');
                                                                        },
                                                                                 'choice_label'=>'decEmp'));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Usuario'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_usuario';
    }


}
