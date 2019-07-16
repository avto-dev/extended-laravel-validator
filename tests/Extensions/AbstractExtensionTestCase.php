<?php

declare(strict_types = 1);

namespace AvtoDev\ExtendedLaravelValidator\Tests\Extensions;

use AvtoDev\ExtendedLaravelValidator\AbstractValidatorExtension;
use AvtoDev\ExtendedLaravelValidator\Tests\AbstractUnitTestCase;

abstract class AbstractExtensionTestCase extends AbstractUnitTestCase
{
    /**
     * @var AbstractValidatorExtension
     */
    protected $instance;

    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $class_name = $this->getExtensionClassName();

        $this->instance = new $class_name;
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown(): void
    {
        unset($this->instance);

        parent::tearDown();
    }

    /**
     * Тест того, что расширение производит валидацию заведомо верных значений.
     *
     * @return void
     */
    public function testPassesWithValidValues(): void
    {
        $validator = $this->getValidator();

        foreach ($values = $this->getValidValues() as $valid_value) {
            $result = $validator->make([
                'value' => $valid_value,
            ], [
                'value' => 'required|' . $this->instance->name(),
            ]);

            $this->assertFalse($result->fails(), sprintf(
                'Value "%s" must be detected as a VALID "%s"',
                $valid_value,
                $this->instance->name()
            ));
        }

        $this->assertGreaterThanOrEqual(1, count($values));
    }

    /**
     * Тест того, что расширение "заваливает" валидацию заведомо НЕ верных значений.
     *
     * @return void
     */
    public function testFailsWithInvalidValues(): void
    {
        $validator = $this->getValidator();

        foreach ($values = $this->getInvalidValues() as $invalid_value) {
            $result = $validator->make([
                'value' => $invalid_value,
            ], [
                'value' => 'required|' . $this->instance->name(),
            ]);

            $this->assertTrue($result->fails(), sprintf(
                'Value "%s" must be detected as INVALID "%s"',
                $invalid_value,
                $this->instance->name()
            ));
        }

        $this->assertGreaterThanOrEqual(1, count($values));
    }

    /**
     * Возвращает массив **корректных** значений для данного правила валидации.
     *
     * @return string[]
     */
    abstract protected function getValidValues(): array;

    /**
     * Возвращает массив **НЕ корректных** значений для данного правила валидации.
     *
     * @return string[]
     */
    abstract protected function getInvalidValues(): array;

    /**
     * Возвращает имя класса тестируемого расширения для валидатора.
     *
     * @return string
     */
    abstract protected function getExtensionClassName(): string;
}
