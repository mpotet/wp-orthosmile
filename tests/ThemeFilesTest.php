<?php
/**
 * Tests that all required theme files are present.
 *
 * @package OrthoSmile
 */

namespace OrthoSmile\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Validates the OrthoSmile theme file structure.
 */
class ThemeFilesTest extends TestCase
{
    /** @var string Absolute path to the theme root. */
    private string $themeDir;

    protected function setUp(): void
    {
        $this->themeDir = ORTHOSMILE_THEME_DIR;
    }

    /**
     * Every file listed here must exist for the theme to function correctly.
     *
     * @return array<array{string}>
     */
    public static function requiredFilesProvider(): array
    {
        return [
            // WordPress theme entry points
            ['style.css'],
            ['index.php'],
            ['functions.php'],
            ['header.php'],
            ['footer.php'],
            ['404.php'],
            ['page.php'],
            ['home.php'],
            ['contact.php'],

            // Modules
            ['inc/theme-setup.php'],
            ['inc/enqueue.php'],
            ['inc/template-functions.php'],
            ['inc/template-tags.php'],
            ['inc/customizer.php'],
            ['inc/cpt-praticien.php'],
            ['inc/cpt-traitement.php'],
            ['inc/cpt-faq.php'],

            // CSS assets
            ['assets/css/main.css'],
            ['assets/css/global.css'],

            // JS assets
            ['assets/js/main.js'],

            // Template parts
            ['template-parts/hero.php'],
            ['template-parts/content.php'],
            ['template-parts/footer.php'],
        ];
    }

    /**
     * @dataProvider requiredFilesProvider
     */
    public function testRequiredFileExists(string $relativePath): void
    {
        $this->assertFileExists(
            $this->themeDir . '/' . $relativePath,
            "Required theme file '{$relativePath}' is missing."
        );
    }

    /**
     * style.css must declare the theme name so WordPress can detect it.
     */
    public function testStyleCssDeclaresThemeName(): void
    {
        $path = $this->themeDir . '/style.css';
        $this->assertFileExists($path);
        $contents = file_get_contents($path);
        $this->assertNotFalse($contents, 'Could not read style.css.');
        $this->assertStringContainsString('Theme Name:', $contents);
    }

    /**
     * functions.php must not contain a raw PHP error (i.e. must be parseable).
     */
    public function testFunctionsPhpIsParseable(): void
    {
        $output = shell_exec('php -l ' . escapeshellarg($this->themeDir . '/functions.php') . ' 2>&1');
        $this->assertStringContainsString('No syntax errors', (string) $output);
    }
}
