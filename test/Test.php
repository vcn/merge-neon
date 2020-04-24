<?php

namespace Vcn\MergeNeon;

use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    public function testCommand(): void
    {
        $result = shell_exec('./merge-neon --multiline test/one.neon test/two.neon');

        self::assertEquals(
            trim(file_get_contents('test/expected.neon')),
            trim($result)
        );
    }
}
