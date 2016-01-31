<?php

/*
 * This file is part of the PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Symfony\CS\Tests\Tokenizer\Transformer;

use Symfony\CS\Tests\Tokenizer\AbstractTransformerTestBase;
use Symfony\CS\Tokenizer\Tokens;

/**
 * @author Dariusz Rumiński <dariusz.ruminski@gmail.com>
 */
class DynamicPropBraceTest extends AbstractTransformerTestBase
{
    /**
     * @dataProvider provideProcessCases
     */
    public function testProcess($source, array $expectedTokens)
    {
        $tokens = Tokens::fromCode($source);

        foreach ($expectedTokens as $index => $name) {
            $this->assertSame(constant($name), $tokens[$index]->getId());
            $this->assertSame($name, $tokens[$index]->getName());
        }
    }

    public function provideProcessCases()
    {
        return array(
            array(
                '<?php $foo->{$bar};',
                array(
                    3 => 'CT_DYNAMIC_PROP_BRACE_OPEN',
                    5 => 'CT_DYNAMIC_PROP_BRACE_CLOSE',
                ),
            ),
        );
    }
}
