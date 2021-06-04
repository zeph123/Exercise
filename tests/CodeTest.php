<?php 

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Service\CodeValidator;

final class CodeTest extends TestCase 
{
    /**
     * @dataProvider correctNumbersProvider
     */
    public function testNumbersAreCorrect(string $number): void
    {
        $validator = new CodeValidator();
        $this->assertTrue($validator->validateCode($number));
    }

    public function correctNumbersProvider(): array
    {
        return [
            ["000000049617410"],
            ["000000168255001"],
            ["00000512752451M"],
            ["000032225342500"]
        ];
    }

    /**
     * @dataProvider incorrectNumbersProvider
     */
    public function testNumbersAreIncorrect(string $number): void
    {
        $validator = new CodeValidator();
        $this->assertFalse($validator->validateCode($number));
    }

    public function incorrectNumbersProvider(): array
    {
        return [
            ["000126472561551"],
            ["1275M0215151180"],
            ["0255B0156124567"],
            ["00001236256212M"]
        ];
    }

}