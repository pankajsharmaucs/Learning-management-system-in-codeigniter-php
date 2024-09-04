<?php
/**
 * This file is part of the spiritix/html-to-pdf package.
 *
 * @copyright Copyright (c) Matthias Isler <mi@matthias-isler.ch>
 * @license   MIT
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Spiritix\HtmlToPdf\Output;

/**
 * Output handler for storing the PDF contents into a file.
 *
 * @package Spiritix\HtmlToPdf\Output
 * @author  Matthias Isler <mi@matthias-isler.ch>
 */
class FileOutput extends AbstractOutput
{
    /**
     * Stores the PDF content into a file.
     *
     * @throws OutputException If target file can't be created
     * @throws OutputException If content can't be written to target file
     *
     * @param string $filePath The target file name including full absolute path
     */
    public function store($filePath)
    {
        if (!file_exists($filePath) && !touch($filePath)) {
            throw new OutputException('Can\'t create target file');
        }

        if (file_put_contents($filePath, $this->getPdfData()) === false) {
            throw new OutputException('Can\'t write to target file');
        }
    }
}