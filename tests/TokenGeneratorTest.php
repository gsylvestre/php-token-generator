<?php

use PHPUnit\Framework\TestCase;
use PHPTokenGenerator\TokenGenerator;

class TokenGeneratorTest extends TestCase
{
    public function testTokenDoNotContainsSimilarCharacters()
    {
        $generator = new TokenGenerator();

        //with second param
        $token = $generator->generate(300, true);

        $this->assertStringNotContainsString("I", $token);
        $this->assertStringNotContainsString("1", $token);
        $this->assertStringNotContainsString("l", $token);
        $this->assertStringNotContainsString("0", $token);
        $this->assertStringNotContainsString("O", $token);
        $this->assertStringNotContainsString("o", $token);

        //without second param
        $token = $generator->generate(300);

        $this->assertStringNotContainsString("I", $token);
        $this->assertStringNotContainsString("1", $token);
        $this->assertStringNotContainsString("l", $token);
        $this->assertStringNotContainsString("0", $token);
        $this->assertStringNotContainsString("O", $token);
        $this->assertStringNotContainsString("o", $token);

    }

    public function testTokenDoNotContainsNotUrlSafeCharacters()
    {
        $generator = new TokenGenerator();

        $token = $generator->generate(10, true);
        $this->assertRegExp("/^[a-zA-Z0-9]{10}$/", $token);

        $token = $generator->generate(500, true);
        $this->assertRegExp("/^[a-zA-Z0-9]{500}$/", $token);

        $token = $generator->generate(300, false);
        $this->assertRegExp("/^[a-zA-Z0-9]{300}$/", $token);
    }

    public function testTokenIsRightLength()
    {
        $generator = new TokenGenerator();

        for($i=1; $i<1000; $i++){
            $token = $generator->generate($i);
            $this->assertEquals($i, mb_strlen($token));
        }

        for($i=1; $i<1000; $i++){
            $token = $generator->generate($i, false);
            $this->assertEquals($i, mb_strlen($token));
        }

        $this->assertEquals(64, mb_strlen($generator->generate(64)));
        $this->assertEquals(12, mb_strlen($generator->generate(12)));
        $this->assertEquals(300, mb_strlen($generator->generate(300)));
        $this->assertEquals(64, mb_strlen($generator->generate(64, false)));
        $this->assertEquals(12, mb_strlen($generator->generate(12, false)));
        $this->assertEquals(300, mb_strlen($generator->generate(300, false)));

        return false;
    }

    public function testTokenUnicity()
    {
        $tokens = [];

        $generator = new TokenGenerator();

        for($i=0; $i<2000; $i++)
        {
            $token = $generator->generate(10);
            $this->assertNotContains($token, $tokens);
            $tokens[] = $token;
        }
    }
}