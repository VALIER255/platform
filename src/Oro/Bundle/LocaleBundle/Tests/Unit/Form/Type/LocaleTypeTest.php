<?php

namespace Oro\Bundle\LocaleBundle\Tests\Unit\Form\Type;

use Oro\Bundle\LocaleBundle\Form\Type\LocaleType;
use Symfony\Component\Form\Extension\Core\Type\LocaleType as BaseLocaleType;
use Symfony\Component\Intl\Intl;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocaleTypeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LocaleType
     */
    protected $formType;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->formType = new LocaleType();
    }

    public function testConfigureOptions()
    {
        /* @var $resolver OptionsResolver|\PHPUnit_Framework_MockObject_MockObject */
        $resolver = $this->createMock('Symfony\Component\OptionsResolver\OptionsResolver');
        $resolver->expects($this->once())
            ->method('setDefaults')
            ->with([
                'choices' => array_flip(Intl::getLocaleBundle()->getLocaleNames('en')),
            ]);

        $this->formType->configureOptions($resolver);
    }

    public function testGetParent()
    {
        $this->assertEquals(BaseLocaleType::class, $this->formType->getParent());
    }

    public function testGetName()
    {
        $this->assertEquals('oro_locale', $this->formType->getName());
    }
}
