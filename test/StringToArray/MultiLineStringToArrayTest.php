<?php
namespace Kata\StringToArray;

/**
 * Class MultiLineStringToArray
 *
 * @package StringToArray
 */
class MultiLineStringToArrayTest extends \PHPUnit_framework_TestCase
{
    /**
     * Test splitToLines method
     *
     * @param array  $expectedReturnValue Expected return value
     * @param string $string              String
     *
     * @dataProvider splitToLinesDataProvider
     *
     */
    public function testSplitToLines($expectedReturnValue, $string)
    {
        $multiLineStringToArray = new MultiLineStringToArray();
        $this->assertSame($expectedReturnValue, $multiLineStringToArray->splitToLines($string));
    }

    /**
     * Data provider for split to lines test
     *
     * @return array
     */
    public function splitToLinesDataProvider()
    {
        return  array(
            array(
                array(''),
                ""
            ),
            array(
                array('', 'asdf', '', ''),
                "\nasdf\n\n"
            ),
            array(
                array('211,22,35', '10,20,33'),
                "211,22,35\n10,20,33"
            ),
            array(
                array('luxembourg,kennedy,44', 'budapest,expo ter,5-7', 'gyors,fo utca,9'),
                "luxembourg,kennedy,44\nbudapest,expo ter,5-7\ngyors,fo utca,9"
            )
        );
    }

    /**
     * Test stringToArray method
     *
     * @param array  $expectedReturnValue Expected return value
     * @param string $string              String
     *
     * @dataProvider stringToArrayDataProvider
     *
     */
    public function testStringToArray($expectedReturnValue, $string)
    {
        $multiLineStringToArray = new MultiLineStringToArray();
        $this->assertEquals($expectedReturnValue, $multiLineStringToArray->stringToArray($string));
    }

    /**
     * Data provider for string to array test
     *
     * @return array
     */
    public function stringToArrayDataProvider()
    {
        return  array(
            array(
                array(
                    array('')
                ),
                ""
            ),
            array(
                array(
                    array(''),
                    array('asdf'),
                    array(''),
                    array('')
                ),
                "\nasdf\n\n"
            ),
            array(
                array(
                    array('211', '22', '35'),
                    array('10', '20', '33')
                ),
                "211,22,35\n10,20,33"
            ),
            array(
                array(
                    array('luxembourg', 'kennedy', '44'),
                    array('budapest', 'expo ter', '5-7'),
                    array('gyors', 'fo utca', '9')
                ),
                "luxembourg,kennedy,44\nbudapest,expo ter,5-7\ngyors,fo utca,9"
            ),
            array(
                (object)array(
                    'labels' => array('Name', 'Email', 'Phone'),
                    'data' => array(
                        array('Mark', 'marc@be.com', '998'),
                        array('Noemi', 'noemi@ac.co.uk', '888')
                    )
                ),
                "#useFirstLineAsLabels\nName,Email,Phone\nMark,marc@be.com,998\nNoemi,noemi@ac.co.uk,888"
            )
        );
    }
}
