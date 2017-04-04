<?php

namespace Api;

/**
 * Class EnvParser
 * @package Api
 */
class EnvParser
{
    /**
     * @var string
     */
    private $envFile;

    /**
     * EnvParser constructor.
     * @param $filePath
     * @param string $envFile
     */
    public function __construct($filePath, $envFile = '.env')
    {
        $this->envFile = $filePath . DIRECTORY_SEPARATOR . $envFile;
    }

    /**
     * @throws \Exception
     */
    public function parse()
    {
        $fileContent = $this->getFileContent($this->envFile);
        if (empty($fileContent)) {
            throw new \Exception(sprintf("No config lines in %s file", $this->envFile));
        }

        foreach ($fileContent as $envLine) {
            if (strrpos($envLine, '#', -strlen($envLine)) !== false) {
                continue;
            }

            putenv($envLine);
        }

        return true;
    }

    /**
     * @param $filepath
     * @return array|bool
     */
    public function getFileContent($filepath)
    {
        $autodetect = ini_get('auto_detect_line_endings');
        ini_set('auto_detect_line_endings', '1');
        $lines = file($filepath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        ini_set('auto_detect_line_endings', $autodetect);

        return $lines;
    }
}
