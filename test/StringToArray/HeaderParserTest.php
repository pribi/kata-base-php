<?php
namespace Kata\StringToArray;

/**
 * Class HeaderParserTest
 *
 * @package StringToArray
 */
class HeaderParserTest extends \PHPUnit_framework_TestCase
{
    /**
     * Test for checking first line contains a label
     *
     * @param bool $expectedReturnValue
     * @param string $string
     *
     * @dataProvider checkFirstLineContainsLabelDataProvider
     */
    public function testCheckFirstLineContainsLabel($expectedReturnValue, $string)
    {
        $headerParser = new HeaderParser();
        $this->assertSame($expectedReturnValue, $headerParser->checkFirstLineContainsLabel($string));
    }

    /**
     * Data provider for check first line contains label test
     *
     * @return array
     */
    public function checkFirstLineContainsLabelDataProvider()
    {
        return array(
            array(false, ""),
            array(false, "\n#useFirstLineAsLabels"),
            array(false, "#useFirstLineAsLabels\n"),
            array(true, "#useFirstLineAsLabels\nasdf\n"),
            array(true, "#useFirstLineAsLabels\nlabel1\ndata1"),
        );
    }

    /**
     * Test for checking first line contains a header
     *
     * @param bool $expectedReturnValue
     * @param string $string
     *
     * @dataProvider checkFirstLineContainsHeaderDataProvider
     */
    public function testCheckFirstLineContainsHeader($expectedReturnValue, $string)
    {
        $headerParser = new HeaderParser();
        $this->assertSame($expectedReturnValue, $headerParser->checkFirstLineContainsHeader($string));
    }

    /**
     * Data provider for check first line contains header test
     *
     * @return array
     */
    public function checkFirstLineContainsHeaderDataProvider()
    {
        return array(
            array(false, ""),
            array(false, "\n#useFirstLineAsLabels"),
            array(false, "#useFirstLineAsLabels\n"),
            array(false, "#useFirstLineAsLabels\nasdf\n"),
            array(false, "#useFirstLineAsLabels\nlabel1\ndata1"),
            array(true, "#useFirstLineAsLabels=1&columnDelimiter=,&lineDelimiter=%0A\n"),
        );
    }

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
        $headerParser = new HeaderParser();
        $this->assertSame($expectedReturnValue, $headerParser->splitToLines($string));
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
}
