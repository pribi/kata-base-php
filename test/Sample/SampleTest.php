<?php
namespace Kata\Sample;

/**
 * Class SampleTest
 *
 * @package Sample
 */
class SampleTest extends \PHPUnit_framework_TestCase
{
    /**
     * Set up
     */
    public function setUp()
    {
    }

    /**
     * Test sample method
     */
    public function testSample()
    {
        $sample = new Sample();
        $this->assertSame(true, $sample->Sample());
    }

    /**
     * Tear down
     */
    public function tearDown()
    {
    }
}
