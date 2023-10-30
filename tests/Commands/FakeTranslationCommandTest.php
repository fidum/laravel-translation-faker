<?php

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;

use function Orchestra\Testbench\workbench_path;
use function Pest\Laravel\artisan;
use function Pest\Laravel\withoutMockingConsoleOutput;

afterEach(function () {
    // Clean up files
    $files = app(Filesystem::class);

    foreach (files() as $file) {
        $files->delete($file);
    }

    $files->deleteDirectory(lang_path('da'));
    $files->deleteDirectory(workbench_path('vendor/example/lang/da'));
});

it('errors when base locale not replacers not configured', function () {
    config()->set('translation-faker.replacers', []);
    withoutMockingConsoleOutput();
    expect(fn () => artisan('translation:fake da'))
        ->toThrow(InvalidArgumentException::class);
});

it('can generate fake translation with default config', function () {
    withoutMockingConsoleOutput();
    artisan('translation:fake da');
    expect(Artisan::output())->toMatchSnapshot();
    assertGeneratedFiles();
});

it('can generate fake translation with custom replacer config', function () {
    withoutMockingConsoleOutput();
    config()->set('translation-faker.replacers.en', [
        'Quite' => 'Cheese',
        'sure' => 'Sandwich',
    ]);

    artisan('translation:fake da');
    expect(Artisan::output())->toMatchSnapshot();
    assertGeneratedFiles();
});

it('can generate fake translation with custom base locale option long', function () {
    withoutMockingConsoleOutput();
    config()->set('translation-faker.replacers.de', [
        'Ziemlich' => 'Cheese',
        'sicher' => 'sandwich',
    ]);

    artisan('translation:fake da --baseLocale=de');
    expect(Artisan::output())->toMatchSnapshot();
    assertGeneratedFiles();
});

it('can generate fake translation with custom base locale option short', function () {
    withoutMockingConsoleOutput();
    config()->set('translation-faker.replacers.de', [
        'Ziemlich' => 'Cheese',
        'sicher' => 'sandwich',
    ]);

    artisan('translation:fake da -bde');
    expect(Artisan::output())->toMatchSnapshot();
    assertGeneratedFiles();
});

function assertGeneratedFiles()
{
    foreach (files() as $file) {
        expect($file)
            ->toBeReadableFile()
            ->and(file_get_contents($file))
            ->toMatchSnapshot();
    }

    expect(array_merge(
        glob(workbench_path('vendor/example/lang/da/*.*')),
        glob(workbench_path('vendor/example/lang/da/**/*.*')),
    ))->toBeEmpty();
}

function files(): array
{
    return array_merge(
        glob(lang_path('da/*.*')),
        glob(lang_path('da/**/*.*')),
        glob(lang_path('vendor/example/da/*.*')),
        glob(lang_path('vendor/example/da/**/*.*')),
        [
            lang_path('da.json'),
            lang_path('vendor/example/da.json'),
        ],
    );
}
