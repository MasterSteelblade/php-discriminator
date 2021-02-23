<?php 

declare(strict_types=1);

namespace Steelblade\Discriminator\tests;

use Steelblade\Discriminator;


final class DiscriminatorTest extends \PHPUnit\Framework\TestCase {
    public function testZeroDiscriminator() {
        $result = Discriminator::format(0);
        $this->assertEquals('0000', $result, 'Discriminator format function failed on 0!');
    }

    public function testShortDiscriminator() {
        $result = Discriminator::format(101);
        $this->assertEquals('0101', $result, 'Discriminator format function failed on short format!');
    }

    public function testShorterDiscriminator() {
        $result = Discriminator::format(11);
        $this->assertEquals('0011', $result, 'Discriminator format function failed on very short format!');
    }

    public function testLongDiscriminator() {
        $result = Discriminator::format(11121);
        $this->assertEquals('9999', $result, 'Discriminator format function failed on long format!');
    }

    public function testShortConstruct() {
        $disc = new Discriminator(12);
        $this->assertEquals('0012', strval($disc), 'Constructing short discriminator failed.');
    }

    public function testLongConstruct() {
        $disc = new Discriminator(121212);
        $this->assertEquals('9999', strval($disc), 'Constructing long discriminator failed.');
    }

    public function testConstruct() {
        $disc = new Discriminator(1212);
        $this->assertEquals('1212', strval($disc), 'Constructing correct discriminator failed.');
    }

    public function testFormat() {
        $disc = Discriminator::format(1212);
        $this->assertEquals('1212', strval($disc), 'Formatting correct discriminator failed.');
    }
}

