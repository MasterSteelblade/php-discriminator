<?php 

namespace Steelblade\Discriminator;

/**
 * This is a very simple class designed to make things like
 * user discriminators a tiny bit easier to use. 
 * 
 * @see https://github.com/MasterSteelblade/php-discriminator
 * 
 * @author Benjamin Clarke <mastersteelblade@protonmail.com>
 */

    class Discriminator {

        /**
         * The integer value of the discriminator. 
         * 
         * @var int
         */
        private int $discriminator = 0;

        /** 
         * Constructs an instance of the Discriminator class.
         * 
         * @param int|null   $input     The discriminator desired. If left as null, one will be generated. 
        */
        public function __construct(?int $input = 0) {
            if ($input === null) {
                $number = Discriminator::generate();
            } elseif (is_numeric($input)) {
                $number = intval($input);
            } else {
                $number = Discriminator::generate();
            }
            $string = strval(abs($number));
            if (strlen($string) > 4) {
                $this->discriminator = 9999;
            }
            $this->discriminator = intval($number);
        }


        /** 
         * Takes a value and formats it as a discriminator. Returns 0000 if it's not a valid
         * discriminator, and shortens anything too long to 9999. 
         * 
         * It can return 0000 if the integer value of the discriminator is 0. It is up to users 
         * to decide whether this is acceptable, or whether such discriminators should be reserved
         * for special cases. 
         * 
         * Returns a string.
         * 
         * @param mixed     $discriminator      The discriminator to format as a string.
         */
        public static function format($discriminator):string {
            $string = strval(intval($discriminator));
            if (strlen($string) > 4) {
                return '9999';
            } else {
                while (strlen($string) < 4) {
                    $string = '0'.$string;
                }
                return $string;
            }
        }

        /**
         * Generates a discriminator. 
         */

         public static function generate():int {
             return random_int(0, 9999);
         }

         public function get():int {
             return $this->discriminator;
         }

        /** 
         * Magic method, returns a representation of the discriminator when used in a string.
         */
        public function __toString() {
            return Discriminator::format($this->discriminator);
        }
    }

