<?php

namespace Lexik;

use Symfony\Component\HttpFoundation\Request;

/**
 * TokenExtractorInterface
 *
 * @author Nicolas Cabot <n.cabot@lexik.fr>
 */
interface TokenExtractorInterface
{
    /**
     * @param Request $request
     *
     * @return string
     */
    public function extract(Request $request);
}
