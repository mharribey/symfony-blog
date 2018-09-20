<?php

    namespace App\Form;

    use App\Entity\User;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\Form\Extension\Core\Type\PasswordType;

    class LoginType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->add('_username')
                ->add('_password', PasswordType::class)
                ->add('login', SubmitType::class)
            ;
        }

        public function getBlockPrefix()
        {
            return null;
        }

    }